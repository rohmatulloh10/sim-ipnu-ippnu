<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        Log::info('LoginResponse dijalankan', [
            'user_id' => $request->user()?->id,
            'expects_json' => $request->expectsJson(),
            'url' => $request->fullUrl(),
        ]);

        return redirect()->route('login.redirect');
    }
}