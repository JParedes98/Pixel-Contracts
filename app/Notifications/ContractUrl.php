<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContractUrl extends Notification
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
            ->subject('Contrato PixelPay-' . $notifiable->company_social_reason)
            ->greeting('Confirmacion de contrato')
            ->line('Estimad@ ' . $notifiable->legal_representative_name)
            ->line('Hemos recibido y aceptado tu contrato con PixelPay, favor firmar el mismo de forma digital desde el siguiente link.')
            ->line('Gracias por elegirnos.')
            ->action('Contrato Privado de Servicios', route('new-contract', ['key' => $notifiable->id]));
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
