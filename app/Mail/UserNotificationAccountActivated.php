<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class UserNotificationAccountActivated extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;
    protected $company;

    public function __construct($company,$link)
    {
      $this->link=$link;
      $this->company=$company;

      return $this->from('info@motoristas.co.mz')
      ->subject('Mailtrap Confirmation')
      ->markdown('mails.userNotificationAcountActivedMail')
      ->with([
            'name' => $this->company,
            'link' => $this->link
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
            subject: 'A sua conta no Motorista foi activada',
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
        ->markdown('mails.userNotificationAcountActivedMail')
        ->with([
          'name' => $this->company,
          'link' => $this->link
          ]);
    }
}
