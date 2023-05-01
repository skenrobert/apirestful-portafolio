<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Notifications\Messages\BroadcastMessage;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class NotificationUser extends Notification
{
    use Queueable;

    // protected $comment;

    public function __construct(User $fromUser)
    {
        $this->fromUser = $fromUser;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
        // return ['mail'];
    
    }
    

    public function toMail($notifiable)
    {
        if(DB::table('events')->where('user_id','=', $notifiable->id)->latest()->first()){
            $event = DB::table('events')->where('user_id','=', $notifiable->id)->latest()->first();

        }else if(DB::table('events')->where('model_id','=', $notifiable->id)->latest()->first()){
            $event = DB::table('events')->where('model_id','=', $notifiable->id)->latest()->first();
        }

            // dd($event);

            $subject = sprintf('%s: Tienes una Nuevo Notificacion %s!', config('app.name'), '');
            $greeting = sprintf('Hola %s!', $notifiable->person->name);
        
            return (new MailMessage)
                        ->subject($subject)
                        ->greeting($greeting)
                        ->salutation('Saludos')
                        ->line('Se le Informa de lo siguiente.: '.$event->observation)
                        ->action('URL del Login en la nube Accion de Notificación', url('/'))
                        ->line('Gracias Por Usar Nuestra Aplicacion!');
    }


    public function toDatabase($notifiable)
    {

     // $log = new Log();
        // $log->logs($request, "registro", "area", $request->description, $request->ip() , \Auth::user()->id, php_uname($_SERVER['REMOTE_ADDR'] ));

        // $event = DB::table('events')->where('user_id','=', $this->fromUser->id)->latest()->first();

        if(DB::table('events')->where('user_id','=', $notifiable->id)->latest()->first()){
            $event = DB::table('events')->where('user_id','=', $notifiable->id)->latest()->first();

        }else if(DB::table('events')->where('model_id','=', $notifiable->id)->latest()->first()){
            $event = DB::table('events')->where('model_id','=', $notifiable->id)->latest()->first();
        }


        return [

           'fromUser' => $this->fromUser->id,
           'fromName' => $this->fromUser->person->name,
        //    'fromUser' => \Auth::user()->id,//TODO:solo funciona login
            'toUser' => $notifiable->id,
            'toUserName' => $notifiable->person->name,
            'event_id' => $event->id,
            'tipoEvento' => $event->event_type_id,
            'observation' => $event->observation,

        //    'comment' => $this->comment,
        //     'post' => Post::find($this->comment->post_id),
        //     'user' => User::find($this->comment->user_id)

        ];
     


    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }



    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'user_id' =>  $this->notification->id,
    //         'type' => get_class($this->notification),
    //     ]);
    // }
}
