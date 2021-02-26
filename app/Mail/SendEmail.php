<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
$user = User::whereEmail($this->details['to'])->first();

$link = 'http://documentocegot.uc.pt/password-recovery/'.$user->recovery_code;

$data = [];
$data['link'] = $link;

return $this->subject('Apresentação da nova plataforma do CEGOT - Documento Cegot')
                    ->view('emails.presentationEmail', $data);
        return $this->view('view.name');
    }
}
