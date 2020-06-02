<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_id');
            $table->string('fips')->comment('The zip\'s primary county in the FIPS format.');
            $table->string('name')->comment('The name of the county_fips');
            $table->json('weights')
                ->nullable()
                ->comment(
                    'A JSON dictionary listing all county_fips and their weights (by population) associated
                    with the zip code.'
                );

            $table->string('names_all')
                ->nullable()
                ->comment('The name of all counties that overlap the zip. (e.g. Maricopa|Pinal).');



            $table->string('fips_all')
                ->nullable()
                ->comment('The 5-digit FIPS code for all counties that overlap the zip. (e.g. 04013|04021)');

            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counties', function (Blueprint $table) {
            $table->dropForeign('state_id');
        });

        Schema::dropIfExists('counties');
    }
}
