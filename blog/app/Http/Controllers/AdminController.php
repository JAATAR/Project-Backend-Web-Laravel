<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{
    public function post_page()
    {
        return view('admin.post_page');
    }

    public function add_post(request $request)
    {
$user=Auth()->user();
$user_id = optional($user)->id;

    $name =$user->name;

    $usertype =$user->usertype;

    $post=new Post;

    $post->title = $request->title;

    $post->description = $request->description;

    $post->post_status = 'active';

    $post->user_id = $user_id;

    $post->name = $name;

    $post->usertype = $usertype;

    $image =$request->image;


    if ($user) {
        $user_id = $user->id;
        $name = $user->name;
        $usertype = $user->usertype;
    }
    else
    {
        return redirect()->back()->with('error', 'User not authenticated');
    }

    if($image)
    {
        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request ->image-> move ('postimage', $imagename);

        $post->image   =   $imagename;

    }

    $post->save ();

        return redirect()->back()->with('message','post added Succesfully');
    }

    public function show_post()
    {
        $post= post::all();

        return view('admin.show_post',compact('post'));
    }

    public function delete_post($id){

        $post = Post::find($id);

        $post->delete();

       return redirect()->back()->with('message','Post Deleted Succesfully');
    }


    public function edit_page($id) {

        $post = Post::find($id);
        return view('admin.edit_page',compact('post'));
    }


    public function update_post( Request $request, $id)
    {

    $data =  post::find ($id);
    $data->title = $request->title;
    $data->description = $request->description;
    $image = $request->image;


    if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request ->image-> move ('postimage', $imagename);

        $data->image = $imagename;


    }

    $data ->save ();
    return redirect()->back()->with('message','Post Updated Succesfully');

    }

}
