<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(6);
        
        return view('website.index', compact('posts'));
    }
}
