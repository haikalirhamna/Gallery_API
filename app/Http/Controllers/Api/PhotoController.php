<?php

namespace App\Http\Controllers\Api;

use App\Http\Repositories\Api\PhotoRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Photo\StoreRequest;
use App\Http\Requests\Api\Photo\UpdateRequest;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function show(Photo $photo) {
        return $this->transactionData(
            PhotoRepository::show($photo)
        );
    }

    public function store(StoreRequest $request) {
        return $this->transactionData(
            PhotoRepository::store($request->validated())
        );
    }

    public function update(Photo $photo, UpdateRequest $request) {
        return $this->transactionData(
            PhotoRepository::update($photo, $request->validated())
        );
    }

    public function delete(Photo $photo) {
        return $this->transactionData(
            PhotoRepository::delete($photo)
        );
    }
}
