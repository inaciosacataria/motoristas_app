# 🚀 Guia de Deploy para cPanel

## ✅ Assets Compilados com Sucesso!

Os arquivos CSS e JS foram compilados e estão prontos para upload:

```
✓ public/build/assets/app.f0ea36a4.css (64.58 KB)
✓ public/build/assets/app.a90aeddc.js (0.02 KB)
✓ public/build/manifest.json (0.25 KB)
```

---

## 📂 Estrutura de Diretórios no cPanel

### No Servidor cPanel:

```
/home/seuusuario/
├── motoristas/                    ← Aplicação Laravel (FORA do public_html)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env                       ← IMPORTANTE: Configure aqui
│   ├── artisan
│   └── composer.json
│
└── public_html/                   ← Conteúdo da pasta public/ do Laravel
    ├── .htaccess                  ← Já configurado corretamente
    ├── index.php                  ← IMPORTANTE: Editar paths
    ├── build/                     ← PASTA COMPILADA (fazer upload!)
    │   ├── assets/
    │   │   ├── app.f0ea36a4.css
    │   │   └── app.a90aeddc.js
    │   └── manifest.json
    ├── assets/
    ├── css/
    ├── uploads/
    └── favicon.ico
```

---

## 📤 Passo a Passo para Upload

### 1️⃣ Fazer Upload da Aplicação Laravel

**Via FileManager do cPanel ou FTP:**

1. Fazer upload de toda a aplicação Laravel para `/home/seuusuario/motoristas/`
   - **EXCETO** a pasta `public/` (que vai para public_html)

2. Fazer upload do conteúdo da pasta `public/` para `/home/seuusuario/public_html/`
   - **IMPORTANTE**: Incluir a pasta `build/` completa!

### 2️⃣ Editar o arquivo index.php no public_html

**Arquivo:** `/home/seuusuario/public_html/index.php`

Localizar estas linhas:

```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

E alterar para:

```php
require __DIR__.'/../motoristas/vendor/autoload.php';
$app = require_once __DIR__.'/../motoristas/bootstrap/app.php';
```

### 3️⃣ Configurar o arquivo .env

**Arquivo:** `/home/seuusuario/motoristas/.env`

```env
APP_NAME="Motoristas"
APP_ENV=production
APP_KEY=base64:SuaChaveAqui
APP_DEBUG=false
APP_URL=https://seudominio.com

# Se usar subdomínio ou subdiretório, ajustar:
# APP_URL=https://motoristas.seudominio.com
# ou
# APP_URL=https://seudominio.com/motoristas

ASSET_URL=https://seudominio.com

# Banco de Dados
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

# ... outras configurações
```

### 4️⃣ Ajustar Permissões (via Terminal SSH ou FileManager)

Se tiver acesso SSH:

```bash
cd /home/seuusuario/motoristas
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

Ou pelo FileManager do cPanel:
- Pasta `storage/` e subpastas: **775**
- Pasta `bootstrap/cache/`: **775**

### 5️⃣ Verificar se a pasta build/ foi carregada

**MUITO IMPORTANTE**: Confirmar que existe:

```
/home/seuusuario/public_html/build/
├── assets/
│   ├── app.f0ea36a4.css
│   └── app.a90aeddc.js
└── manifest.json
```

---

## 🔧 Comandos Úteis (se tiver SSH)

```bash
# Navegar para a aplicação
cd /home/seuusuario/motoristas

# Limpar caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Otimizar para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Gerar chave da aplicação (se necessário)
php artisan key:generate
```

---

## 🐛 Troubleshooting

### Problema: CSS não carrega

**Solução 1:** Verificar se a pasta `build/` está no public_html
```
/home/seuusuario/public_html/build/
```

**Solução 2:** Verificar o APP_URL no .env
```env
APP_URL=https://seudominio.com  # SEM barra no final
ASSET_URL=https://seudominio.com
```

**Solução 3:** Limpar cache do navegador e do Laravel
- Ctrl+Shift+R no navegador
- `php artisan config:clear` no servidor

**Solução 4:** Verificar permissões
- storage/: 775
- bootstrap/cache/: 775

### Problema: Erro 500

**Verificar:**
1. `.env` existe e está configurado corretamente
2. `APP_KEY` está definida (rodar `php artisan key:generate`)
3. Permissões das pastas storage e bootstrap/cache
4. Paths no `index.php` estão corretos

### Problema: Assets não encontrados (404)

**Verificar:**
1. Pasta `build/` existe em public_html
2. Arquivo `build/manifest.json` existe
3. APP_URL no .env está correto
4. `.htaccess` está ativo (mod_rewrite habilitado)

---

## 📋 Checklist Final

- [ ] Aplicação Laravel está em `/home/seuusuario/motoristas/`
- [ ] Conteúdo de `public/` está em `/home/seuusuario/public_html/`
- [ ] Pasta `build/` está em `/home/seuusuario/public_html/build/`
- [ ] Arquivo `index.php` foi editado com paths corretos
- [ ] Arquivo `.env` foi configurado com dados corretos
- [ ] Permissões 775 em `storage/` e `bootstrap/cache/`
- [ ] APP_URL está correto no .env
- [ ] Banco de dados foi criado e migrado
- [ ] Cache foi limpo (config, route, view)

---

## 🎯 Resultado Esperado

Após seguir todos os passos:

1. ✅ Site carrega normalmente
2. ✅ CSS do Tailwind está funcionando
3. ✅ Todas as páginas estilizadas corretamente
4. ✅ Navegação funciona
5. ✅ Formulários funcionam

---

## 📞 Suporte

Se após seguir todos os passos o CSS ainda não carregar:

1. Verificar o console do navegador (F12) para ver erros
2. Verificar se os arquivos CSS estão acessíveis:
   - `https://seudominio.com/build/assets/app.f0ea36a4.css`
3. Verificar logs do Laravel em `storage/logs/laravel.log`

---

**Última compilação:** ${new Date().toLocaleString('pt-MZ')}
**Arquivos gerados:**
- `public/build/assets/app.f0ea36a4.css` (64.58 KB)
- `public/build/assets/app.a90aeddc.js` (0.02 KB)
- `public/build/manifest.json` (0.25 KB)

