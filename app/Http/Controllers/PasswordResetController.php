<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;



class PasswordResetController extends Controller
{
    public function send_reset_email_password(Request $request){
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $email = $request->email;

        //Check User's Emails Exist or Not
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'message' => 'Email does not exist!',
                'status' => 'failed'
            ], 402);
        }

        //Generate Token
        $token = Str::random(60);

        //Saving Data to Database
        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()

        ]);

        //dump("http://127.0.0.1:8000/api/request-reset-password". $token);

        //Send Email with Password Reset View
        Mail::send('admins_email/reset', ['token'=>$token], function(Message $message)use($email){
            $message ->subject('Reset Your Password');
            $message ->to($email);
        });

        return response()->json([
            'message' => 'Password Reset Email Sent to ... Check Your Email!',
            'status' => 'success'
        ], 200);

    }

    public function resetPassword(Request $request, $token){
        //Delete Token older than 1 minute
        $formatted = Carbon::now()->subMinutes(1)->toDateString();
        PasswordReset::where('created_at', '<=', $formatted)->delete();

        $request->validate([
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ]);

        $passwordreset = PasswordReset::where('token', $token)->first();
        if(!$passwordreset){
            return response()->json([
                'message' => 'Token is Invalid or Expired!',
                'status' => 'failed'
            ], 404);
        }

        $user = User::where('email', $passwordreset->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email', $user->email)->delete();
        return response()->json([
            'message' => 'Password Reset Successfully!',
            'status' => 'success'
        ], 200);
    }
}
