<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GenerateContract extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return (new MailMessage)
                ->from('contratos@pixel.hn', 'PixelPay')
                ->subject('Contrato PixelPay')
                ->greeting('Buen dia')
                ->line('Estimado (a) ' . $notifiable->name_rep)
                ->line('Adjunto se encuentra el link donde puede generar su contrato y completar el mismo de forma digital.')
                ->line('Gracias por elegirnos.')
                ->action('Contrato Privado de Servicios', route('contrato.nuevo', ['key' => $notifiable->hashID()]));
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
