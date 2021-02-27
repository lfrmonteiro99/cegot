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

        $link = 'http://documentocegot.uc.pt/password-recovery/' . $user->recovery_code;

        $data = [];
        $data['link'] = $link;

        $template = $this->details['template'];
        $view = '';
        $subject = '';
        switch ($template) {
            case 'presentation':
                $view = 'emails.presentationEmail';
                $subject = 'Apresentação da nova plataforma do CEGOT - DocumentoCEGOT';
                break;
            case 'recovery':
                $subject = 'Recuperação de password - DocumentoCEGOT';
                $view = 'emails.recoveryEmail';
                break;
            case 'creation':
                $subject = 'Criação de um novo registo - DocumentoCEGOT';
                $view = 'emails.creationEmail';
                break;
        }

        return $this->subject('Apresentação da nova plataforma do CEGOT - Documento Cegot')
            ->view($view, $data);
    }
}
