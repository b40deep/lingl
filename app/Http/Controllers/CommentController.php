<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request['post']); //passes the post id not the actual post.
        // dd($request['content']); 
        //it works

        $validData = $request->validate([
            'content' => 'required|max:200'
        ]);

        $comment = new Comment;
        $comment->content = $validData['content'];
        $comment->is_edited = false;
        $comment->post_id = $request['post']; // need to update this
        $comment->user_id = 1; // need to update this 
        $comment->save();

        session()->flash('message', 'Thank you for your translation!');
        // return redirect()->route( 'posts.show', ['id' => 3]);  // need to update this 
        return redirect()->route( 'posts.index');  
        
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
    public function destroy($id)
    {
        //
    }

    // BOYD API METHODS

    public function apiIndex(Post $post)
    {
        // $comments = Comment::all();
        $comments = $post->comments;
        // foreach ($comments as $comment ) {
        //     // Log::info('it workssssssssssss');
        //     $comment['user_id'] = User::findOrFail($comment['user_id'])->name;
        //     Log::info($comment['user_id']);
        // }
        for ($i=0; $i < count($comments); $i++) { 
            // Log::info('for loop');
            Log::info($comments[$i]['user_id']);
           $comments[$i]['user_id'] = User::findOrFail($comments[$i]['user_id'])->name;
        }
        // Log::info($comments[0]['user_id']);
        return $comments;
    }
}
