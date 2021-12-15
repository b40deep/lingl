<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Log;



class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        //
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

    public function apiIndex(Request $request){
        Log::info('checking for alerts... ');
        Log::info('user '.$request['user_id']);

        // $alerts = Alert::paginate(5);
        $alerts = User::findOrFail($request['user_id'])->alerts;
        for ($i=0; $i < count($alerts); $i++) { 
            $post = Post::findOrFail($alerts[$i]['user_id'])->content; //keeping post_id and replacing user_id with post contents preview
           $alerts[$i]['user_id'] = substr($post, 0, 10);
        }
        Log::info('all alerts '.$alerts);
        return $alerts;
        // return view('dashboard', ['alerts' => $alerts]);
    }
}
