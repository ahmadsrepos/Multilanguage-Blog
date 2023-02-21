<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Category;
use App\Models\Post;

//Helpers
use Datatables;

//Traits
use App\Http\Traits\MainHelpers;

class PostController extends Controller
{
    use MainHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index');
    }

    public function postsList()
    {
        $posts = Post::withTrashed()->get();

        $posts = Datatables::of($posts)
        ->addIndexColumn()
        ->addColumn('title', function($row)
        {
            return $row->title;
        })
        ->addColumn('actions', function($row)
        {
            $data = '';

            if($row->trashed())
            {
                if(auth()->user()->can('update', $row))
                {
                    $data .= '
                    <a href="'.Route("posts.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                    <i class="fa-solid fa-pen"></i><a>
                    ';
                }

                if(auth()->user()->can('restore', $row))
                {
                    $data .= '
                    <a data-id ="'.$row->id.'" class="restore-btn btn btn-sm btn-warning" data-toggle="modal" data-target="#restoreModal">
                    <i class="fa-solid fa-trash-can-arrow-up"></i><a>
                    ';
                }

                if(auth()->user()->can('forceDelete', $row))
                {
                    $data .= '
                    <a data-id ="'.$row->id.'" class="finalDelete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#finalDeleteModal">
                    <i class="fa-solid fa-circle-xmark"></i><a>
                    ';
                }
            }
            else
            { 

                if(auth()->user()->can('update', $row))
                {
                    $data .= '
                    <a href="'.Route("posts.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                    <i class="fa-solid fa-pen"></i><a>
                    ';
                }

                if(auth()->user()->can('delete', $row))
                {
                    $data .= '
                    <a data-id ="'.$row->id.'" class="delete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa-solid fa-trash text-light"></i><a>
                    ';
                }
            }

            return $data;
        })
        ->rawColumns(['title', 'actions'])
        ->make(true);

        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent', NULL)->get();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = 
        [
            'maincategory' => 'required_without:minorcategory',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:512',
        ];

        foreach(config('app.languages') as $key => $value)
        {
            $rules[$key.'.title'] = 'required';
            $rules[$key.'.content'] = 'required';
            $rules[$key.'.smalldesc'] = 'required';
        }
        
        $this->validate($request, $rules);

        if($request->minorcategory)
        {
            $request->request->add(['category_id' => $request->minorcategory]);
        }
        else
        {
            $request->request->add(['category_id' => $request->maincategory]);
        }

        $request->request->remove('maincategory');
        $request->request->remove('minorcategory');
        $request->request->add(['user_id' => auth()->user()->id]);

        $post = Post::create($request->except('image'));

        //Upload Image
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image = $this->UploadImage($image, 'post');

            Post::find($post->id)->update(['image' => $image]);
        }

        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::withTrashed()->find($id);
        $this->authorize('update', $post);

        $categories = Category::where('parent', NULL)->get();
        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::withTrashed()->find($id);
        $this->authorize('update', $post);

        $rules = 
        [
            'maincategory' => 'required_without:minorcategory',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:512',
        ];

        foreach(config('app.languages') as $key => $value)
        {
            $rules[$key.'.title'] = 'required';
            $rules[$key.'.content'] = 'required';
            $rules[$key.'.smalldesc'] = 'required';
        }
        
        $this->validate($request, $rules);

        if($request->minorcategory)
        {
            $request->request->add(['category_id' => $request->minorcategory]);
        }
        else
        {
            $request->request->add(['category_id' => $request->maincategory]);
        }

        $request->request->remove('maincategory');
        $request->request->remove('minorcategory');

        $post->update($request->except('image'));

        //Upload Image
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image = $this->UploadImage($image, 'post');

            //Delete OLd Image
            if(file_exists(public_path('/images/posts/').$post->image))
            {
                unlink(public_path('/images/posts/').$post->image);
            }

            $post->update(['image' => $image]);
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        $this->authorize('restore', $post);
        $post->restore();

        return redirect()->route('posts.index');
    }

    public function finalDelete($id)
    {
        $post = Post::withTrashed()->find($id);
        $this->authorize('forceDelete', $post);
        $post->forceDelete();

        return redirect()->route('posts.index');
    }
    
}
