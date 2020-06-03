<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SearchRepositoryInterface;
use App\Models\City;

class SearchRepository implements SearchRepositoryInterface
{
    public function search(string $phrase = null)
    {
        //We know that `zip` contains only digits and `city name` contains letters
        //so we can make search depend on $phrase meaning
        if (ctype_digit($phrase)) {
            return $this->byZip($phrase);
        } else {
            return $this->byName($phrase);
        }
    }

    protected function byZip(string $zip)
    {
        return City::query()->where('zip', $zip)->paginate(config('app.per_page'));
    }

    protected function byName(string $name)
    {
        return City::query()->where('name', 'LIKE', "%$name%")->paginate(config('app.per_page'));
    }
}
