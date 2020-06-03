<?php

namespace App\Repositories\Interfaces;

interface SearchRepositoryInterface
{
    public function search(string $phrase = null);
}
