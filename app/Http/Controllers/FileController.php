<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\Artisan;

/**
 * @group File
 *
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    /**
     * File
     *
     * Upload CSV file to update data
     *
     * @bodyParam csv File required Mimes:csv
     *
     * @param UploadFileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(UploadFileRequest $request)
    {
        Artisan::call("zip:update", ['file' => file_get_contents($request->csv)]);

        return response()->json(['success'=>'You have successfully upload file. Please reload page.']);
    }
}
