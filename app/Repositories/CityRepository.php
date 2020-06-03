<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Interfaces\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function paginate()
    {
        return City::query()->paginate(config('app.per_page'));
    }
}
