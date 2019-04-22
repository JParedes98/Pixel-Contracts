<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContractCopy extends Notification
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
        $mailMessage = (new MailMessage)
            ->from('contratos@pixel.hn', 'PixelPay')
            ->subject('Copia Contrato PixelPay-'.$notifiable->company_social_reason)
            ->greeting('Felicidades! '. $notifiable->legal_representative_name)
            ->line('Ahora eres parte de una enorme red de Crecimiento E-comerce, Adjunto encontraras una copia del contrato respectivo a PixelPay')
            ->attach(storage_path('contracts/contrato-'.$notifiable->id.'.pdf'),[
                'as' => 'Contrato PixeLPay-' . $notifiable->company_social_reason,
            ]);

        if($notifiable->contract_attachments != NULL){
            $mailMessage->attach( storage_path( 'contract_attachments/Anexo-Contrato-' . $notifiable->id . '.pdf'), [
                'as' => 'Anexo de Contrato'
            ]);
        }

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
