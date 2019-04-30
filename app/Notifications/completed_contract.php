<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Mail\Mailable;

class completed_contract extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     protected $toEmail;
     protected $legal_rep_name;

    public function __construct($legal_rep_name)
    {
        $this->legal_rep_name = $legal_rep_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->from('contratos@pixel.hn', 'PixelPay')
            ->subject('Contrato Consolidado' . (empty($notifiable->company_social_reason) ? '' : '-' . $notifiable->company_social_reason))
            ->greeting('Estimad@')
            ->line('Contrato Completado')
            ->line('El contrato respectivo a ' . $this->legal_rep_name . ' fue firmado y completado de forma exitosa.');;

        return $mailMessage;            
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
