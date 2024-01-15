<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function showPromotion()
    {
        $users = User::all();
        return view('admin.admin_promote', compact('users'));
    }

    public function submitPromotion(Request $request)
    {
$userId = $request->input('user_id');
$user = User::find($userId);

$user->isAdmin = true;
$user->save();

return redirect()->back()->with('success','User promoted to admin successfully');
    }


}
