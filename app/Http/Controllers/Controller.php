<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function transactionData($callback) {
        DB::beginTransaction();
        try{
        $response = $callback;
        DB::commit();
        return $response;
        } catch(\Throwable $e) {
        DB::rollback();
        \Log::info($e);
        return $e;
        }
    }
}
