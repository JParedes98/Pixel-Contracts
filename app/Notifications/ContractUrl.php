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
                    ->subject( 'Contrato PixelPay-' . $notifiable->company_social_reason)
                    ->greeting( 'Estimado (a) ' . $notifiable->legal_representative_name)
                    ->line('Su contrato se ha generado de forma exitosa, adjunto se encuentra el link de su contrato respectivo de PixelPay.')
                    ->line('Gracias.')
                    ->action('Contrato Privado de Servicios', route('contract-preview', [
                        'id' => $notifiable->id
                    ]));
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
