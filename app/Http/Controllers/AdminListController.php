<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    // direct admin list
    public function index()
    {
        $userData = User::when(request("accountSearch"), function ($query) {
            $key = request("accountSearch");
            $query->orWhere("name", "like", "%" . $key . "%")
                ->orWhere("email", "like", "%" . $key . "%")
                ->orWhere("phone", "like", "%" . $key . "%")
                ->orWhere("gender", "like", "%" . $key . "%")
                ->orWhere("address", "like", "%" . $key . "%");
        })
            ->select("id", "name", "email", "phone", "gender", "address")->paginate(5);

        return view("admin.adminList.index", compact("userData"));
    }

    // direct account delete
    public function accountDelete($id)
    {
        User::where("id", $id)->delete();
        return back()->with(["accountDeleteSuccess" => "Account deleted."]);
    }
}
