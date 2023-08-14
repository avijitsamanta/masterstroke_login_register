<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Cookie;
use App\Models\User;
use Hash;
use Validator;
use App\Helpers\Helper;
use App\Models\ResetPassword;
use Mail;

class UserauthController extends Controller
{
    public function index()
    {
        //if user already logged in, redirect to dashboard
        if (\Auth::check()) {
            return \Redirect::route('user.dashboard');
        }
        return view('frontend.login');
    }

    public function doLogin(Request $request)
    {
        //set the validation
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('alert-danger', 'Please enter mandatory fields');
            return \Redirect::route('admin.login');
        } else {
            $remember = ($request->input('remember')) ? 1 : 0;
            //user login
            $auth = \Auth::attempt(
                [
                    'email'         => trim($request->input('email')),
                    'password'      => trim($request->input('password')),
                ]
            );
            if ($auth) { //successfully login				

                if ($remember == 1) { //if set remember me, set cookie
                    Cookie::queue('remember', '1', 5400);
                    Cookie::queue('useremail', trim($request->input('email')), 5400);
                    Cookie::queue('password', trim($request->input('password')), 5400);
                } else {
                    Cookie::queue('remember', '', 5400);
                    Cookie::queue('useremail', '', 5400);
                    Cookie::queue('password', '', 5400);
                }

                return \Redirect::route('user.dashboard');
            } else {
                $request->session()->flash('alert-danger', 'Invalid email/password or inactive user');
                return \Redirect::route('user.login');
            }
        }
    }

    public function registration()
    {
        if (\Auth::check()) {
            return \Redirect::route('frontend.dashboard');
        }
        return view('frontend.registration');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone_number' => 'required|unique:users|regex:/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/'
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
        ]);

        $auth = \Auth::attempt(
            [
                'email'         => trim($request->input('email')),
                'password'      => trim($request->input('password')),
            ]
        );
        return \Redirect::route('user.dashboard');
    }
    

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        $request->session()->flash('alert-success', 'You have been successfully logged out!');
        return \Redirect::route('user.login');
    }

    public function forgotPassword(Request $request)
    {
        $method     = $request->method();
        if ($method == "POST") {
            $userData = array();
            $userData['token']   = uniqid(mt_rand(), true);
            $email             = Helper::cleanText($request->get('email'));

            /** get user details by email id**/
            $userDetails         = User::where('email', $email)->first();

            $userData['user_id'] = $userDetails->id;
            $userName            = $userDetails->name;


            $user = new ResetPassword($userData);
            /**  save token details by user id **/
            $user->save();
            $dataEncryption         = base64_encode($userData['user_id'] . '^' . $email . '^' . $userData['token']);
            $url    = '<a href="' . \URL::route('user.resetUserPassword', $dataEncryption) . '">click here</a>';
            $userData['urlParam']   = $url;
            $userData['email']      = $email;
            $userData['name']       = $userName;
            
            /** send email to user where email body contains a unique link **/
            Mail::send('email_template.user_forgot_password', ['user' => $userData], function ($m) use ($userData, $userName) {
                $m->from(\Config::get('constants.fromEmail'), \Config::get('constants.fromName'));
                $m->to($userData['email'], $userName)->subject("Masterstroke - Request password");
            });
            $request->session()->flash('alert-success', 'A mail has been sent to you to reset your password');
            return \Redirect::route('user.forgotPassword');
        }
        return view('frontend.forget_password');
    }

    public function checkUserEmail(Request $request)
    {
        $input = $request->all();
        if (User::where('email', Helper::cleanText($input['email']))->exists()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function resetUserPassword($encryptToken)
    {
        $decryptToken       = base64_decode($encryptToken); //decrypt the token  
        $tokenArr           = explode("^", $decryptToken);
        $userId             = $tokenArr[0];
        $email              = $tokenArr[1];
        $token              = $tokenArr[2];
        $data['user_id']    = $userId;
        //check whether this token exist or not
        $resulutToken = ResetPassword::where([
            ['user_id', $userId],
            ['token', $token],
        ])->get();

        if ($resulutToken->count() > 0) {
            $data['flag']       = $resulutToken[0]->flag;
            $data['id']         = $resulutToken[0]->id;
            $data['email']      = $email;
            $data['user_id']    = $userId;
        }

        return view('frontend.reset_password', $data);
    }

    public function updatePassword(Request $request)
    {

        /** validation of mandatory fields **/
        $validator = Validator::make($request->all(), [
            'password'             => 'required',
            'confirm_password'     => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('alert-danger', 'Please enter mandatory fields');
            return \Redirect::route('user.login');
        } else {

            //collect all request values
            $id             = $request->id;
            $userId         = $request->user_id;
            $password         = $request->password;
            $confPassword     = $request->confirm_password;

            $objUser = User::find($userId);

            if (!empty($objUser)) { //if user exist
                $objReset         = ResetPassword::find($id);

                //check whether the token already set or not
                if ($objReset->flag == 'Y') { //if not used
                    //update the user password
                    $objUser->password = Hash::make($password);
                    $objUser->save();
                    //set the token used flag
                    $objReset->flag = 'N';
                    $objReset->save();

                    /** find other active tokens for this user **/
                    $activeTokens     = ResetPassword::where(['user_id' => $userId, 'flag' => 'Y'])->get();

                    $rowCount         = $activeTokens->count();
                    $array_of_ids   = array();
                    if ($rowCount > 0) {
                        foreach ($activeTokens as $a) {
                            $array_of_ids[] = $a['id'];
                        }

                        ResetPassword::whereIn('id', $array_of_ids)->update(array('flag' => 'N'));
                    }

                    $request->session()->flash('alert-success', 'You have reset password successfully');
                    return \Redirect::route('user.login');
                }
            } else {
                $request->session()->flash('alert-danger', 'User is invalid');
                return \Redirect::route('user.login');
            }
        }
    }
}
