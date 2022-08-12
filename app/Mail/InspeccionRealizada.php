<?php

namespace App\Mail;

use App\Models\Foto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InspeccionRealizada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($propuesta)
    {   
        $this->propuesta = $propuesta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $files = Foto::where('inspeccion_id',$this->propuesta->inspeccion->id)->get();
        
        $mailer = $this->subject('🚗 Inspección realizada | Propuesta #'. $this->propuesta->numero_propuesta)->markdown('emails.inspeccionrealizada');
        
        foreach($files as $file){
            $mailer = $this->attach(public_path($file->url));
        }
        return $mailer;

            
    }
}
