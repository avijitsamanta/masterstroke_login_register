<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Validator;
use App\Helpers\Helper;
use Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user_id = Auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        return view('frontend.user.profile')->with('user', $user);
    }

    public function editprofile()
    {
        $user_id = Auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        return view('frontend.user.edit-profile')->with('user', $user);
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => ['required', 'regex:/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/'],
        ]);

        if ($validator->fails()) {
            return Response::json(['message' => 'Oops Something went wrong!!']);
        } else {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->dob = $request->input('dob');
            $fileName = '';

            //====Upload Profile Image===
            if ($request->hasFile('profile_image')) {
                $file     = $request->file('profile_image');
                $fileName = 'profilePic-' . time() . '.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/users/profile_image/');

                if ($file->move($path, $fileName)) {
                    //delete previous profile image
                    if (!empty($user->profile_image) && file_exists($path . $user->profile_image)) {
                        unlink($path . $user->profile_image);
                    }
                }
            } else if (!empty($user->profile_image)) {
                $fileName = $user->profile_image;
            }
            $user->profile_image = $fileName;
            $user->save();

            return Response::json(['message' => 'Profile updated successfully']);
        }
    }

    public function checkPhoneNumber(Request $request)
    {
        $input = $request->all();
        if ($input['userType'] == 'main_user') {
            $where = [
                ['phone_number', Helper::cleanText($input['phone'])],
                ['id', '<>', Auth::id()],
            ];
        } else {
            $where = [
                ['phone_number', Helper::cleanText($input['phone'])],
            ];
        }
        if (User::where($where)->exists()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function addUser()
    {
        return view('frontend.user.add-user');
    }

    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => ['required', 'regex:/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/'],
        ]);

        if ($validator->fails()) {
            return Response::json(['message' => 'Oops Something went wrong!!']);
        } else {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->dob = $request->input('dob');
            $user->password = Hash::make($request->input('password'));
            $user->user_type = 2;
            $user->added_by = auth()->user()->id;
            $fileName = '';

            //====Upload Profile Image===
            if ($request->hasFile('profile_image')) {
                $file     = $request->file('profile_image');
                $fileName = 'profilePic-' . time() . '.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/users/profile_image/');

                if ($file->move($path, $fileName)) {
                    //delete previous profile image
                    if (!empty($user->profile_image) && file_exists($path . $user->profile_image)) {
                        unlink($path . $user->profile_image);
                    }
                }
            } else if (!empty($user->profile_image)) {
                $fileName = $user->profile_image;
            }
            $user->profile_image = $fileName;
            $user->save();

            return Response::json(['message' => 'User added successfully']);
        }
    }
}
