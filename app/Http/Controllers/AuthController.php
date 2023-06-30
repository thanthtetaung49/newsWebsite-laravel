<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // direct dashboard
    public function auth()
    {
        $id = Auth::user()->id;
        $user = User::select("name", "email", "phone", "gender", "address")->where("id", $id)->first();
        return view('admin.profile.index', compact("user"));
    }

    // direct accountUpdate
    public function userUpdate(Request $request)
    {
        $this->userValidationCheck($request);
        $userUpdateData = $this->userUpdateData($request);
        User::where("id", Auth::user()->id)->update($userUpdateData);
        return back()->with(["updateSuccess" => "Account updated..."]);
    }

    // direct change password
    public function userChangePassword()
    {
        return view("admin.password.changePassword");
    }

    // direct change password update
    public function changePasswordUpdate(Request $request)
    {
        // dd($request->all());
        $this->changePasswordValidationCheck($request);

        $getPassword = User::select("password")->where("id", Auth::user()->id)->first();
        $oldDatabasePassword = $getPassword->password;
        $hashedNewPassword = Hash::make($request->newPassword);

                        // plain text           hashed value
        if (Hash::check($request->oldPassword, $oldDatabasePassword)) {
            User::where("id", Auth::user()->id)->update([
                "password" => $hashedNewPassword
            ]);
            return redirect()->route('profile');
        } else {
            return back()->with(["changePasswordFail" => "Change password operation is failed"]);
        }
    }

    // user update data
    private function userUpdateData($request)
    {
        return [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "address" => $request->address,
        ];
    }

    // account validation check
    private function userValidationCheck($request)
    {
        Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
        ])->validate();
    }

    // change password update validation
    private function changePasswordValidationCheck($request)
    {
        Validator::make($request->all(), [
            "oldPassword" => "required",
            "newPassword" => "required|min:8|max:15",
            "confirmPassword" => "required|min:8|max:15|same:newPassword"
        ])->validate();
    }
}
