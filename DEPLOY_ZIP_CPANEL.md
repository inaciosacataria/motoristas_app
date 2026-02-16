# 🚀 Guia Rápido: Deploy via ZIP no cPanel

## ✅ Assets já compilados e prontos!

Os arquivos CSS/JS do Tailwind foram compilados com sucesso em:
- `public/build/assets/app.f0ea36a4.css` (64.58 KB)
- `public/build/assets/app.a90aeddc.js` (0.02 KB)
- `public/build/manifest.json`

---

## 📦 Passo 1: Criar os ZIPs

### Opção A: Via Interface Gráfica (Windows/Mac)

**1. Criar ZIP da aplicação Laravel:**
- Selecionar TODA a pasta `motoristas`
- Botão direito → "Comprimir" / "Compress" / "Enviar para → Pasta compactada"
- Nome: `motoristas-app.zip`

**2. Criar ZIP da pasta public:**
- Entrar na pasta `motoristas/public/`
- Selecionar TUDO dentro de public (não a pasta public em si)
- Comprimir tudo
- Nome: `motoristas-public.zip`

### Opção B: Via Terminal (Mac/Linux)

```bash
# Navegar até a pasta do projeto
cd /Applications/XAMPP/xamppfiles/htdocs/

# Criar ZIP da aplicação completa
zip -r motoristas-app.zip motoristas -x "motoristas/node_modules/*" -x "motoristas/public/*"

# Criar ZIP da pasta public
cd motoristas/public
zip -r ../motoristas-public.zip .
```

---

## 📤 Passo 2: Upload para cPanel

### 1. Fazer login no cPanel

### 2. Abrir "File Manager" (Gerenciador de Arquivos)

### 3. Upload do ZIP da aplicação:
1. Navegar até `/home/seuusuario/`
2. Clicar em "Upload"
3. Fazer upload do arquivo `motoristas-app.zip`
4. Após upload, voltar para File Manager
5. Clicar com botão direito em `motoristas-app.zip`
6. Selecionar "Extract" (Extrair)
7. Extrair para `/home/seuusuario/`
8. Deletar o arquivo `motoristas-app.zip` após extrair

### 4. Upload do ZIP do public:
1. Navegar até `/home/seuusuario/public_html/`
2. **IMPORTANTE**: Deletar TUDO que está dentro do public_html (backup antes se necessário)
3. Clicar em "Upload"
4. Fazer upload do arquivo `motoristas-public.zip`
5. Após upload, voltar para File Manager
6. Clicar com botão direito em `motoristas-public.zip`
7. Selecionar "Extract" (Extrair)
8. Extrair para `/home/seuusuario/public_html/`
9. Deletar o arquivo `motoristas-public.zip` após extrair

**Resultado esperado:**
```
/home/seuusuario/
├── motoristas/              ← Aplicação Laravel
│   ├── app/
│   ├── config/
│   ├── resources/
│   ├── vendor/
│   └── ...
└── public_html/             ← Conteúdo de public/
    ├── .htaccess
    ├── index.php
    ├── build/               ← CSS/JS compilados aqui!
    │   ├── assets/
    │   └── manifest.json
    ├── assets/
    └── ...
```

---

## ⚙️ Passo 3: Configurar no cPanel

### 1. Editar o arquivo index.php

No File Manager, abrir `/home/seuusuario/public_html/index.php`

**Localizar estas linhas:**
```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

**Alterar para:**
```php
require __DIR__.'/../motoristas/vendor/autoload.php';
$app = require_once __DIR__.'/../motoristas/bootstrap/app.php';
```

Salvar o arquivo.

### 2. Criar/Configurar arquivo .env

**Opção A: Copiar do .env.example**

No File Manager:
1. Ir para `/home/seuusuario/motoristas/`
2. Copiar o arquivo `.env.example`
3. Renomear a cópia para `.env`
4. Editar o arquivo `.env`

**Configurações OBRIGATÓRIAS no .env:**

```env
APP_NAME="Motoristas"
APP_ENV=production
APP_KEY=                          # ← Deixar vazio por enquanto
APP_DEBUG=false
APP_URL=https://seudominio.com    # ← SEU DOMÍNIO AQUI
ASSET_URL=https://seudominio.com  # ← SEU DOMÍNIO AQUI

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=seu_banco_aqui        # ← Nome do banco
DB_USERNAME=seu_usuario_aqui      # ← Usuário do banco
DB_PASSWORD=sua_senha_aqui        # ← Senha do banco
```

Salvar o arquivo.

### 3. Ajustar Permissões

No File Manager, navegar até `/home/seuusuario/motoristas/`

**Ajustar permissões das seguintes pastas:**

1. Clicar com botão direito em `storage` → "Change Permissions"
   - Marcar: Read, Write, Execute para Owner, Group e World
   - Marcar: "Recurse into subdirectories"
   - Valor numérico: **775**
   - Aplicar

2. Clicar com botão direito em `bootstrap/cache` → "Change Permissions"
   - Marcar: Read, Write, Execute para Owner, Group e World
   - Marcar: "Recurse into subdirectories"
   - Valor numérico: **775**
   - Aplicar

---

## 🔑 Passo 4: Gerar APP_KEY (via Terminal SSH)

**Se tiver acesso SSH no cPanel:**

```bash
# Navegar para a aplicação
cd /home/seuusuario/motoristas

# Gerar a chave
php artisan key:generate

# Limpar caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Otimizar para produção
php artisan config:cache
php artisan route:cache
```

**Se NÃO tiver SSH:**

No File Manager, editar o `.env` e adicionar manualmente uma APP_KEY:
```env
APP_KEY=base64:SEU_RANDOM_STRING_AQUI_COM_32_CARACTERES
```

Você pode gerar uma chave aqui: https://generate-random.org/laravel-key-generator

---

## 🗄️ Passo 5: Criar e Configurar Banco de Dados

### No cPanel:

1. **MySQL Databases** → "Create New Database"
   - Nome: `motoristas` (ou qualquer nome)
   - Criar

2. **MySQL Users** → "Create New User"
   - Username: `user_motoristas`
   - Password: (senha forte)
   - Criar

3. **Add User to Database**
   - Selecionar o usuário criado
   - Selecionar o banco criado
   - Marcar "ALL PRIVILEGES"
   - Aplicar

4. **Anotar as credenciais:**
   - Host: `localhost`
   - Database: `cpaneluser_motoristas` (com prefixo do cPanel)
   - Username: `cpaneluser_user_motoristas`
   - Password: sua senha

5. **Atualizar o .env** com essas credenciais

### Importar o banco de dados:

Se tiver um backup SQL:
1. phpMyAdmin → Selecionar banco
2. Import → Escolher arquivo .sql
3. Executar

Ou via SSH:
```bash
cd /home/seuusuario/motoristas
php artisan migrate --force
php artisan db:seed --force  # Se tiver seeders
```

---

## ✅ Checklist Final

Antes de testar, verificar:

- [ ] Pasta `motoristas/` está em `/home/seuusuario/motoristas/`
- [ ] Conteúdo de `public/` está em `/home/seuusuario/public_html/`
- [ ] Pasta `public_html/build/` existe com CSS/JS compilados
- [ ] Arquivo `public_html/index.php` foi editado com paths corretos
- [ ] Arquivo `.env` existe em `motoristas/` e está configurado
- [ ] APP_KEY foi gerada no `.env`
- [ ] Credenciais do banco de dados estão corretas no `.env`
- [ ] Permissões 775 em `storage/` e `bootstrap/cache/`
- [ ] Banco de dados foi criado e importado/migrado

---

## 🎯 Testar o Site

1. Acessar: `https://seudominio.com`
2. Verificar se o CSS está carregando corretamente
3. Testar navegação entre páginas
4. Testar login/registro

---

## 🐛 Solução de Problemas

### CSS não carrega (página sem estilo)

**Verificar:**
1. Pasta `public_html/build/` existe?
2. Dentro tem `assets/app.f0ea36a4.css`?
3. APP_URL no .env está correto? (sem barra no final)
4. Limpar cache do navegador (Ctrl+Shift+R)

**Testar acesso direto ao CSS:**
- `https://seudominio.com/build/assets/app.f0ea36a4.css`
- Se retornar 404, a pasta build não foi extraída corretamente

### Erro 500 (Internal Server Error)

**Verificar:**
1. Arquivo `.env` existe?
2. APP_KEY está definida no `.env`?
3. Permissões de `storage/` e `bootstrap/cache/` estão 775?
4. Paths no `index.php` estão corretos?

**Ver logs de erro:**
- File Manager → `motoristas/storage/logs/laravel.log`

### Página em branco

**Verificar:**
1. Arquivo `index.php` foi editado corretamente?
2. Pastas `vendor/` e `bootstrap/` existem em `motoristas/`?
3. Permissões corretas?

### Erro de banco de dados

**Verificar:**
1. Banco de dados foi criado?
2. Credenciais no `.env` estão corretas (com prefixo do cPanel)?
3. Tabelas foram criadas (migrate)?

---

## 📊 Estrutura Final no Servidor

```
/home/seuusuario/
│
├── motoristas/                          ← Aplicação Laravel
│   ├── app/
│   ├── bootstrap/
│   │   └── cache/                       ← Permissão 775
│   ├── config/
│   ├── database/
│   ├── resources/
│   │   └── views/
│   │       └── layouts/
│   │           └── modern.blade.php
│   ├── routes/
│   ├── storage/                         ← Permissão 775
│   │   ├── app/
│   │   ├── framework/
│   │   └── logs/
│   ├── vendor/
│   ├── .env                             ← Configurado
│   ├── artisan
│   └── composer.json
│
└── public_html/                         ← Pasta Public do Laravel
    ├── .htaccess                        ← OK
    ├── index.php                        ← EDITADO
    ├── build/                           ← ASSETS COMPILADOS ✓
    │   ├── assets/
    │   │   ├── app.f0ea36a4.css        ← CSS do Tailwind
    │   │   └── app.a90aeddc.js         ← JS
    │   └── manifest.json
    ├── assets/
    ├── css/
    ├── uploads/
    └── favicon.ico
```

---

## 🎉 Pronto!

Seguindo todos os passos, seu site deve estar funcionando perfeitamente no cPanel com o CSS do Tailwind carregando corretamente!

**Data da compilação:** $(date)
**Arquivos CSS/JS:** ✅ Compilados e prontos
**Tamanho do CSS:** 64.58 KB (minificado)

---

## 📞 Suporte Rápido

**Console do navegador (F12) mostra erro?**
- Anotar o erro e verificar o arquivo correspondente

**Ver logs do Laravel:**
- `motoristas/storage/logs/laravel.log`

**Testar se o arquivo CSS existe:**
- `https://seudominio.com/build/assets/app.f0ea36a4.css`
- Se abrir, o problema está no @vite() do Blade
- Se der 404, a pasta build não foi extraída

**Emergency: CSS não funciona de jeito nenhum?**
- Posso criar um fallback manual no layout que carrega o CSS direto

