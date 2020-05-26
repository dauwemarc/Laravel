<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreated extends Notification implements ShouldQueue
{
    use Queueable;


    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('Nouvel utilisateur'))
                    ->line(__("Un nouvel utilisateur s'est enregistré."))
                    ->line(__('Nom : ') . $this->user->name)
                    ->line(__('Email : ') . $this->user->email);
    }
}
