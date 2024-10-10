<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\OtpMailer;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $otp;

    public function sendMailToUser(Request $request)
    {
        $email = $request->input("email");
        $expireTime = 5;
        $otp = Str::random(6);

        $user = User::firstOrNew(['email' => $email]);

        if (!$user->exists) {
            $user->save();
        }

        OTP::where('userId', $user->id)->delete();

        OTP::create([
            'userId' => $user->id,
            'email' => $user->email,
            'otp' => $otp,
        ]);

        if (!$user->isActive) {
            Mail::to($user->email)->send(new OtpMailer($otp, $expireTime));

            return response()->json([
                'message' => 'OTP sent successfully',
            ]);
        }

        return response()->json([
            'message' => 'User is already active',
        ], 400);
    }



    public function verifyOTP(Request $request)
    {
        $otpInput = $request['otp'];
        $email = $request['email'];
        $user = User::where('email', $email)->first();   
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $otpStore = OTP::where('userId', $user->id)->first();
        if ($otpStore->otp != $otpInput) {
            return response()->json([
                'message' => 'OTP is not valid',
            ], 400);
        }

        if ($otpStore->created_at->diffInMinutes(now()) > 5) {
            return response()->json([
                'message' => 'OTP is expired',
            ], 400);
        }
        
        $user->isActive = true;
        $user->save();
        $otpStore->delete();

        return response()->json([
            'message' => 'OTP verified successfully',
        ]);
    }

    public function subcribeToGetDailyForecast() {}

    public function unsubcribe() {}
}
