<?php

namespace App\Providers;

use App\Models\Subscribe;
use App\Providers\PublishedPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\PublishedPost  $event
     * @return void
     */
    public function handle(PublishedPost $event)
    {
        $users = Subscribe::where([
            'author_id' => $event->post->author->id
        ])->get();


        foreach ($users as $user) {
            Mail::to($user->author->email)->send(new \App\Mail\PublishedPost($event->post));
        }
    }
}
