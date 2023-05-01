<?php

namespace Illuminate\Notifications;

trait RoutesNotifications
{


public function notify(){

    app(Dispatcher::class)->send($this, $instance);
}


public function notifyNow($instance, array $channels=null){

    app(Dispatcher::class)->sendNow($this, $instance, $channels);

}

public function routeNotificationFor($driver, $notification = null){

    if(method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))){
        return $this->{$method}($notification);

    }

    switch($i){
            case'database':
                return $this->notifications();

                case'mail':
                    return $this->notifications();          
    
    }

}


}