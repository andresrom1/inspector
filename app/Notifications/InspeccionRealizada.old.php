<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \App\Models\Propuesta;

class InspeccionRealizada extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Propuesta $propuesta)
    {
        $this->propuesta = $propuesta;
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
        $str="->attach(public_path('/storage/inspecciones/0IFJJbR7LcFs97g6S5vUNVzJS.png'))";

        $url = url('/inspecciones/' . $this->propuesta->inspeccion->id);
        return (new MailMessage)
                    ->greeting('Hola!')   
                    ->line('El asegurado ha enviado las fotos de la inspeccion correspondiente a la propuesta #' .$this->propuesta->id)
                    ->action('Ver inspeccion', $url)
                    ->line('Gracias por utilizar'. $str . ' la alpicación de Prudens Seguros')
                    ->attach(public_path('/storage/inspecciones/0IFJJbR7LcFs97g6S5vUNVzJS.png'))
                    . $str;
                    
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
