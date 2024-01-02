<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */ public function edit(Request $request): View
    {
        // fetch the data of current user
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user();



        $user->fill([
            'username' => $request->input('name'),
            'email' => $request->input('email'),
            'birthday' => $request->input('birthday'),
            'short_bio' => $request->input('short_bio'),


        ]);


        if ($request->hasFile('avatar')) {


            // Get the original file name
            $originalFileName = $request->file('avatar')->getClientOriginalName();

            // Generate a unique file name
            $tempFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();

            //replace spaces with an underscore
            $avatarFileName = str_replace(' ', '_', $tempFileName);

            // Store the file on the webserver with a custom name
            $request->file('avatar')->storeAs('avatars', $avatarFileName, 'public');



            // Save the file path in the database
            $user->fill([
                'avatar' => 'avatars/' . $avatarFileName
            ]);
        }





        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
