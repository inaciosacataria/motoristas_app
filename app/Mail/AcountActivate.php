<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class AcountActivate extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;
    protected $company;

    public function __construct($company,$link)
    {
      $this->link=$link;
      $this->company=$company;

      return $this->from('vagas@motoristas.co.mz')
      ->subject('Mailtrap Confirmation')
      ->markdown('mails.acountActiveMail')
      ->with([
            'name' =>'administrador',
            'link' => $this->link,
            'empresa' =>$this->company
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
            subject: 'Active a conta no Motorista',
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
        return $this->from('vagas@motoristas.co.mz')
        ->subject('Mailtrap Confirmation')
        ->markdown('mails.acountActiveMail')
        ->with([
              'name' =>'administrador',
              'link' => $this->link,
              'empresa' =>$this->company
          ]);
    }
}
