<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        // Random Token Generate
        $token = Str::random(65);

        // Insert Into password_resets Table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Mail Send Karna
        Mail::send('emails.forgotPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Forgot Password");
        });

        return redirect()->route('login')->with('status', 'we have sent email');
    }

    public function ShowLinkForm($token)
    {
        return view('emails.linkform', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        // Step 1: Validate Request
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
        ]);

        // Step 2: Check Token in password_resets Table
        $reset = DB::table('password_resets')->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid token or email!']);
        }

        // Step 3: Update Password in users Table
        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        // Step 4: Delete Token After Successful Reset
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        // Step 5: Redirect with Success Message
        return redirect()->route('login')->with('status', 'Password reset successfully!');
    }
}
