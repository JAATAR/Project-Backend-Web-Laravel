<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function promoteUser(User $user)
    {

        $user->update(['isAdmin' => 1]);

        return redirect()->back()->with('success', 'User promoted to admin successfully');

    }
}
