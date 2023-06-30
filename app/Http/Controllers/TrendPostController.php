<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    // direct trend post
    public function index()
    {
        $trendPosts = ActionLog::select("action_logs.*", "posts.*")
            ->leftJoin("posts", "action_logs.post_id", "posts.id")
            ->paginate(10);
        return view('admin.trendPost.index', compact('trendPosts'));
    }

    // direct trend post detail
    public function trendPostDetail($id)
    {
        $post = Post::where("id", $id)->first();

        // dd($post->toArray());
        return view('admin.trendPost.detail', compact("post"));
    }
}
