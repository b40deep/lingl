<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use App\Models\View;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // var_dump('posts index___'.Post::with('tags','images')->get()->first()->tags );
        // Log::info('posts index___'.Post::with('images')->get()->tags );
        $this->authorize('user_logged_in');
            
        // $posts = Post::all();
        $posts = Post::with('images','tags')->paginate(6); //pagination code
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('user_logged_in');

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
        $this->authorize('user_logged_in');

        // dd($request['content']); it works
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
        // $post->img_url = $fileNameToStore==null?null:'/uploads/'.$fileNameToStore;
        $post->img_alt_text = $filename==null?null:'an image named '.$filename;
        $post->user_id = auth()->user()->id; 
        $post->language_id =  auth()->user()->language->id;
        $post->save();
        $post->tags()->attach($post->id,['tag_id' => 1]);
        $post->tags()->attach($post->id,['tag_id' => auth()->user()->language->id]);

        Image::create([
            'imageable_id' => $post->id,
            'imageable_type' => 'App\Models\Post',
            'image_url' => $fileNameToStore==null?"":'/uploads/'.$fileNameToStore
        ]);

        session()->flash('message', 'Yay, your post was created!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('user_logged_in');

        // $post = Post::findOrFail($id);

        View::create([             //creating a POST VIEW Count, not some PHP class
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('user_logged_in');

        // $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('user_logged_in');

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

        // $post = Post::findOrFail($id);
        $post->content = $validData['content'];
        $post->is_edited = true;
        if($filename!=null){
            // $post->img_url = '/uploads/'.$fileNameToStore;
            $post->img_alt_text = 'an image named '.$filename;
        }
        $post->update();
        
        $image = Image::where([ ['imageable_id','=',$post->id] , ['imageable_type','=','App\Models\Post'] ])->get()->first();
        
        // dd($image->image_url);
        if($filename!=null){
            // $post->img_url = '/uploads/'.$fileNameToStore;
            // $post->img_alt_text = 'an image named '.$filename;
            $image->image_url = "/uploads/".$fileNameToStore;
        }
        
        $image->update();

        session()->flash('message', 'Yay, your post was udpated!');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('user_logged_in');

        // $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }


}
