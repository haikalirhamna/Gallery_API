<?php

namespace App\Http\Repositories\Api;

use App\Models\Album;
use App\Models\Photo;
use Exception;

class AlbumRepository
{
    public static function show(Album $album) {
        if ($album->user_id === auth('user')->id()) {

            $data = Photo::where('album_id', $album->id)->get();

            return response()->json(
                compact('data')
            );
        } else {
            return response()->json([
                'message' => 'Album ini bukan milik anda'
            ], 403);
        }
    }

    public static function showAll() {
        $User = auth('user')->user();

        $album = $User->albums()->get();
        return response()->json(
            compact('album')
        );
    }

    public static function store(array $data) {
        $user = auth('user')->user();

        $album = $user->albums()->create($data);

        $album->save();

        return response()->json([
            'message' => 'Album berhasil dibuat'
        ]);
    }

    public static function update(Album $album, array $data) {
        if (auth()->id() === $album->user_id) {
            $album->update($data);

            return response()->json([
                'message' => 'Album berhasil diubah'
            ]);
        } else {
            return response()->json([
                'message' => 'Album ini bukan milik anda'
            ], 403);
        }
    }

    public static function delete(Album $album) {
        if ($album->user_id === auth('user')->id()) {
            
            $data = Album::where('id', $album->id);

            $data->delete();

            return response()->json([
                'message' => 'Album sudah dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Album tidak ditemukan'
            ], 404);
        }
    }

    public static function deleteAll() {
        $User = auth('user')->user();

        $User->albums()->delete();

        return response()->json([
            'message' => 'Semua Album sudah dihapus'
        ]);
    }
}
