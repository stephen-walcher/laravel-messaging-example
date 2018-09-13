<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Http\Request;

use \App\Jobs\SendMessageJob;

use Session;
use Redirect;

class MessageController extends BaseController
{

    public function send(Request $req)
    {
        // Grab the input variables
        $recipients = $req->input('recipients');
        $messageBody = $req->input('body');

        $sendDate = $req->input('date');
        $sendTime = $req->input('time');

        // Integrity check to see if any recipients have been checked
        if (is_null($recipients)) {
            // No recipients were checked. Send the user back to the page with a message and form data flashed
            Session::flash('error', 'No recipients were chosen. Please try again.');
            Session::flash('body', $messageBody);

            return Redirect::back();
        }

        // Recipients were checked. So, now we test to see if a delivery date was provided
        if (is_null($sendDate)) {
            // No date was sent, so we need to immediately dispatch the Job
            SendMessageJob::dispatch($recipients, $messageBody);

            // Message sent! Let's flash a message to the user
            Session::flash('message', 'Your message has been sent!');

        } else {
            // Date to send was provided. Calculate the time from now and dispatch a delayed Job
            $diffSeconds = strtotime("{$sendDate} {$sendTime}") - time();

            SendMessageJob::dispatch($recipients, $messageBody)
                ->delay(now()->addSeconds($diffSeconds));

            // Message was successfully queued. Let's let the user know that, too.
            Session::flash('message', 'Your message has been queued! It will send at its assigned time.');
        }

        // Send the user back to the admin dashboard
        return Redirect::back();
    }
}
