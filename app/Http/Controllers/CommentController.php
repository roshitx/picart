<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'content' => 'string|max:60|required',
            'gallery_id' => 'required|exists:galleries,id'
        ]);

        $validate['user_id'] = Auth::user()->id;
        Comment::create($validate);

        return redirect()->back()->with('success', 'Successfully commented on a post.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', "Successfully delete a comment.");
    }
}
