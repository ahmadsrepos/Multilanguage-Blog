<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Page;

class PageController extends Controller
{
    public function show($id, $name)
    {
        $page = Page::where('id', $id)->where('name', $name)->first();

        if(!$page)
        {
            return abort(404);
        }

        return view('website.pages.page', compact('page'));
    }
}
