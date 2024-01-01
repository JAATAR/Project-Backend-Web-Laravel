<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        //retrieving posts by publishing date so i can show them on the blade in chronological order
        $posts = Post::OrderBy('publishing_date', 'desc')->get();

        return view('dashboard', compact('posts'));
    }

    public function search(Request $request)
    {
        // we get the searched username from the request
        $search = $request->input('search');

        // returning the same blade that expects posts
        $posts = Post::orderBy('publishing_date', 'desc')->get();

        //we use it in the query
        $users = User::where('username', 'like', '%' . $search . '%')->get();

        return view('dashboard', compact('users', 'search', 'posts'));
    }

    //user from search result is passed to this controller
    public function showProfile(User $user): View
    {
        //the user info is passed via this function to the profile page
        return view('profile.profile-page', compact('user'));


    }

}
