<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('post')->latest()->paginate(10);
        return view('comments.index', compact('comments'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('posts.index');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);
    
        Comment::create([
            'content' => $request->content,
            'post_id' => $articleId, // Assuming 'post_id' links to 'posts'
        ]);
    
        return redirect()->route('posts.show', $articleId)
                         ->with('success', 'Comment added successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);
    
        $comment->update([
            'content' => $request->content,
        ]);
    
        return redirect()->route('posts.show', $comment->post_id)
                         ->with('success', 'Comment updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $articleId = $comment->post_id; // Save post ID for redirection
        $comment->delete();
    
        return redirect()->route('posts.show', $articleId)
                         ->with('success', 'Comment deleted successfully.');
    }
    
}
