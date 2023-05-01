<?php



Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('testchannel', function ($user, $id) {
    // return (int) $user->id === (int) $id;

    return true;
});
