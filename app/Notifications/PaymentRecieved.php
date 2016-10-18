<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class PaymentRecieved extends Notification
{
    use Queueable;
    
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }
    
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->success()
            ->content('You have mule!')
            ->attachment(function ($attachment) {
                 $attachment->title('Payment', url('/payments/1'))
                    ->fields([
                        'Amount' => '£19.00',
                        'From'   => $this->user->name
                    ]);
            }); 
    }

    
}
