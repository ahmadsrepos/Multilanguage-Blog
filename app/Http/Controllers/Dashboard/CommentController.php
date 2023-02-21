<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Comment;

//Helpers
use Datatables;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.comments.index');
    }

    public function commentsList()
    {
        $comments = Comment::all();

        $comments = Datatables::of($comments)
        ->addIndexColumn()
        ->addColumn('name', function($row)
        {
            return $row->name;
        })
        ->addColumn('email', function($row)
        {
            return $row->email;
        })
        ->addColumn('comment', function($row)
        {
            return '<textarea class="form-control">'.$row->comment.'</textarea>';
        })
        ->addColumn('status', function($row)
        {
            return $row->name ? 'Published' : 'pending';
        })
        ->addColumn('post', function($row)
        {
            return $row->post_id;
        })
        ->addColumn('actions', function($row)
        {
            $data = '';
    
            if($row->status)
            {

                if(auth()->user()->can('delete', $row))
                {
                    $data .= '
                    <a data-id ="'.$row->id.'" class="delete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa-solid fa-trash text-light"></i><a>
                    ';
                }
            }
            else
            {
                if(auth()->user()->can('update', $row))
                {
                    $data .= '
                    <a href="'.route("comments.verify", $row->id).'" class="edit btn btn-sm btn-primary">
                    <i class="fa-solid fa-circle-check"></i><a>';
                }

                if(auth()->user()->can('delete', $row))
                {
                    $data .= '<a data-id ="'.$row->id.'" class="delete-btn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa-solid fa-trash text-light"></i><a>
                    ';
                }
    
            }

            return $data;
        })
        ->rawColumns(['name', 'email', 'comment', 'status', 'post', 'actions'])
        ->make(true);
    
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function verify($id)
    {
        $comment = Comment::find($id);
        $this->authorize('update', $comment);

        $comment->status = 1;
        $comment->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $this->authorize('delete', $comment);

        $comment->forceDelete();

        return redirect()->back();
    }
}
