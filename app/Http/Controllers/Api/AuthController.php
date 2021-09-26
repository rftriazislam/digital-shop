<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Image;
use Validator;
use Password;
use Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {

        $validatedData =   $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|unique:users',
            'country_code' => 'required',
            'country' => 'required',
            'state' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
        ]);
        $validatedData['password'] = bcrypt($request->password);

        if ($request->refered_id) {
            $validatedData['refered_id'] = $request->refered_id;
        }


        $user = User::create($validatedData);
        if ($user) {
            return response()->json(['sucsess' => true, 'message' => 'Information save successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'something error']);
        }
    }

    public function signin(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {

            return response(['user' => null, 'message' => 'Email or Password Invalied']);
        } else {

            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response(['user' => auth()->user(), 'token' => $accessToken]);
        }
    }
    public function profileupdate(Request $request, $user_id)
    {
        $user_update = User::where('id', $user_id)->first();

        if (!empty($user_update)) {

            if (!empty($request->all())) {

                $user_update->update($request->all());
                if ($request->file("image")) {
                    $image = $request->file('image');
                    $filename =  $user_id . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(800, 600)->save(public_path('profile_image/' . $filename));

                    $user_update->update([$user_update->image = $filename]);
                }



                return response()->json(['success' => true, 'message' => 'Successful update '], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'request data empty'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'user id invalied'], 400);
        }
    }



    public function profile($user_id)
    {

        $user_info = User::where('id', $user_id)->first();

        if (!empty($user_info)) {
            return response()->json(['success' => true,  'user_info' => $user_info], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'User Not Found'], 200);
        }
    }

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {

            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return \Response::json($arr);
        // return response()->json(['success' => false,  'message' => 'error'], 200);
    }



    public function change_password(Request $request)
    {
        $validatedData =   $this->validate($request, [
            'id' => 'required',
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => 'required',
        ]);

        $check  = Auth::guard('web')->attempt([
            'id' => $request->id,
            'password' => $request->old_password
        ]);
        if ($check) {

            $user_info = User::where('id', $request->id)->first();
            $password = bcrypt($request->password);
            $user_info->update([$user_info->password = $password]);

            if ($user_info) {
                return response()->json(['success' => true,  'message' => 'successfully password update'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Unsuccessfully'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'old password incorrect'], 400);
        }
    }
}