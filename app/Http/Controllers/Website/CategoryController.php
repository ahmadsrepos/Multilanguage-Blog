<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($category)
    {
        $category = Category::find($category);

        if(!$category)
        {
            abort(404);
        }

        $posts = Post::whereCategoryId($category->id)->paginate(6);
       
        return view('website.categories.category', compact('posts', 'category'));
    }
}
