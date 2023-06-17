<?php

namespace App\Http\Controllers\Api;

use App\Http\Repositories\Api\AlbumRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Album\StoreRequest;
use App\Http\Requests\Api\Album\UpdateRequest;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function show(Album $album) {
        return $this->transactionData(
            AlbumRepository::show($album)
        );
    }

    public function showAll(Album $album) {
        return $this->transactionData(
            AlbumRepository::showAll($album)
        );
    }

    public function store(StoreRequest $request) {
        return $this->transactionData(
            AlbumRepository::store($request->validated())
        );
    }

    public function update(Album $album, UpdateRequest $request) {
        return $this->transactionData(
            AlbumRepository::update($album, $request->validated())
        );
    }

    public function delete(Album $album) {
        return $this->transactionData(
            AlbumRepository::delete($album)
        );
    }

    public function deleteAll(Album $album) {
        return $this->transactionData(
            AlbumRepository::deleteAll($album)
        );
    }
}
