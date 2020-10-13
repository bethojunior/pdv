<?php

namespace App\Mail;

use App\Constants\Emails;
use App\Helpers\EmailHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;
    private $body;

    /**
     * MailNotification constructor.
     * @param EmailHelper $emailHelper
     */
    public function __construct(EmailHelper $emailHelper)
    {
        $this->body = $emailHelper;
    }

    /**
     * @return MailNotification
     */
    public function build()
    {
        return $this->from('suporte@fabrica704.com.br', 'Suporte')
            ->replyTo('suporte@fabrica704.com.br','Suporte')
            ->view($this->body->getTemplate())
            ->text($this->body->getBody())
            ->with($this->body->getParamsView());
    }

    /**
     * @param EmailHelper $body
     * @param bool $support
     */
    public static function do(EmailHelper $body ,$support = false)
    {
        if($support){
            $emails = Emails::SUPPORT;
            foreach ($emails as $email){
                Mail::to($email)
                    ->send(new MailNotification($body));
            }
        }
    }
}
