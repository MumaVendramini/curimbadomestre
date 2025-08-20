# Curimba do Mestre

Plataforma de curso de Curimba desenvolvida em Laravel 11 com integração Firebase.

## 🎯 Funcionalidades

### Para Alunos:
- Acesso aos módulos habilitados pelo administrador
- Reprodução de áudios dos pontos
- Visualização de imagens dos toques
- Vídeos de ensino via YouTube
- Download de apostilas

### Para Administradores:
- CRUD completo de alunos
- Gerenciamento de módulos, pontos e vídeos
- Controle de acesso por módulo
- Dashboard com estatísticas

## 🚀 Tecnologias

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade + Tailwind CSS
- **Banco de Dados**: MySQL/SQLite
- **Autenticação**: Sistema customizado (simulando Firebase Auth)
- **Deploy**: Firebase Hosting

## 📋 Pré-requisitos

- PHP 8.2 ou superior
- Composer
- Node.js e NPM
- MySQL ou SQLite
- Firebase CLI (para deploy)

## 🛠️ Instalação

### 1. Clone o repositório
```bash
git clone https://github.com/MumaVendramini/curimbadomestre.git
cd curimbadomestre
```

### 2. Instale as dependências PHP
```bash
composer install
```

### 3. Instale as dependências Node.js
```bash
npm install
```

### 4. Configure o ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure o banco de dados
Edite o arquivo `.env` com suas configurações de banco:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=curimbadomestre
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

### 6. Execute as migrations
```bash
php artisan migrate
```

### 7. Execute os seeders
```bash
php artisan db:seed
```

### 8. Compile os assets
```bash
npm run dev
```

### 9. Inicie o servidor
```bash
php artisan serve
```

## 🔐 Usuários de Teste

Após executar os seeders, você terá acesso aos seguintes usuários:

- **Administrador**: admin@curimbadomestre.com
- **Aluno**: aluno@exemplo.com

## 🌐 Deploy no Firebase Hosting

### 1. Instale o Firebase CLI
```bash
npm install -g firebase-tools
```

### 2. Faça login no Firebase
```bash
firebase login
```

### 3. Inicialize o projeto Firebase
```bash
firebase init hosting
```

Selecione:
- Use an existing project
- Escolha o projeto `curimbadomestre`
- Public directory: `public`
- Configure as single-page app: `No`
- Overwrite index.html: `No`

### 4. Compile os assets para produção
```bash
npm run production
```

### 5. Execute o deploy
```bash
firebase deploy
```

## 📁 Estrutura do Projeto

```
curimbadomestre/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   └── StudentController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── StudentMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Module.php
│       ├── Ponto.php
│       └── Video.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       ├── student/
│       └── auth/
├── routes/
│   └── web.php
├── firebase.json
├── .firebaserc
└── README.md
```

## 🔧 Configuração do Firebase

### 1. Crie um projeto no Firebase Console
- Acesse [console.firebase.google.com](https://console.firebase.google.com)
- Crie um novo projeto chamado `curimbadomestre`

### 2. Configure o Hosting
- No console, vá para Hosting
- Clique em "Get started"
- Siga as instruções para conectar seu projeto local

### 3. Configure as variáveis de ambiente
Copie o arquivo `firebase-config.example` e preencha com suas credenciais do Firebase.

## 🚀 Comandos Úteis

```bash
# Desenvolvimento
php artisan serve          # Inicia servidor local
npm run dev               # Compila assets em modo desenvolvimento
npm run watch            # Compila assets e observa mudanças

# Produção
npm run production       # Compila assets para produção
firebase deploy          # Deploy para Firebase Hosting

# Banco de dados
php artisan migrate      # Executa migrations
php artisan db:seed      # Executa seeders
php artisan migrate:fresh --seed  # Reseta banco e executa seeders
```

## 📱 Funcionalidades Principais

### Sistema de Autenticação
- Login/logout
- Controle de acesso por role (admin/student)
- Middleware de proteção de rotas

### Área do Administrador
- Dashboard com estatísticas
- Gerenciamento de usuários
- Gerenciamento de módulos
- Controle de acesso por módulo

### Área do Aluno
- Visualização de módulos habilitados
- Reprodução de áudios
- Visualização de imagens
- Vídeos do YouTube
- Download de apostilas

## 🔒 Segurança

- Todas as rotas são protegidas por middleware de autenticação
- Controle de acesso baseado em roles
- Validação de dados em todos os formulários
- Proteção CSRF ativada

## 🐛 Solução de Problemas

### Erro de permissão
```bash
chmod -R 755 storage bootstrap/cache
```

### Erro de composer
```bash
composer dump-autoload
```

### Erro de cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## 📞 Suporte

Para suporte ou dúvidas, abra uma issue no repositório GitHub.

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

---

**Desenvolvido com ❤️ para o curso de Curimba do Mestre**
