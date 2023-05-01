<?php

namespace App\Listeners;

use App\Events\EventCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventCreatedListener
{
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
     * @param  EventCreated  $event
     * @return void
     */
    public function handle($message)
    {
        //dd('From EventCreatedListener', $message);
        // return view('/pages/listenBroadcast');
        // return true;

    }
}
