<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller
{
    public function resetpassword($token)
    {
        $updatePassword = DB::table('password_resets')
            ->where(['token' => $token])
            ->first();
        if (empty($updatePassword)) {

            return redirect()->route('forgetpassword');
        } else {
            return view('Emails.setpassword', ['token' => $token]);
        }
    }



    public function updatepassword(Request $request)
    {
        $request->validate([
            'token' => 'exists:password_resets,token',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_resets')
            ->where(['token' => $request->token])
            ->first();

        if (!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

        $user = User::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' =>  $updatePassword->email])->delete();

        return redirect()->route('login')->with('message', 'Your password has been changed!');
    }
}