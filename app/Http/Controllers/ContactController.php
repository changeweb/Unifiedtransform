<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Handle a public contact form submission.
     *
     * Mirrors the response contract expected by the template's
     * assets/vendor/php-email-form/validate.js: a 200 response with the
     * plain text body "OK" on success, or a non-200 response whose body
     * is the error message to display.
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->first(), 422);
        }

        $data = $validator->validated();

        // No outbound mail transport is configured for this environment,
        // so submissions are recorded to the application log rather than
        // emailed. Once MAIL_* is configured for real, send a Mailable here.
        Log::info('Contact form submission', $data);

        return response('OK', 200)->header('Content-Type', 'text/plain');
    }
}
