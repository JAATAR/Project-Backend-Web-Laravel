<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function post_page()
    {
        return view('home.post_page');
    }


public function add_post(Request $request)
{

    $user = Auth()->user();



$post = new Post();

$post->title = $request->title;

$post->description = $request->description;

$post->post_status = 'active';
$post->publishing_date = now();



$image =$request->image;

if($image)
{
    $imagename = time().'.' . $image->getClientOriginalExtension();
    $request->image->move('postimage',$imagename );

    $post ->image = $imagename;


}



$post->save();
return redirect()->back()->with('message','Post saved successfully');

}

public function show_post()
{

$post = Post::all();

    return view('home.show_post',compact('post'));
}

public function delete_post($id)
{
$post = Post::find($id);
$post->delete();

return redirect()->back()->with('message', 'Post deleted successfully');
}
public function edit_page($id)
{
$post = Post::find($id);
return view('home.edit_page',compact('post'));

}
public function update_post(Request $request, $id)
{

$data = Post::find($id);
$data->title=$request->title;
$data->description=$request->description;
$image = $request->image;

if($image)
{

    $imagename = time().'.' . $image->getClientOriginalExtension();
    $request->image->move('postimage',$imagename );

    $data ->image = $imagename;

}

$data->save();

return redirect()->back()->with('message','Post successfully updated');


}



}
