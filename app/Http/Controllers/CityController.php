<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCitiesRequest;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\SearchRepositoryInterface;

/**
 * @group City
 *
 * @package App\Http\Controllers
 */
class CityController extends Controller
{
    /**
     * @var SearchRepositoryInterface
     */
    private SearchRepositoryInterface $searchRepository;

    /**
     * @var CityRepositoryInterface
     */
    private CityRepositoryInterface $cityRepository;

    public function __construct(SearchRepositoryInterface $repository, CityRepositoryInterface $cityRepository)
    {
        $this->searchRepository = $repository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Get all cities
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Get cities with pagination
     *
     * @urlParam page integer
     *
     * @responseFile responses/index.json
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginate()
    {
        $cities = $this->cityRepository->paginate();

        return response()->json($cities);
    }

    /**
     * Search cities
     *
     * @urlParam phrase required Search phrase (zipcode or name)
     * @urlParam page integer
     *
     * @responseFile responses/byZip.json
     *
     * @param SearchCitiesRequest $request
     * @return mixed
     */
    public function search(SearchCitiesRequest $request)
    {
        return $this->searchRepository->search($request->phrase);
    }
}
