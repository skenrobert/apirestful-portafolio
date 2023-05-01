<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class NewMessage extends Notification
{
    use Queueable;

    public $fromUser;

    public function __construct(User $user)
    {
        $this->fromUser = $user;
    }

    public function via($notifiable)//['nexmo'] 
    {
        // return ['mail'];
        return ['database','mail'];

    }

    public function toMail($notifiable)
    {
        $message = DB::table('messages')->where('to','=', $notifiable->id)->latest()->first();


                    $subject = sprintf('%s: Tienes un Nuevo Mensaje %s!', config('app.name'), $this->fromUser->person->name);
                    $greeting = sprintf('Hola %s!', $notifiable->person->name);
             
                    return (new MailMessage)
                                ->subject($subject)
                                ->greeting($greeting)
                                ->salutation('Saludos')
                                ->line('Se le Informa de.: '.$message->message)
                                ->action('URL de Login en la nube Accion de Notificación', url('/'))
                                ->line('Gracias Por Usar Nuestra Aplicacion!');
    }

    public function toDatabase($notifiable)
    {
     // $log = new Log();
        // $log->logs($request, "registro", "area", $request->description, $request->ip() , \Auth::user()->id, php_uname($_SERVER['REMOTE_ADDR'] ));

        $message = DB::table('messages')->where('to','=', $notifiable->id)->latest()->first();

        return [

           'fromUser' => $this->fromUser->id,
           'fromName' => $this->fromUser->person->name,
        //    'fromUser' => \Auth::user()->id,//TODO:solo funciona login
            'toUser' => $notifiable->id,
            'toUserName' => $notifiable->person->name,
            'info' => $message->message,

        ];
     


    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
