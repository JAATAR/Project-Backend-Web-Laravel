<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post=Post::all();
        if (Auth::id())
        {
            $usertype = Auth::user()->usertype;
            if($usertype == 'user')
            {
                return view('welcome');
            } elseif($usertype == 'admin')
            {
                return view('dashboard');
            }
            else
            {
                return redirect()->back();
            }
        }
    }
public function post(){
    return view('post');
}

public function post_details($id)
{
    $post = Post::find($id);
    return view('posts.post_details',compact('post'));
}
public function create_post()
{
    return view('posts.create_post');
}
public function user_post(Request $request)
{
    $user=Auth()->user();
    $userid=$user->id;

$username=$user->name;

$usertype=$user->usertype;

$post = new Post();

$post->title = $request->title;

$post->description= $request->description;



$post->user_id=$userid;

$post->name=$userid;

$post->usertype=$usertype;

$post ->post_status='pending';



$image= $request->image;

if($image){

    $imagename=time().'.'.$image->getClientOriginalExtension();

    $request->image->move('postimage',$imagename);

    $post->image=$imagename;
}


$post -> save();
return redirect()->back();


}


}




