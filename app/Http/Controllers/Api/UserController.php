<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Api\UserRepository;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\RegistRequest;
use App\Http\Requests\Api\User\UpdateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(RegistRequest $request) {
        return $this->transactionData(
            UserRepository::register($request->validated())
        );
    }

    public function login(LoginRequest $request) {
        return $this->transactionData(
            UserRepository::login($request->validated())
        );
    }

    public function update(UpdateRequest $request) {
        return $this->transactionData(
            UserRepository::update($request->validated())
        );
    }
}
