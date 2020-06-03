<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Models\State;
use App\Models\County;
use App\Models\City;

class UpdateZipCodesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zip:update {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update zip codes by uploaded file via web';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * @throws \League\Csv\Exception
     */
    public function handle()
    {
        $zips = $this->getFileContent();

        foreach ($zips as $zip) {
            $state = State::query()->updateOrCreate(
                ['abbreviation' => $zip['state_id'], 'name'=> $zip['state_name']]
            );

            //wrong formatted JSON becomes right
            $zip['county_weights'] = str_replace('\'', '"', $zip['county_weights']);

            $county = County::query()->updateOrCreate(
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

            /* $city = */ City::query()->updateOrCreate(
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
        }

        return true;
    }

    protected function getFileContent()
    {
        $csv = Reader::createFromString($this->argument('file'));
        $csv->setHeaderOffset(0);

        return $csv->getRecords();
    }
}
