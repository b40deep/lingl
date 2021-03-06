<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AlertController;


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
        $this->authorize('user_logged_in');

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
        $comment->user_id = auth()->user()->id; // need to update this 
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
    public function destroy(Comment $comment)
    {
        //
    }

    // BOYD API METHODS

    public function apiIndex(Post $post)
    {
            Log::info('loading comments...');

        // $comments = Comment::all();
        $comments = $post->comments;
        // foreach ($comments as $comment ) {
        //     // Log::info('it workssssssssssss');
        //     $comment['user_id'] = User::findOrFail($comment['user_id'])->name;
        //     Log::info($comment['user_id']);
        // }
        for ($i=0; $i < count($comments); $i++) { 
            // Log::info('for loop');
            // Log::info('___user_id:::'.$comments[$i]['user_id']);
            // Log::info('_______name:::'.auth()->user()->name);
            $name = User::findOrFail($comments[$i]['user_id'])->name;
           $comments[$i]['user_id'] = $name;
        //    if($name==Auth::user()->name)

        }
        // Log::info($comments[0]['user_id']);
        return $comments;
    }

    public function apiStore(Request $request){
        // Log::info('we got this far');
        // Log::info($request['post']. $request['content']);
        // Log::info('user '.$request['user']);
        $edited = $request['edited']==''?false:true;
        Log::info('comment update status '.$edited);
        
        $validData = $request->validate([
            'content' => 'required|max:200'
        ]);

        if($edited){
            Log::info('comment will be updated');
            $comment = Comment::findOrFail($request['edited']);
            $comment->is_edited = true;
        }
        else{
            Log::info('comment will be created');
            $comment = new Comment;
            $comment->is_edited = false;
        }    
            $comment->content = $validData['content'];
            $comment->post_id = $request['post']; // fixed
            $comment->user_id = $request['user']; // fixed
            $comment->save();

            session()->flash('message', 'Thank you for your AJAX translation!');
            $comment['user_id'] = User::findOrFail($comment['user_id'])->name;
            $alertuser = Post::findOrFail($comment['post_id'])->user->id;
       
            // do not try this at home!!!
            // app('App\Http\Controllers\AlertController')->apiStore($request['user'], $request['post'], "New translation available!");
            AlertController::apiStore($alertuser, $request['post'], "New translation available!");

        return $comment;
        
    }

    public function apiDestroy(Request $request){
        Log::info('destroying comment '.$request['content']);
        
        $comment = Comment::findOrFail($request['content']);
        $comment->delete();
        Log::info('done destroying');

        return true;
    }
}
