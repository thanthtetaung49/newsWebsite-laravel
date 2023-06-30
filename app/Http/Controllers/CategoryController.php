<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category 
    public function index()
    {
        $categoryData = Category::when(request('categorySearch'), function ($query) {
            $key = request('categorySearch');
            $query
                ->orWhere('title', 'like', '%' . $key . '%')
                ->orWhere('description', 'like', '%' . $key . '%');
        })
            ->paginate(5);

        return view('admin.category.index', compact('categoryData'));
    }

    // direct category submit
    public function categorySubmit(Request $request)
    {
        $this->categoryValidationCheck($request);
        $categoryData = $this->categoryDataInsert($request);
        Category::create($categoryData);

        return back();
    }

    // direct category delete
    public function categoryDelete($id)
    {
        Category::where("id", $id)->delete();

        return back();
    }

    // direct category update
    public function categoryUpdate (Request $request) {
        $categoryUpdateData = $this->categoryUpdateData($request);
        Category::where("id", $request->id)->update($categoryUpdateData);

        return response()->json(["categoryUpdateStatus" => "success"], 200);
    }

    // direct category update data
    private function categoryUpdateData ($request) {
        return [
            "title" => $request->name,
            "description" => $request->description
        ];
    }

    // direct category data insert
    private function categoryDataInsert($request)
    {
        return [
            "title" => $request->categoryName,
            "description" => $request->categoryDescription,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
    }

    // direct category validation check
    private function categoryValidationCheck($request)
    {
        $validationRules = [
            "categoryName" => "required",
            "categoryDescription" => "required"
        ];

        Validator::make($request->all(), $validationRules)->validate();
    }
}
