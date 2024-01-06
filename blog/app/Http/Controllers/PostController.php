<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
      }


      public function index(){

  //      $posts = Post::latest()->get();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
      }

      public function show($id){
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
      }

      public function create(){
        return view('posts.create');
      }

      public function store(Request $request){

        $validated = $request->validate([
          'title'       => 'required|min:3',
          'content'     => 'required|min:20',
          'image' => 'required|min:1',
          'publishing_date' => 'required|min: 1',
        ]);

        // bij foute content komen we nooit hier, gaat terug naar form met error

        $post = new Post;
        $post->title = $validated['title'];
        $post->message = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();

        $imageName = $post->id .'.'. $request->file->getClientOriginalExtension();
        $request->file->move(public_path('/img blades'), $imageName);

        $post->image = $imageName;
        $post->save();

        return redirect()->route('index')->with('status', 'Post added');

      }

      public function edit($id){
        $post = Post::findOrFail($id);

        if($post->user_id != Auth::user()->id){
          abort(403);
        }

        return view('posts.edit', compact('post'));
      }



      public function update($id, Request $request){
        $post = Post::findOrFail($id);

        if($post->user_id != Auth::user()->id){
          abort(403);
        }

        $validated = $request->validate([
          'title'       => 'required|min:3',
          'content'     => 'required|min:20',
        ]);

        $post->title = $validated['title'];
        $post->message = $validated['content'];
        $post->save();

        return redirect()->route('index')->with('status', 'Post edited');

      }

      public function destroy($id){
        if(!Auth::user()->is_admin){
          abort(403, 'Only admins can delete posts');
        }

        $post = Post::findOrFail($id);
        $likes = Like::where('postId', '=', $post->id)->delete();
        $post->delete();

        return redirect()->route('index')->with('status', 'Post deleted');
      }

}


