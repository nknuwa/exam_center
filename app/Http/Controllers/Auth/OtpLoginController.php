<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Auth;



class OtpLoginController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone_no' => 'required'
        ]);

        $user = User::where('phone_no', $request->phone_no)
            ->where('status', 1)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'phone_no' => 'User not found.'
            ]);
        }

        $otp = rand(100000, 999999);

        UserOtp::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5)
            ]
        );

        // Send SMS
        // SmsService::send($user->phone_no,$otp);

        return redirect()
            ->route('otp.verify.form')
            ->with('phone', $user->phone_no)
            ->with('otp', $otp);
    }

    public function showVerify()
    {
        if (!session()->has('phone')) {
            return redirect('/');
        }

        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $user = User::where('phone_no', $request->phone_no)->first();

        if (!$user) {
            return back();
        }

        $otp = UserOtp::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'otp' => 'Invalid OTP'
            ]);
        }

        if ($otp->expires_at < now()) {
            return back()->withErrors([
                'otp' => 'OTP expired'
            ]);
        }

        Auth::login($user);

        $otp->delete();

        return redirect()->route('home');
    }
}
