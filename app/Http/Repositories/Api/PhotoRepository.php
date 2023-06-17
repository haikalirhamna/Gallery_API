<?php

namespace App\Http\Repositories\Api;

use App\Models\Photo;
use Exception;
use Illuminate\Support\Facades\Storage;

class PhotoRepository
{
    public static function show(Photo $photo) {
        $auth = $photo->album_id()->first('user_id')->user()->get();
        foreach ($auth as $value) {
            if ($value->id === auth('user')->id()) {

                return response()->json(
                    compact('photo')
                );
            } else {
                return response()->json([
                    'message' => 'Photo ini bukan milik anda'
                ], 403);
            }
        }
    }

    public static function store(array $data) {
        $image_path = Storage::put('photos/'.$data['album_id'], $data['content']); 
        $data['content'] = $image_path;
        
        Photo::create($data);

        return response()->json([
            'message' => 'Photo berhasil dibuat'
        ]);
    }

    public static function update(Photo $photo, array $data) {
        $auth = $photo->album_id()->first('user_id')->user()->get();
        foreach ($auth as $value) {
            if ($value->id === auth('user')->id()) {

                if (isset($data['content'])){
                    Storage::delete($photo->getRawOriginal('content'));
                    $image_path = Storage::put('photos/'.$photo->album_id, $data['content']);
                    $data['content'] = $image_path;
                }
                $photo->update($data);
    
                return response()->json([
                    'message' => 'Photo berhasil diubah'
                ]);
                } else {
                return response()->json([
                    'message' => 'Photo ini bukan milik anda'
                ], 403);
            }
        }
    }   

    public static function delete(Photo $photo) {
        $auth = $photo->album_id()->first('user_id')->user()->get();
        foreach ($auth as $value) {
            if ($value->id === auth('user')->id()) {
                $photo->delete();
                Storage::delete($photo->getRawOriginal('content'));

                return response()->json([
                    'message' => 'Photo sudah dihapus'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Photo ini bukan milik anda'
                ], 403);
            }
        }
    }
}
