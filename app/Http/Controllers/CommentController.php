<?php

namespace App\Http\Controllers;
use App\Models\Comment;
// use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class CommentController extends Controller
{       
    public function index()
    {
        $comments = Comment::all();
        return view('comments.show', ['comments' => $comments]);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:3',
            'desc'=>'required|max:256',

        ]);
        $comment = new Comment;
        $comment->name = request('name');
        $comment->desc = request('desc');
        $comment->user_id = Auth::id();
        $comment->article_id = request('article_id');
        $comment->save();
        return redirect()->back()->with('status', 'Comment added successfully! Please check your comments.');
        
    }

    public function delete($id)
    {   
        $comment = Comment::findOrFail($id);
        Gate::authorize('update-comment', $comment );  // added this line
        if ($comment->delete()){
            // return redirect('/article')->with('status', 'Delete successfully!');
            return redirect()->back()->with('status', 'Delete successfully!');
        } else {
            return redirect()->route('article.show',['commment' => $comment->id])->with('status', 'Delete failed! Please try again.');
        }; 
    }

    public function edit($id){
        $comment = Comment::findOrFail($id);
        Gate::authorize('update-comment', $comment );  // added this line
        return view('comments.update', ['comment'=> $comment]);
    }

    public function update(Request $request, Comment $comment){
        Gate::authorize('update-comment', $comment );  // added this line
        $request->validate([
            'name'=>'required|min:5|max:100',
            'desc'=>'required|min:5',
        ]);
        $comment->name = request('name'  );
        $comment->desc = request('desc'  );
        $comment->article_id = request( 'article_id');
        $comment->user_id = request( 'user_id');
        if ($comment->save()) {
            return redirect()->route('article.show',['article' => $comment->article_id])->with('status', 'Update successfully! Please check your updated article.');
        } else {
            return redirect('/comment')->route('comment.edit', ['comment' => $comment->id])->with('status', 'Update failed! Please try again.');
    }
    }
    
}