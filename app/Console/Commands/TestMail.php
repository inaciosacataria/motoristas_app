<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia um email de teste para verificar a configuração SMTP';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $to = $this->argument('to') ?: config('mail.from.address');

        if (!$to) {
            $this->error('Endereço de destino não encontrado. Defina MAIL_FROM_ADDRESS no .env ou passe o email como argumento.');
            return 1;
        }

        try {
            Mail::raw('Este é um email de teste do sistema Motoristas.co.mz para verificar a configuração de envio de emails.', function ($message) use ($to) {
                $message->to($to)->subject('Teste de email - Motoristas.co.mz');
            });

            $this->info("✅ Email de teste enviado para: {$to}");
            return 0;
        } catch (\Throwable $e) {
            $this->error('❌ Falha ao enviar email de teste: ' . $e->getMessage());
            return 1;
        }
    }
}

