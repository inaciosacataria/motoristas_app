<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmpregadorCadastroEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $nome;
    protected $email;

    public function __construct($nome, $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Bem-vindo ao Motoristas.co.mz - Cadastro Realizado',
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
            markdown: 'mails.empregador-cadastro',
            with: [
                'nome' => $this->nome,
                'email' => $this->email,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    public function build()
    {
        return $this->from('info@motoristas.co.mz', 'Motoristas.co.mz')
            ->subject('Bem-vindo ao Motoristas.co.mz - Cadastro Realizado')
            ->markdown('mails.empregador-cadastro')
            ->with([
                'nome' => $this->nome,
                'email' => $this->email,
            ]);
    }
}
