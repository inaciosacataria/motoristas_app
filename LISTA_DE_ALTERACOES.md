# Lista de alterações – Sistema Motoristas

Resumo das alterações implementadas no sistema.

---

## 1. Empregador e cadastro

- **Email no cadastro do empregador**  
  Envio de email ao registrar empregador (Mailable + template em `resources/views/mails/empregador-cadastro.blade.php`).

- **Aprovação pelo administrador**  
  Empresa não fica ativa ao enviar documentos; estado passa a "Pendente" até o admin aprovar. Opção de rejeitar cadastro.

- **Edição completa do perfil**  
  Empregador pode editar todos os dados (nome, email, celular, empresa, NUIT, representante, telefones, website, endereço, província, sobre) via modal "Editar Perfil" no perfil.

- **Atualização de documentos após cadastro**  
  Empregador pode atualizar NUIT, Certidão de Empresa e Início de Actividades individualmente (modais por documento). Correção: uso de `empregador_id` (id da tabela `empregadors`) em vez de `user_id` na tabela `documents_empregadors`.

- **Atualização de foto de perfil**  
  Empregador pode alterar foto/logotipo pelo modal no perfil; atualiza `users.foto_url` e `empregadors.logotipo`.

- **Perfil do empregador público**  
  Rota `/empregador-perfil/{id}` acessível sem login. Correção de página em branco (uso de `first()` em vez de `paginate()` e ajuste da view). Correção de "Acesso negado" (conflito de nome de rota `fotoPerfil` renomeado para `fotoPerfilEmpregador`).

- **Exibição da foto no perfil**  
  Prioridade: `logotipo` do empregador, depois `foto_url` do utilizador; uso de `asset()` e fallback com iniciais em caso de erro.

---

## 2. Vagas e listagens

- **Logos das empresas nas vagas**  
  Inclusão de `empregadors.logotipo` nas queries e exibição nas vagas:
  - Página inicial (`index-modern`), pesquisa (`search-modern`), componente `job-card`
  - Página de detalhe da vaga (`anuncio-modern`)
  - Perfil do empregador e dashboard do empregador  
  Prioridade: logotipo da empresa; fallback para inicial do nome.

- **Lista de vagas na área do empregador**  
  Ajuste da query em `EmpregadorController@index` (joins e filtros) para as vagas do empregador aparecerem em `/empregador`.

---

## 3. Candidatos e impressão

- **Impressão/PDF da lista de candidatos**  
  Funcionalidade de imprimir/gerar PDF da lista de candidatos por vaga (rota e view existentes para o empregador).

- **Contagem de candidaturas no dashboard**  
  Dashboard do empregador passa a mostrar o número de candidaturas (total e por vaga quando aplicável).

---

## 4. Publicidade (área empregador)

- **Banners na página do empregador**  
  Área de publicidade em `/empregador` usando tabela `smart_ads`:
  - Banner superior (antes dos cards de estatísticas)
  - Banner inferior (antes dos Quick Links)  
  Removido o segundo banner (meio). Suporte a tipo IMAGE e HTML; rastreio de cliques via `trackAdClick()`.

---

## 5. Ajustes técnicos e correções

- **ParseError em `EmpregadorController.php`**  
  Correção de chave `}` extra e alinhamento no bloco do método `index`/`editarPerfil`.

- **Rota de atualização de documentos**  
  Rota `POST /update-document` com nome `updateDocument` e middleware `empregador`.

- **Validação de documentos**  
  Em `updateDocument`: apenas PDF; mensagens de erro mais claras e logs em caso de falha.

- **Credenciais de admin**  
  Admin padrão (quando seeders estão aplicados):  
  Email: `admin@motoristas.co.mz`  
  Senha: `admin123`

---

## 6. Resumo de ficheiros mais alterados

| Ficheiro | Alterações principais |
|----------|------------------------|
| `EmpregadorController.php` | Perfil, vagas, logos, publicidades, edição de perfil, getEmpregador |
| `DocumentosController.php` | updateDocument, documentUpload (empregador_id), fotoPerfil |
| `InicioController.php` | Logotipo nas vagas da homepage |
| `AnunciosController.php` | Logotipo em todas as queries de vagas e em verAnuncio |
| `empregador-modern.blade.php` | Perfil único, modais foto/perfil/documentos, logos nas vagas |
| `dashboard-modern.blade.php` | Banners de publicidade (2), logos nas vagas |
| `job-card.blade.php`, `index-modern.blade.php`, `anuncio-modern.blade.php` | Exibição do logo da empresa |
| `web.php` | Rotas updateDocument, fotoPerfilEmpregador |

---

*Documento atualizado com base nas alterações implementadas no projeto.*
