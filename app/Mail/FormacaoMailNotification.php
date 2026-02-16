<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class FormacaoMailNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $plano;
    protected $nome;
    protected $contacto;
    protected $email;

    protected $curso;
    protected $numerodemotoristas;
    protected $observacoes;
    protected $footer;

    public function __construct($plano, $nome, $contacto,$email, $curso, $numerodemotoristas, $observacoes, $footer)
    {

      $this ->footer= $footer;
      $this->plano=$plano;
      $this->nome=$nome;
      $this->contacto=$contacto;
      $this->email=$email;
      $this->curso=$curso;
      $this->numerodemotoristas=$numerodemotoristas;
      $this->observacoes=$observacoes;


      return $this->from('info@motoristas.co.mz')
      ->subject('Mailtrap Confirmation')
      ->markdown('mails.cursoInscritoMail')
      ->with([
        'plano' => $this->plano,
        'nome' => $this->nome,
        'contacto' => $this->contacto,
        'email' => $this->email,
        'curso' => $this->curso,
        'numerodemotoristas' => $this->numerodemotoristas,
        'observacoes' => $this->observacoes,
        'footer' => $this->footer
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
            subject: 'Incricao para Formações',
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
      ->markdown('mails.cursoInscritoMail')
      ->with([
        'plano' => $this->plano,
        'nome' => $this->nome,
        'contacto' => $this->contacto,
        'email' => $this->email,
        'curso' => $this->curso,
        'numerodemotoristas' => $this->numerodemotoristas,
        'observacoes' => $this->observacoes,
        'footer' => $this->footer
        ]);
    }
}
