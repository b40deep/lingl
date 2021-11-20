<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request['p_content']); it works
        $validData = $request->validate([
            'content' => 'required|max:200',
            'image'=>'image|nullable|mimes:jpg,jpeg,png|max:5000'
        ]);

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            // $path = $request->file('image')->storeAs('public/uploads', $fileNameToStore);
            $request->image->move(public_path('uploads'),$fileNameToStore);
            }
            else{
                $fileNameToStore=null;
                $filename=null;
            }

        $post = new Post;
        $post->content = $validData['content'];
        $post->is_edited = false;
        $post->img_url = $fileNameToStore==null?null:'/uploads/'.$fileNameToStore;
        $post->img_alt_text = $filename==null?null:'an image named '.$filename;
        $post->user_id = 1;
        $post->language_id = 3;
        $post->save();

        session()->flash('message', 'Yay, your post was created!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
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
        // dd($request['p_content']); it works
        $validData = $request->validate([
            'content' => 'required|max:200',
            'image'=>'image|nullable|mimes:jpg,jpeg,png|max:5000'
        ]);

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            // $path = $request->file('image')->storeAs('public/uploads', $fileNameToStore);
            $request->image->move(public_path('uploads'),$fileNameToStore);
        }
        else{
            $fileNameToStore=null;
            $filename=null;
        }

        $post = Post::findOrFail($id);
        $post->content = $validData['content'];
        $post->is_edited = true;
        if($filename!=null){
            $post->img_url = '/uploads/'.$fileNameToStore;
            $post->img_alt_text = 'an image named '.$filename;
        }
        $post->update();

        session()->flash('message', 'Yay, your post was created!');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }


}
