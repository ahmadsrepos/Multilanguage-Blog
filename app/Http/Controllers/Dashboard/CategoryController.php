<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Category;

//Helpers
use Datatables, Hash;

//Traits
use App\Http\Traits\MainHelpers;

class CategoryController extends Controller
{
    use MainHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.categories.index');
    }

    public function categoriesList()
    {
        $categories = Category::withTrashed()->get();

        $categories = Datatables::of($categories)
        ->addIndexColumn()
        ->addColumn('title', function($row)
        {
            return $row->title;
        })
        ->addColumn('parent', function($row)
        {
            return $row->parent ? Category::withTrashed()->where('id', $row->parent)->first()->title : __('words.without');
        })
        ->addColumn('actions', function($row)
        {
            $data = '';

            if($row->trashed())
            {
                if(auth()->user()->can('update', $row))
                {
                    $data .= '<a href="'.Route("categories.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                    <i class="fa-solid fa-pen"></i><a>';
                }
                if(auth()->user()->can('restore', $row))
                {
                    $data .= '<a data-id ="'.$row->id.'" class="restore-btn btn btn-sm btn-warning" data-toggle="modal" data-target="#restoreModal">
                    <i class="fa-solid fa-trash-can-arrow-up"></i><a>';
                }
                if(auth()->user()->can('forceDelete', $row))
                {
                    $data .= '<a data-id ="'.$row->id.'" class="finalDelete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#finalDeleteModal">
                    <i class="fa-solid fa-circle-xmark"></i><a>';
                }
            }
            else
            { 

                if(auth()->user()->can('update', $row))
                {
                    $data .= '<a href="'.Route("categories.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                    <i class="fa-solid fa-pen"></i><a>';
                }
                if(auth()->user()->can('delete', $row))
                {
                    $data .= '<a data-id ="'.$row->id.'" class="delete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa-solid fa-trash text-light"></i><a>';
                }
            }

            return $data;
        })
        ->rawColumns(['title', 'parent', 'actions'])
        ->make(true);

        return $categories;
        
    }

    public function categoriesMinors(Request $request)
    {
        $categories = Category::find($request->id)->getChildren;

        return $categories->toArray();
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', auth()->user());
        $categories = Category::where('parent', NULL)->get();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', auth()->user());
        
        //Validatation
        $rules = 
        [
            'image' => 'nullable|image|max:512|mimes:jpg,jpeg,png'
        ];

        foreach(config('app.languages') as $key => $value)
        {
            $rules[$key.'.title'] = 'required|unique:category_translations,title';
        }

        $validatedData = $request->validate($rules);

        $this->validate($request, $rules);

        //Upload Image
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image = $this->UploadImage($image);
        }

        $category = Category::create($request->except('image'));
        Category::find($category->id)->update(['image' => $image]);

        return redirect()->route('categories.index');
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
        $category = Category::find($id);
        $this->authorize('update', $category);

        $categories = Category::where('parent',NULL)->get()->except($id);
        return view('dashboard.categories.edit', compact('category', 'categories'));
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
        $category = Category::find($id);
        $this->authorize('update', $category);

        //Validatation
        $rules = 
        [
            'image' => 'nullable|image|max:512|mimes:jpg,jpeg,png'
        ];

        foreach(config('app.languages') as $key => $value)
        {
            $rules[$key.'.title'] = 'required|unique:category_translations,title,'.$category->translate($key)->id;
        }

        $this->validate($request, $rules);

        //Upload Image
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = $this->UploadImage($image);

            //Delete Old Image
            if(file_exists(public_path('/images/categories/').$category->image))
            {
                unlink(public_path('/images/categories/').$category->image);
            }

            $category->update(['image' => $name]);
        }

        //Update
        $category->update($request->except('image'));

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $this->authorize('delete', $category);

        if($category->getchildren->count() > 0)
        {
            $category->getchildren->map(function($item)
            {
                $item->delete();
            });

            $category->delete();
        }
        else
        {
            $category->delete();
        }

        return redirect()->route('categories.index');
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        $this->authorize('restore', $category);

        if($category->getAllchildren->count() > 0)
        {
            $category->getAllchildren->map(function($item)
            {
                $item->restore();
            });

            $category->restore();
        }
        else
        {
            $category->restore();
        }

        return redirect()->route('categories.index');
    }

    public function finalDelete($id)
    {
        $category = Category::withTrashed()->find($id);
        $this->authorize('forceDelete', $category);

        if($category->getAllchildren->count() > 0)
        {
            $category->getAllchildren->map(function($item)
            {
                $item->forceDelete();
            });

            $category->forceDelete();
        }
        else
        {
            $category->forceDelete();
        }

        return redirect()->route('categories.index');
    }
}
