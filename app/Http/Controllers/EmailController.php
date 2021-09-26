<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\User;
use Auth;
use Illuminate\Support\Facades\Http;

class EmailController extends Controller
{
    public function forgetpassword()
    {
        return view('Emails.forget');
    }

    public function sendemail(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);


        $token = Str::random(40);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $p =  Mail::send('Emails.resetlink_verify', ['token' => $token, 'url' => url('')], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });



        if ($p) {
            echo 'ss';
        } else {
            return redirect()->route('sendmessgae');
        }

        // $details = [
        //     'token' => $token,
        //     'url' => url(''),
        // ];
        // Mail::to($request->email)->send(new \App\Mail\UnistagMail($details));

        // return back()->with('message', 'We have e-mailed your password reset link!');


    }



    public function resetmessage()
    {
        return view('Emails.send_reset_link');
    }

    public function register(Request $request)
    {
        $validatedData =   $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|unique:users',
            'country_code' => 'required',
            'country' => 'required',
            'state' => 'required',
            'refered_id' => 'nullable|exists:users,id',
            'phone' => 'required',
            'currency' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed|min:6',

        ]);

        $validatedData['password'] = bcrypt($request->password);
        if ($request->refered_id) {
            $validatedData['refered_id'] = $request->refered_id;
        }
        // $token = Str::random(9);

        // $p = $this->getUserIP();
        // $data =   Http::get('https://ipapi.co/' . '92.38.148.61' . '/json/')->json();
        // $currency = $data['currency'];
        // $validatedData['currency'] =   $currency;

        $token =   uniqid();
        $validatedData['verifycode'] =   $token;
        $flag =  strtolower($request->flag);
        $validatedData['flag'] =   $flag;

        if ($validatedData) {
            $user = User::create($validatedData);
            $p =  Mail::send('Emails.varification_code', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Code Notification');
            });
            if ($p) {
                echo 'ss';
            } else {
                $email = $request->email;
                return redirect()->route('confirmregister');
            }
        } else {
            return back();
        }
    }

    public function confirmregister()
    {
        return view('Emails.confirmregister');
    }
    public function login(Request $request)
    {
        $validatedData =   $this->validate($request, [
            'verifycode' => 'required|exists:users',
        ]);
        $user = User::where('verifycode', $request->verifycode)->first();

        Auth::login($user);
        if (Auth::user()->role == 'customer') {
            $user->update([
                'verifycode' => 'verifid'
            ]);
            return redirect()->route('customer');
        } elseif (Auth::user()->role == 'admin') {
            $user->update([
                'verifycode' => 'verifid'
            ]);
            return redirect()->route('admin');
        } else {
            $user->update([
                'verifycode' => 'verifid'
            ]);
            return redirect()->route('home');
        }
    }

    public  function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }
}