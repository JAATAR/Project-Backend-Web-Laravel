<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
class ContactController extends Controller
{
    public function index()
    {

    }
    public function create()
    {
        return view('contacts.contact-us');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'naam' => 'required',
            'email' => 'required|email',
            'bericht' => 'required',
        ]);

        Mail::to('info.cleaningblog@gmail.com')->send(new ContactMail($validatedData));

        return back()->with('success', 'Your message is send.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
