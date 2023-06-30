<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // direct post
    public function index()
    {
        $categoryData = Category::get();
        $postData = Post::select("posts.*", "categories.title as category_title")
            ->leftJoin("categories", "posts.category_id", "categories.id")
            ->when(request("postSearch"), function ($query) {
                $key = request("postSearch");
                $query->orWhere("posts.title", "like", "%" . $key . "%")
                    ->orWhere("posts.description", "like", "%" . $key . "%");
            })
            ->paginate(5);

        return view('admin.post.index', compact('categoryData', 'postData'));
    }

    // direct post create
    public function postCreate(Request $request)
    {
        $this->postValidationCheck($request);

        if ($request->hasFile('postImage')) {
            $file = $request->file('postImage');
            $fileName = uniqid() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/postImage', $fileName);
            $postData = $this->postInsertData($request, $fileName);
        } else {
            $postData = $this->postInsertData($request, $fileName = null);
        }

        Post::create($postData);

        return back();
    }

    // direct post delete
    public function postDelete($id)
    {
        $getDbImageName = Post::select("image")->where("id", $id)->first();
        $getImageName = $getDbImageName->image;

        Post::where("id", $id)->delete();

        if (File::exists(public_path() . '/storage/postImage/' . $getImageName)) {
            File::delete(public_path() . '/storage/postImage/' . $getImageName);
        }

        return back();
    }

    // direct post edit page
    public function postEdit($id)
    {
        $categoryData = Category::get();
        $postData = Post::where("id", $id)->first();

        return view('admin.post.edit', compact('categoryData', 'postData'));
    }

    // post update
    public function postUpdate(Request $request, $id)
    {
        $this->postValidationCheck($request);
        $updatePostData = $this->postUpdateData($request);
        
        // get old file
        $dbData = Post::select("image")->where("id", $id)->first();
        $oldImageName = $dbData->image;

        // get update file
        if ($request->hasFile('postImage')) {
            $file = $request->file('postImage');
            $fileName = uniqid() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/postImage', $fileName);
            $updatePostData["image"] = $fileName;

            // delete old file
            if (File::exists(public_path() . '/storage/postImage/' . $oldImageName)) {
                File::delete(public_path() . '/storage/postImage/' . $oldImageName);
            }
        }

        Post::where("id", $id)->update($updatePostData);

        return redirect()->route('post');
    }

    // post update data 
    private function postUpdateData($request)
    {
        return [
            "category_id" => $request->postCategory,
            "title" => $request->postTitle,
            "description" => $request->postDescription,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
    }

    // post insert data and update data
    private function postInsertData($request, $fileName)
    {
        return [
            "category_id" => $request->postCategory,
            "image" => $fileName,
            "title" => $request->postTitle,
            "description" => $request->postDescription,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
    }

    // post validation check
    private function postValidationCheck($request)
    {
        $validationRules = [
            "postTitle" => "required",
            "postDescription" => "required",
            "postCategory" => "required",
            "postImage" => "mimes:png,jpg,webp,jpeg"
        ];

        Validator::make($request->all(), $validationRules)->validate();
    }
}
