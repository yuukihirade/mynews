<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\News;

class CommentController extends Controller
{
    //
    public function add(Request $request)
    {
        $news_id = $request->id;
        return view('news.comment_create', ['news_id' => $news_id]);
    }
    
    public function create(Request $request)
    {
        // dd($request);
        $this->validate($request, Comment::$rules);
        
        $comment = new Comment;
        $form = $request->all();
        
        unset($form['_token']);
        
        $comment->fill($form)->save();
        
        return redirect('/');
    }
    
    public function show(Request $request)
    {
        // dd('show');
        $news = News::find($request->id);
        $news_id = $request->id;
        $comments = Comment::orderBy('created_at', 'desc')->where('news_id',$news_id)->get();
        if (empty($news)){
            abort(404);
        }
        
        return view('news.comment_show', ['comments' => $comments]);
    }
}
