<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Page;

//Helpers
use Datatables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', auth()->user());

        return view('dashboard.pages.index');
    }

    public function pagesList()
    {
        $this->authorize('viewAny', auth()->user());

        $pages = Page::withTrashed()->get();

        $pages = Datatables::of($pages)
        ->addIndexColumn()
        ->addColumn('name', function($row)
        {
            return $row->name;
        })
        ->addColumn('title', function($row)
        {
            return $row->title;
        })
        ->addColumn('actions', function($row)
        {
            if($row->trashed())
            {

                '<a href="'.Route("pages.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                <i class="fa-solid fa-pen"></i><a>
                <a data-id ="'.$row->id.'" class="restore-btn btn btn-sm btn-warning" data-toggle="modal" data-target="#restoreModal">
                <i class="fa-solid fa-trash-can-arrow-up"></i><a>
                <a data-id ="'.$row->id.'" class="finalDelete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#finalDeleteModal">
                <i class="fa-solid fa-circle-xmark"></i><a>';
            }
            else
            { 
                '<a href="'.Route("pages.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                <i class="fa-solid fa-pen"></i><a>
                <a data-id ="'.$row->id.'" class="delete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                <i class="fa-solid fa-trash text-light"></i><a>';
            }

            return $data;
        })
        ->rawColumns(['name', 'title', 'actions'])
        ->make(true);

        return $pages;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', auth()->user());

        return view('dashboard.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //, auth()->user()
        $this->authorize('create', auth()->user());

        $rules = 
        [
            'name' => 'required|unique:pages,name',
        ];

        foreach(config('app.languages') as $key => $value)
        {
            $rules[$key.'.title'] = 'required';
            $rules[$key.'.content'] = 'required';
        }
        
        $this->validate($request, $rules);

        Page::create($request->all());

        return redirect()->route('pages.index');
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
        $page = Page::find($id);
        
        $this->authorize('update', $page);

        return view('dashboard.pages.edit', compact('page'));
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
        $page = Page::find($id);

        $this->authorize('update', $page);

        $rules = 
        [
            'name' => 'required|unique:pages,name,'.$id,
        ];

        foreach(config('app.languages') as $key => $value)
        {
            $rules[$key.'.title'] = 'required';
            $rules[$key.'.content'] = 'required';
        }
        
        $this->validate($request, $rules);

        $page->update($request->all());

        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $this->authorize('delete', $page);
        $page->delete();

        return redirect()->route('pages.index');
    }

    public function restore($id)
    {
        $page = Page::withTrashed()->find($id);
        $this->authorize('restore', $page);
        $page->restore();

        return redirect()->route('pages.index');
    }

    public function finalDelete($id)
    {
        $page = Page::withTrashed()->find($id);
        $this->authorize('forceDelete', $page);
        $page->forceDelete();

        return redirect()->route('pages.index');
    }
}
