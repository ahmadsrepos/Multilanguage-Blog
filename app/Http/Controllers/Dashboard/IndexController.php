<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::all()->count();
        $comments = Comment::all()->count();
        //$views = Post::withTrashed()->get()->sum('views');
        $views = array_sum(Post::withTrashed()->pluck('views')->toArray());
        $categories = Category::all()->count();

        return view('dashboard.index', compact('posts', 'comments', 'views', 'categories'));
    }
}
