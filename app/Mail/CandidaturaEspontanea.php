<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class CandidaturaEspontanea extends Mailable
{
    use Queueable, SerializesModels;



    protected $nome;
    protected $contacto;
    protected $email;

    protected $cv_link;
    protected $empresa;

    public function __construct( $nome, $contacto,$email, $cv_link, $empresa)
    {

      $this->nome= $nome;
      $this->contacto=$contacto;
      $this->email=$email;
      $this->cv_link= $cv_link;
      $this->empresa= $empresa;


      return $this->from('info@motoristas.co.mz')
      ->subject('Mailtrap Confirmation')
      ->markdown('mails.seguroMail')
      ->with([
        'nome' => $this->nome,
        'contacto' => $this->contacto,
        'email' => $this->email,
        'cv_link' => $this->cv_link,
        'empresa' => $this->empresa
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
            subject: 'Inscrição para Seguros de Motoristas',
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
        ->markdown('mails.CandidaturaMail')
        ->with([
          'nome' => $this->nome,
          'contacto' => $this->contacto,
          'email' => $this->email,
          'cv_link' => $this->cv_link,
          'empresa' => $this->empresa,
          'footer'=> '© Copyright '.(now()->year).' - motoristas.co.mz'
          ]);
    }
}
