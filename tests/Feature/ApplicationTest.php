<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\County;
use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDatabase()
    {
        $cities = $this->insertAndGetCities();

        $this->assertDatabaseHas('cities', [
            'name' => $cities->first()->name
        ]);
    }

    public function testPagination()
    {
        $cities = $this->insertAndGetCities();

        $response = $this->post('paginate?page=2');

        $this->assertEquals($response->getStatusCode(), '200');

        $responseArray = json_decode($response->getContent());

        //$this->insertAndGetCities(); creates 5 more entities than every page render,
        //so second page have rest 5 entities
        $this->assertEquals(count($responseArray->data), 5);
    }

    public function testUpdateDatabase()
    {
        $cities = $this->insertAndGetCities();

        $city = $cities->first();

        $this->assertDatabaseHas('cities', [
            'name' => $city->name
        ]);

        $city->update([
            'name' => 'ZZZzzz'
        ]);

        $this->assertDatabaseHas('cities', [
            'name' => 'ZZZzzz'
        ]);
    }

    public function testFileUpdate()
    {
        $content = 'zip,lat,lng,city,state_id,state_name,zcta,parent_zcta,population,density,county_fips,county_name,county_weights,county_names_all,county_fips_all,imprecise,military,timezone
601,18.18004,-66.75218,TEST rename,PR,Puerto Rico,TRUE,,17242,111.4,72001,Adjuntas,"{\'72001\':99.43,\'72141\':0.57}",Adjuntas|Utuado,72001|72141,FALSE,FALSE,America/Puerto_Rico';

        $file = UploadedFile::fake()->createWithContent('test.csv', $content);

        $cities = $this->insertAndGetCities();

        $city = $cities->first();

        $this->assertDatabaseHas('cities', [
            'name' => $city->name
        ]);

        Artisan::call("zip:update", ['file' => file_get_contents($file)]);

        $this->assertDatabaseHas('cities', [
            'name' => 'TEST rename'
        ]);
    }

    protected function insertAndGetCities()
    {
        //insert 5 more entries than per_page parameter
        $amount = config('app.per_page') + 5;

        $state = factory(State::class)->create();
        $county = factory(County::class)->create([
            'state_id' => $state->id
        ]);

        return factory(City::class, $amount)->create([
            'county_id' => $county->id
        ]);
    }
}
