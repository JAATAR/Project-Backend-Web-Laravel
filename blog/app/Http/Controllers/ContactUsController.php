<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
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



        Mail::to('5c5cc109a5-15482e+1@inbox.mailtrap.io')->send(new ContactMail($validatedData));

        return back()->with('success', 'Your message is send.');
    }
}
