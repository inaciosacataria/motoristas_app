<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class UserNotification extends Mailable
{
    use Queueable, SerializesModels;


    protected $nome;

    public function __construct($nome)
    {

      $this->nome = $nome;

      return $this->from('info@motoristas.co.mz')
      ->subject('Mailtrap Confirmation')
      ->markdown('mails.userNotificationAdmin')
      ->with([
            'name' =>$this->nome,
            'link' => 'motoristas.co.mz',
        ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notificacao de motoristas.co.mz',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.home',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {

    }

    public function build()
    {
        return $this->from('info@motoristas.co.mz')
        ->subject('Mailtrap Confirmation')
        ->markdown('mails.userNotificationAdmin')
        ->with([
              'name' =>$this->nome,
              'link' => 'motoristas.co.mz',
          ]);
    }
}
