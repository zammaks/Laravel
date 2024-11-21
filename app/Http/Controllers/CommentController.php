<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Comment $comment)
    {
        $user = User::findOrFail($comment->user_id);
        return view('article.show', ['comment' => $comment, 'user' => $user]);
    }
}
