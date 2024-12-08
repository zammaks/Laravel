<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Article;
use App\Jobs\VryLongJob;



// use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;




use Illuminate\Http\Request;

class CommentController extends Controller
{       
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('comments.show', ['comments' => $comments]);
    }

    public function store(Request $request){
        $article = Article::findOrFail($request->article_id);
        $request->validate([
            'name'=>'required|min:3',
            'desc'=>'required|max:256',

        ]);
        $comment = new Comment;
        $comment->name = request('name');
        $comment->desc = request('desc');
        $comment->user_id = Auth::id();
        $comment->article_id = request('article_id');
        if ($comment->save()){
            VryLongJob::dispatch($comment,$article->name);
            return redirect()->back()->with('status', 'Сomment has been saved and is awaiting moderation.');
        
    }}

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

    public function accept(Comment $comment){
        $comment->accept=true;
        $comment->save();
        return redirect()->route('comment.index');
    }

    public function reject(Comment $comment){
        $comment->accept=false;
        $comment->save();
        return redirect()->route('comment.index');
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