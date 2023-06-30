<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // login api
    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();

        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    "user" => $user,
                    "token" => $user->createToken(time())->plainTextToken
                ]);
            } else {
                return response()->json([
                    "user" => null,
                    "token" => null
                ]);
            }
        } else {
            return response()->json([
                "user" => null,
                "token" => null
            ]);
        }
    }

    // register
    public function register(Request $request)
    {
        $userData = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        User::create($userData);
        $user = User::where("email", $request->email)->first();

        if (isset($user)) {
            return response()->json([
                "user" => $user,
                "token" => $user->createToken(time())->plainTextToken
            ]);
        } else {
            return response()->json([
                "user" => null,
                "token" => null
            ]);
        }
    }

    // get post data
    public function post()
    {
        $post = Post::select("posts.*", "categories.title as category_title")
            ->leftJoin("categories", "posts.category_id", "categories.id")
            ->get();

        return response()->json([
            "status" => "success",
            "post" => $post
        ]);
    }

    // get category data
    public function category()
    {
        $category = Category::select("id", "title", "description")->get();

        return response()->json([
            "status" => "success",
            "category" => $category
        ]);
    }

    // get post search data
    public function postSearch(Request $request)
    {
        $postSearch = Post::select("posts.*", "categories.title as category_title")
            ->leftJoin("categories", "posts.category_id", "categories.id")
            ->orWhere("posts.title", "like", "%" . $request->key . "%")
            ->orWhere("posts.description", "like", "%" . $request->key . "%")
            ->get();

        return response()->json([
            "status" => "success",
            "postSearchData" => $postSearch,
        ]);
    }

    // get category search data
    public function categorySearch(Request $request)
    {
        if ($request->key != null) {
            $postData = Post::select("posts.*", "categories.title as category_title")
                ->leftJoin("categories", "posts.category_id", "categories.id")
                ->where("posts.category_id", $request->key)->get();
        } else {
            $postData = Post::select("posts.*", "categories.title as category_title")
                ->leftJoin("categories", "posts.category_id", "categories.id")->get();
        }

        return response()->json([
            "result" => $postData
        ]);
    }

    // news detail
    public function newsDetail(Request $request) {
        $new = Post::where("id", $request->id)->first();

        return response()->json([
            "new" => $new
        ]);
    }

    // post view count
    public function postViewCount(Request $request) {
        ActionLog::create([
            "user_id" => $request->userId,
            "post_id" => $request->postId
        ]);

        $actionLog = ActionLog::where("post_id", $request->postId)->get();

        return response()->json([
            "actionLog" => $actionLog
        ]);
    }
}
