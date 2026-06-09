<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class AboutController extends Controller
{
    public function whoWeAre()
    {
        return view('about.who-we-are');
    }

    public function citation()
    {
        return view('about.citation');
    }

    public function contact()
    {
        return view('about.contact');
    }

    public function sendContact(Request $request)
{
    \Log::info('Contact form submitted', $request->all());
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
        'agree' => 'accepted',
    ]);

    \Log::info('Contact form validated', $validated);

    try {
        \Log::info('Sending email to: dataspheremlrepository@gmail.com');
        
        Mail::to('dataspheremlrepository@gmail.com')->send(new ContactFormMail($validated));
        
        \Log::info('Email sent successfully');

        return redirect()->route('about.contact')
            ->with('success', 'Thank you for contacting us!');
                
    } catch (\Exception $e) {
        \Log::error('Contact form email failed: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        
        return redirect()->route('about.contact')
            ->with('error', 'Failed to send message. Error: ' . $e->getMessage());
    }
}
}