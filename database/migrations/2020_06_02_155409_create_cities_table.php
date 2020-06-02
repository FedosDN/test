<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('county_id');
            $table->string('name')->comment('The official USPS city name.');
            $table->string('zip')->unique()->comment('The 5-digit zip code assigned by the U.S. Postal Service.');
            $table->string('lat')->comment('The latitude of the zip code');
            $table->string('lng')->comment('The longitude of the zip code');
            $table->boolean('zcta')->comment('TRUE if the zip code is a Zip Code Tabulation area');
            $table->string('parent_zcta')
                ->nullable()
                ->comment(
                    'The ZCTA that contains this zip code. Only exists if zcta is FALSE.
                    Useful for making inferences about a zip codes that is a point from the ZCTA that contains it.'
                );

            $table->string('population')
                ->nullable()
                ->comment('An estimate of the zip code\'s population. Only exists if zcta is TRUE.');

            $table->string('density')
                ->nullable()
                ->comment('The estimated population per square kilometer. Only exists if zcta is TRUE.');

            $table->boolean('imprecise')
                ->comment('TRUE if the lat/lng has been geolocated using the city (rare).');

            $table->boolean('military')
                ->comment('TRUE if the zip code is used by the US Military (lat/lng not available).');

            $table->string('timezone')
                ->comment('The city\'s time zone in the tz database format. (e.g. America/Los_Angeles)');

            $table->timestamps();

            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign('county_id');
        });

        Schema::dropIfExists('cities');
    }
}
