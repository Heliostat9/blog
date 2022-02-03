<?php

namespace App\Http\Controllers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate([
            'email' => 'required'
        ]);

        try {
            $newsletter->subscribe(\request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages(['email' => 'Not valid email address!']);
        }

        return redirect('/')->with('success', 'You success subscribe on email newsletter!');
    }
}
