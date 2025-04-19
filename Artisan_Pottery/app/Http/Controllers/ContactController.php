<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index()
    {
        return view('store.contact');
    }

    /**
     * Send the contact form.
     */
    public function send(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'privacy_policy' => 'required',
        ]);

        try {
            // Create email content
            $emailContent = "You have received a new message from the contact form on your website.\n\n" .
                "Name: " . $validated['first_name'] . ' ' . $validated['last_name'] . "\n" .
                "Email: " . $validated['email'] . "\n" .
                "Phone: " . ($validated['phone'] ?? 'Not provided') . "\n" .
                "Subject: " . $validated['subject'] . "\n\n" .
                "Message:\n" . $validated['message'] . "\n\n" .
                "This email was sent from the contact form on Artisan Pottery website.";
            
            // Log the message for backup
            Log::info('Contact form submission:', [
                'content' => $emailContent,
                'from' => $validated['email'],
                'to' => 'khammali26@gmail.com',
                'subject' => 'New Contact Form Submission: ' . $validated['subject']
            ]);
            
            // Send actual email
            $recipientEmail = 'khammali26@gmail.com';
            
            Mail::raw($emailContent, function ($message) use ($validated, $recipientEmail) {
                $message->to($recipientEmail)
                       ->subject('New Contact Form Submission: ' . $validated['subject'])
                       ->replyTo($validated['email'], $validated['first_name'] . ' ' . $validated['last_name']);
            });
            
            // Return with success message
            return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            // Log detailed error
            Log::error('Failed to process contact form:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return with detailed error message for debugging
            return redirect()->route('contact')->with('error', 'Error: ' . $e->getMessage());
        }
    }
} 