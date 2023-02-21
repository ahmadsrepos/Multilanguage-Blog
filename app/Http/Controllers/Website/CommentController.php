<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Comment;
use App\Models\Post;
use App\Models\Setting;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $setting = Setting::first();
        $msg = __('words.msg_add_success');

        if(!$setting->allow_comments)
        {
            abort(404);
        }

        $rules =
        [   
            'name' => 'required|min:5|max:30',
            'email' => 'required|email:rfc,dns',
            'comment' => 'required|min:4|max:300'
        ];

        $this->validate($request, $rules);

        $post = Post::find($id);
        if(!$post)
        {
            session()->flash('error', __('words.msg_add_error'));
            return back();
        }

        $request->request->add(['post_id' => $id]);

        if($setting->revise_comments)
        {
            $request->request->add(['status' => 0]);
            $msg = __('words.msg_add_revise');
        }

        Comment::create($request->all());

        session()->flash('success', $msg);

        return redirect()->route('post', $id);
    }
}
