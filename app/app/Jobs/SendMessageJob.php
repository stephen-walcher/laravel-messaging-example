<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use \App\Events\MessageEvent;

use \App\User;
use \App\Message;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipients;
    protected $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipients, $body)
    {
        $this->recipients = $recipients;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Collect all the recipient names to store in the db
        $recipientNames = [];

        // Loop through all listed recipients
        foreach ($this->recipients as $recipient) {
            // Get the user information about the given recipient
            $recipientUser = \App\User::find($recipient);

            // Add the recipient's name to the array
            $recipientNames[] = $recipientUser->name;

            // Set up an object of data to broadcast to the recipient
            $broadcastData = [
                'userId' => $recipient,
                'message' => $this->body
            ];

            // Broadcast the event with the created data object
            event(new MessageEvent($broadcastData));
        }

        // Create a new Message model
        $message = new \App\Message;

        // Assign information about the message, including the list of recipients we built
        $message->body = $this->body;
        $message->recipients = implode(', ', $recipientNames);

        // Save the Message in the db
        $message->save();

        // We're done!
    }
}
