<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Support\Facades\Notification;

//user notificaciones
use App\Notifications\NotificationUser;//este es el notification de usuario
// use Illuminate\Support\Facades\Notification;
// use Illuminate\Notifications\Notifiable;


class NotificationController extends ApiController
{
    // use Notifiable; TODO: creo que no hace falta

    public function __construct()
    {
        // $this->middleware('auth:api');
    }
 
    public function index()
    {
        // // user 2 sends a message to user 1
        // $message = new Message;
        // $message->setAttribute('from', 2);
        // $message->setAttribute('to', 1);
        // $message->setAttribute('message', 'Demo message from user 2 to user 1.');//lee una variable y guarda el mensaje de un usuario a otro en el sistema y manda un correo  a lo mejor implementar para audiovisuales (debe generarse en la base de datos tambien)
        // $message->save();
         
        //  // $toUser = Auth::user();
        //  $toUser = User::findOrFail(1);
        //  $fromUser = $event->user;

        // $fromUser = User::find(2);
        // $toUser = User::find(1);
         
        // // send notification using the "user" model, when the user receives new message
        // $toUser->notify(new NewMessage($fromUser));
         
        // // send notification using the "Notification" facade
        // Notification::send($toUser, new NewMessage($fromUser));


//TODO: solo para evento
        //         // $user = User::findOrFail(2);
        // $notification = Notification::send($user, new NotificationUser());
        // Notification::send($toUser, new NotificationUser($fromUser));

        // // // $user->notify(new NotificationUser);
        // $toUser->notify(new NotificationUser($fromUser));

    }


    public function message(Request $request)//accede a las notificaciones de un usuario
{

    // $fromUser = Auth::user();
    // $fromUser = User::findOrFail(Auth::user()->id);
    $fromUser = User::findOrFail($request->fromUser_id);

    // $fromUser = User::findOrFail(1);
    $toUser = User::findOrFail($request->id);

    $message = new Message;
    $message->setAttribute('from', $fromUser->id);
    $message->setAttribute('to', $toUser->id);
    $message->setAttribute('message', $request->message);//lee una variable y guarda el mensaje de un usuario a otro en el sistema y manda un correo  a lo mejor implementar para audiovisuales (debe generarse en la base de datos tambien)
    $message->save();

    Notification::send($toUser, new NewMessage($fromUser));

    $data = ['data'=>$toUser];
    return $this->showAll($data);

}


public function broadcastMessage(Request $request)//accede a las notificaciones de un usuario
{

    // $fromUser = Auth::user();
    // $fromUser = User::findOrFail(Auth::user()->id);
    $fromUser = User::findOrFail($request->user_id);

    // $fromUser = User::findOrFail(1);
    $toUsers = User::orderBy('id','DESC')->where('company_id','=',$fromUser->company_id)->where('id','!=',$fromUser->id)->get();

            foreach ($toUsers as $toUser) {

            $message = new Message;
            $message->setAttribute('from', $fromUser->id);
            $message->setAttribute('to', $toUser->id);
            $message->setAttribute('message', $request->message);//lee una variable y guarda el mensaje de un usuario a otro en el sistema y manda un correo  a lo mejor implementar para audiovisuales (debe generarse en la base de datos tambien)
            $message->save();

            $when = now()->addseconds(60);
            $toUser->notify((new NewMessage($fromUser))->delay($when));
            // $toUsers->notify(new NewMessage($fromUser));
            // $toUsers->person;

                // foreach ($toUsers->roles as $role) {// m a n
                //     $role->pivot->created_at;
                // }
    
                // $toUsers->company->companytype;
    
            }

        
    $data = ['data'=>$toUsers];
    return $this->showAll($data);

}


public function accessingNotifications(Request $request)//accede a las notificaciones de un usuario
{

    $user = User::findOrFail($request->user_id);

    foreach ($user->notifications as $notification) {
        $notification->type;
    }

    $data = ['data'=>$user];
    return $this->showAll($data);

}


public function accessingNotificationsUnread(Request $request)//accede a las notificaciones de un usuario
{

    $user = User::findOrFail($request->user_id);

    foreach ($user->unreadNotifications as $notification) {
        $notification->type;

    }

    $data = ['data'=>$user];
    return $this->showAll($data);

}

public function markNotificationsRead(Request $request)//Marca como leidas las notificaciones
{

$user = User::findOrFail($request->user_id);

$user->unreadNotifications->markAsRead();

// foreach ($user->unreadNotifications as $notification) {
//     $notification->markAsRead();
// }

    $data = ['data'=>$user];
    return $this->showAll($data);

}

public function show(Request $request)
{
    // dd($request->user_id);

    $user = User::findOrFail($request->user_id);

        foreach ($user->unreadNotifications as $notification) {
        $notification->type;

        if($request->id == $notification->id){
            $notification->update(['read_at' => now()]);

            $data = ['data'=>$notification];
            return $this->showAll($data);

        }

    }


    // $data = ['data'=>$user];
    // return $this->showAll($data);
}

// public function broadcastNotifications()//envio masivo no debe hacerce solo por base de datos
// {


//     // $user = Auth::user();
//     $user = User::findOrFail(1);

//     $toUsers = User::orderBy('id','DESC')->where('company_id','=',$user->compamy_id)->where('id','!=',$user->id)->get();
//     // $users = User::orderBy('id','DESC')->where('company_id','!=',\Auth::user()->company_id)->where('id','!=',\Auth::user()->id)->get();

//     $toUsers->each(function($toUsers){//1 a 1

//     $fromUser = User::findOrFail(1);
//     // $fromUser = Auth::user();


//         $toUsers->notify(new NotificationUser($fromUser));
//                 foreach ($toUsers->roles as $role) {// m a n
//                     $role->pivot->created_at;
//                 }
    
//                 $toUsers->person;
//                 $toUsers->company->companytype;
    
//             });


//             $data = ['data'=>$toUsers];
//             return $this->showAll($data);
// }


// Route::get('mail', function () {
//     $order = App\Order::find(1);

//     return (new App\Notifications\StatusUpdate($order))
//                 ->toMail($order->user);
// });



// public function destroy()
// {
//     $user = User::findOrFail(1);
//     $user->notifications()->delete();

//         $data = ['data'=>$user];
//         return $this->showAll($data);
// }

}
