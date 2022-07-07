<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function user(): ?Authenticatable
    {
        return Auth::user();
    }

    public function sessions(): JsonResponse
    {
        return $this->render(DB::table('sessions')->where('user_id', Auth::id())->get());
    }
}
