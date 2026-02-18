<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    public function destroy(Request $request)
    {
        // ✅ Update logout time
        $log = UserLog::where('user_id', auth()->id())
            ->whereNull('logout_at')
            ->latest()
            ->first();

        if ($log) {
            $log->update([
                'logout_at' => now(),
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
