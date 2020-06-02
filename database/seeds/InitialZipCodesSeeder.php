<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\State;
use App\Models\County;
use App\Models\City;

class InitialZipCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \League\Csv\Exception
     *
     * @return void
     */
    public function run()
    {
        //load the CSV document from a file path
        $csv = Reader::createFromPath(database_path('files/uszips.csv'), 'r');
        $csv->setHeaderOffset(0);

        $this->command->getOutput()->progressStart($csv->count());

        $zips = $csv->getRecords();

        foreach ($zips as $zip) {
            $state = State::query()->firstOrCreate(
                ['abbreviation' => $zip['state_id'], 'name'=> $zip['state_name']]
            );

            //wrong formatted JSON becomes right
            $zip['county_weights'] = str_replace('\'', '"', $zip['county_weights']);

            $county = County::query()->firstOrCreate(
                [
                    'fips' => $zip['county_fips']
                ],
                [
                    'state_id' => $state->id,
                    'name' => $zip['county_name'],
                    'weights' => $zip['county_weights'],
                    'names_all' => $zip['county_names_all'],
                    'fips_all' => $zip['county_fips_all']
                ]
            );

            /* $city = */ City::query()->firstOrCreate(
                [
                    'zip' => $zip['zip']
                ],
                [
                    'county_id' => $county->id,
                    'name' => $zip['city'],
                    'lat' => $zip['lat'],
                    'lng' => $zip['lng'],
                    'zcta' => filter_var($zip['zcta'], FILTER_VALIDATE_BOOLEAN),
                    'parent_zcta' => $zip['parent_zcta'],
                    'population' => $zip['population'],
                    'density' => $zip['density'],
                    'imprecise' => filter_var($zip['imprecise'], FILTER_VALIDATE_BOOLEAN),
                    'military' => filter_var($zip['military'], FILTER_VALIDATE_BOOLEAN),
                    'timezone' => $zip['timezone'],
                ]
            );

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
