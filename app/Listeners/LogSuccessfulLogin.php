<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\UserLog;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        UserLog::create([
            'user_id'    => $event->user->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'login_at'   => now(),
        ]);
    }
}
