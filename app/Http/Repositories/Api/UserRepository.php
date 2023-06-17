<?php

namespace App\Http\Repositories\Api;

use App\Models\User;
use Exception;

class UserRepository
{
    public static function register(array $data) {
        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return response()->json([
            'message' => 'user berhasil ditambahkan'
        ]);
    }

    public static function login(array $data) {
        $token = auth('user')->attempt($data);
        if ($token) {
            return response()->json([
                'message'=> 'Sukses login',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'Username atau Kata sandi salah',
            ], 422);
        }
    }

    public static function update(array $data) {
        $user = auth('user')->user();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Berhasil mengubah data',
        ]);

    }
}
