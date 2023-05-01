<?php

namespace App\Observers;

// use App\Models\Event;

class EventObserver
{

    public function created(Event $event)
    {
        
        dd('From event observer', $event);
    }

    // public function updated(user $user)
    // {
    //     //
    // }

    // public function deleted(user $user)
    // {
    //     //
    // }

    // public function restored(user $user)
    // {
    //     //
    // }

    // public function forceDeleted(user $user)
    // {
    //     //
    // }
}
