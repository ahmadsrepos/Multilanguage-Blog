<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\User;

//Helpers
use Datatables, Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index');
    }

    public function usersList(Request $r)
    {
        $users = User::withTrashed()->get();
        $users = Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('actions', function($row)
        {
            $data = '';

            if($row->trashed())
            {
                if(auth()->user()->can('update', $row))
                {
                    $data .='<a href="'.Route("users.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                    <i class="fa-solid fa-pen"></i><a>';
                }
                if(auth()->user()->can('restore', $row))
                {
                    $data .='<a data-id ="'.$row->id.'" class="restore-btn btn btn-sm btn-warning" data-toggle="modal" data-target="#restoreModal">
                    <i class="fa-solid fa-trash-can-arrow-up"></i><a>';
                }
                if(auth()->user()->can('forceDelete', $row))
                {
                    $data .='<a data-id ="'.$row->id.'" class="finalDelete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#finalDeleteModal">
                    <i class="fa-solid fa-circle-xmark"></i><a>';
                }
                
            }
            else
            { 
                if(auth()->user()->can('update', $row))
                {
                    $data .='<a href="'.Route("users.edit", $row->id).'" class="edit btn btn-sm btn-primary">
                    <i class="fa-solid fa-pen"></i><a>';
                }
                if(auth()->user()->can('delete', $row))
                {
                    $data .='<a data-id ="'.$row->id.'" class="delete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa-solid fa-trash text-light"></i><a>';
                }
            }

            return $data;
            
        })
        ->addColumn('status', function($row)
        {
            $status = NULL;
            switch ($row->status) {
                case 'admin':
                    $status = __('words.admin');
                    break;
                case 'writer':
                    $status = __('words.writer');
                    break;
                case NULL:
                    $status = __('words.not_activated');
                    break;

            }

            return $status;
        })
        ->rawColumns(['actions', 'status'])
        ->make(true);
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', auth()->user());

        return view('dashboard.users.create');
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

        $rules = 
        [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'status' => 'nullable|in:admin,user',
            'password' => 'required'
        ];

        $request->password = Hash::make($request->password);

        $data = $request->validate($rules);

        User::create($data);


        return redirect()->route('users.index');
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
        $user = User::find($id);

        $this->authorize('update', $user);

        $user = User::find($id);
        return view('dashboard.users.edit', compact('user'));
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
        $user = User::find($id);

        $this->authorize('update', $user);

        $rules = 
        [
            'email' => 'required|email|unique:users,email,'.$id,
            'name' => 'required',
            'status' => 'nullable|in:admin,user'
        ];
        
        $data = $request->validate($rules);

        if(auth()->user()->status != 'admin')
        {
            if($request->status)
            {
                $request->request->remove('status');
            }
        }
        
        User::find($id)->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $this->authorize('delete', $user);

        user::find($id)->delete();

        return redirect()->route('users.index');
    }

    public function restore($id)
    {
        $user = User::find($id);

        $this->authorize('delete', $user);

        user::withTrashed()->find($id)->restore();

        return redirect()->route('users.index');
    }

    public function finalDelete($id)
    {
        $user = User::find($id);

        $this->authorize('delete', $user);

        user::withTrashed()->find($id)->forceDelete();

        return redirect()->route('users.index');
    }
}
