# 🔐 CREDENCIAIS DO SISTEMA

## 📋 Credenciais de Acesso ao Sistema

### 👤 ADMINISTRADOR
```
Email: admin@motoristas.co.mz
Senha: admin123
Privilégio: admin
Status: Ativo
```

**Acesso:** `/admin` ou `/login` (selecionar admin)

---

### 🏢 EMPREGADOR (Teste)
```
Email: empresa@teste.com
Senha: password123
Privilégio: empregador
Status: Ativo
```

**Acesso:** `/empregador` ou `/login` (selecionar empregador)

---

### 👨‍💼 CANDIDATO (Teste)
```
Celular: 840000002
Email: 840000002@motoristas.co.mz (gerado automaticamente)
Senha: candidato123
Privilégio: candidato
Status: Ativo
```

**Acesso:** `/candidato` ou `/login?candidato=1`

---

## 🗄️ Credenciais do Banco de Dados

### MySQL/MariaDB
```
Host: 127.0.0.1
Porta: 3306
Database: motoristas
Username: root
Password: (vazio)
```

**Configuração no .env:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=motoristas
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📧 Credenciais de Email (SMTP)

### Hostinger SMTP
```
Servidor SMTP: smtp.hostinger.com
Porta: 465
Criptografia: TLS
Email: info@motoristas.co.mz
Senha: Machava@123
```

**Configuração no .env:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=info@motoristas.co.mz
MAIL_PASSWORD=Machava@123
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@motoristas.co.mz
MAIL_FROM_NAME=info@motoristas.co.mz
```

---

## 🚀 Como Criar Usuários de Teste

Execute o seeder para criar usuários de teste:

```bash
php artisan db:seed --class=TestUsersSeeder
```

Ou execute todos os seeders:

```bash
php artisan db:seed
```

---

## 🔑 Chave da Aplicação

```
APP_KEY=base64:LgD8UFm4GHy9/9vpf54w41Tw6z8Ix5e5wT5kpX+t9Pk=
```

**Para gerar nova chave:**
```bash
php artisan key:generate
```

---

## 🌐 URLs do Sistema

### Produção
```
URL Base: https://motoristas.co.mz/
```

### Desenvolvimento Local
```
URL Base: http://127.0.0.1:8000/
ou
URL Base: http://localhost:8000/
```

### Rotas Principais
- **Homepage:** `/`
- **Login:** `/login`
- **Registro:** `/register`
- **Dashboard Admin:** `/admin`
- **Dashboard Empregador:** `/empregador`
- **Dashboard Candidato:** `/candidato`
- **Central de Risco:** `/centralRisco`
- **Formações:** `/formacao`

---

## 📝 Notas Importantes

### Segurança
⚠️ **ATENÇÃO:** Estas são credenciais de desenvolvimento/teste. Em produção:
- Altere todas as senhas padrão
- Use senhas fortes e únicas
- Não compartilhe credenciais em repositórios públicos
- Configure variáveis de ambiente adequadamente

### Primeiro Acesso
1. Acesse `/login`
2. Use as credenciais de ADMIN para primeiro acesso
3. Crie novos usuários conforme necessário
4. Configure permissões adequadas

### Reset de Senha
Para resetar senha de um usuário via banco de dados:
```sql
UPDATE users 
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE email = 'email@exemplo.com';
```
(Senha padrão: `password`)

Ou use o sistema de recuperação de senha:
- Acesse `/forget-password`
- Informe o email
- Siga as instruções recebidas por email

---

## 🔄 Criar Novo Usuário Admin

Se precisar criar um novo administrador:

```bash
php artisan tinker
```

Depois execute:
```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Nome do Admin',
    'email' => 'admin@exemplo.com',
    'celular' => '840000000',
    'password' => Hash::make('senha_segura'),
    'privilegio' => 'admin',
    'active' => 'activo',
    'is_premium' => 'yes',
]);
```

---

**Última Atualização:** 06/02/2026
**Mantenha este arquivo seguro e não o compartilhe publicamente!**
