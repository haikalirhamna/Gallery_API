<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Api\AdminRepository;
use App\Http\Requests\Api\Admin\LoginRequest;
use App\Http\Requests\Api\Admin\RegistRequest;
use App\Http\Requests\Api\Admin\UpdateRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register(RegistRequest $request) {
        return $this->transactionData(
            AdminRepository::register($request->validated())
        );
    }

    public function login(LoginRequest $request) {
        return $this->transactionData(
            AdminRepository::login($request->validated())
        );
    }

    public function update(UpdateRequest $request) {
        return $this->transactionData(
            AdminRepository::update($request->validated())
        );
    }
}
