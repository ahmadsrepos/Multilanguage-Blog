<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Post;

//Events
use App\Events\PostView;

class PostController extends Controller
{
    public function show(Post $post)
    {  
        $next = Post::whereCategoryId($post->category_id)->find($post->id + 1);
        $previous = Post::whereCategoryId($post->category_id)->find($post->id - 1);
        $similars = $post->category->posts->take(3);
        $comments = $post->comments->where('status', 1);
        
        event(new PostView($post));

        return view('website.posts.post', compact('post', 'next', 'previous', 'similars', 'comments'));
    }

    public function search(Request $request)
    { 
        if(trim($request->search) == '')
        {
            return back();
        }

       $posts = Post::whereTranslationLike('title', '%'.$request->search.'%')->paginate(6);

        return view('website.posts.search')->with('posts', $posts);
    }
}
