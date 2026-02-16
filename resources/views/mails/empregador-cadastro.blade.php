@component('mail::message')
# Bem-vindo ao Motoristas.co.mz!

Olá **{{ $nome }}**,

Obrigado por se cadastrar na nossa plataforma! Seu cadastro foi realizado com sucesso.

## Próximos Passos:

1. **Complete o upload dos documentos** necessários para aprovação da sua conta
2. **Aguarde a aprovação** do administrador
3. **Após aprovação**, você poderá começar a publicar vagas

## Informações da Conta:

- **Email:** {{ $email }}
- **Status:** Aguardando aprovação

Se você tiver alguma dúvida, não hesite em entrar em contato conosco.

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
