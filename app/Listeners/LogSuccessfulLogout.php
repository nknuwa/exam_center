<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\UserLog;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        $log = UserLog::where('user_id', $event->user->id)
            ->whereNull('logout_at')
            ->latest()
            ->first();

        if ($log) {
            $log->update([
                'logout_at' => now(),
            ]);
        }
    }
}
