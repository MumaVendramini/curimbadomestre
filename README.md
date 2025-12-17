# Curimba do Mestre

Plataforma educacional de curso de Curimba desenvolvida em Laravel com integração Firebase. Sistema completo de ensino com gestão de múltiplas mídias por módulo.

## 🎯 Funcionalidades

### Para Alunos:
- ✅ Acesso aos módulos habilitados pelo administrador
- 🎵 Reprodução de múltiplos áudios dos pontos
- 🖼️ Visualização de múltiplas imagens dos toques
- 🎬 Vídeos de ensino via YouTube (múltiplos por módulo)
- 📚 Download de apostilas em PDF
- 📱 Interface responsiva para dispositivos móveis

### Para Administradores:
- ✅ CRUD completo de alunos com controle de acesso
- ✅ Gerenciamento completo de módulos com campos específicos de Curimba:
  - Tipo de toque (Ijexá, Nagô, Samba de Angola, Congo, Barravento)
  - Origem, características e aplicação de cada toque
- 🎵 **Upload de múltiplos áudios por módulo** (arquivos MP3/MP4)
- 🎬 **Gestão de múltiplos vídeos por módulo** (URLs do YouTube)
- 🖼️ **Upload de múltiplas imagens por módulo** (JPG/PNG)
- 🗑️ Exclusão individual de mídias
- 📊 Dashboard com estatísticas
- 👥 Controle granular de acesso por módulo

## 🚀 Tecnologias

- **Backend**: Laravel 8.75+ (PHP 7.4+/8.0+)
- **Frontend**: Blade Templates + Tailwind CSS 4.1
- **Banco de Dados**: MySQL/SQLite
- **Upload de Arquivos**: Storage local com link simbólico
- **Autenticação**: Sistema customizado Laravel Auth
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

### 7. Crie o link simbólico do storage
```bash
php artisan storage:link
```

### 8. Execute os seeders
```bash
php artisan db:seed
```

### 9. Compile os assets
```bash
npm run dev
```

### 10. Inicie o servidor
```bash
php artisan serve
```

**Ou use o script pronto:**
```bash
# Windows
start-server.bat

# Isso iniciará o servidor e mostrará o endereço de acesso
```

## 🔐 Usuários de Teste

Após executar os seeders, você terá acesso aos seguintes usuários:

- **Administrador**: 
  - Email: `admin@curimbadomestre.com`
  - Senha: `@1234abcd`
  
- **Aluno**: 
  - Email: `aluno@exemplo.com`
  - Senha: Verificar no seeder

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

```       # CRUD completo de admin
│   │   │   ├── AuthController.php        # Autenticação
│   │   │   ├── StudentController.php     # Área do aluno
│   │   │   ├── ModuleController.php      # Gestão de módulos
│   │   │   └── FirebaseAuthController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── StudentMiddleware.php
│   └── Models/
│       ├── User.php                      # Usuários (admin/aluno)
│       ├── Module.php                    # Módulos de ensino
│       ├── ModuleAudio.php               # Áudios dos módulos
│       ├── ModuleVideo.php               # Vídeos dos módulos
│       ├── ModuleImage.php               # Imagens dos módulos
│       ├── Ponto.php                     # Pontos de Curimba
│       └── Video.php                     # Vídeos gerais
├── database/
│   ├── migrations/
│   │   ├── *_create_modules_table.php
│   │   ├── *_create_module_audios_table.php
│   │   ├── *_create_module_videos_table.php
│   │   ├── *_create_module_images_table.php
│   │   └── *_add_curimba_fields_to_modules_table.php
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── modules/
│       │   │   ├── index.blade.php      # Listagem de módulos
│       │   │   ├── create.blade.php     # Criar módulo
│       │   │   └── edit.blade.php       # Editar + Upload de mídias
│       │   └── users/
│       ├── student/
│       └── auth/
├── storage/
│   └── app/
│       └── public/                       # Mídias uploadadas
│           ├── audios/
│           ├── images/
│           └── videos/
├── routes/
│   └── web.php
├── start-server.bat                      # Script para iniciar servidor
├── criar-hotspot.bat                     # Script para criar hotspot WiFi
├── firewall-config.bat                   # Script para configurar firewall
├── qr-code.html                          # Página com QR Code para acesso móvel
├── firebase.jsondent/
│       └── auth/
├── routes/
│   └── web.php--host=0.0.0.0 --port=8000  # Servidor acessível via rede
start-server.bat                               # Script Windows (exibe endereço IP)
npm run dev                                    # Compila assets em desenvolvimento
npm run watch                                  # Compila assets e observa mudanças

# Produção
npm run production                             # Compila assets para produção
firebase deploy                                # Deploy para Firebase Hosting

# Banco de dados
php artisan migrate                            # Executa migrations
php artisan db:seed                            # Executa seeders
php artisan migrate:fresh --seed               # Reseta banco e executa seeders
php artisan storage:link                       # Cria link simbólico do storage

# Scripts utilitários (Windows)
criar-hotspot.bat                              # Cria hotspot WiFi para teste mobile
firewall-config.bat                            # Configura firewall para porta 8000
qr-code.html                                   # Abre página com QR Code para acesso
```

## 📱 Teste em Dispositivos Móveis

Para testar a aplicação no celular/tablet:

1. **Certifique-se de estar na mesma rede WiFi**
2. **Execute o servidor:**
   ```bash
   start-server.bat
   ```
3. **Abra qr-code.html no navegador do PC**
4. **Escaneie o QR Code com o celular**
5. **Ou acesse diretamente:** `http://[SEU_IP]:8000`

**Scripts auxiliares:**
- `criar-hotspot.bat` - Cria rede WiFi no PC (requer admin)
- `firewall-config.bat` - Permite conexões na porta 8000 (requer admin) Login/logout seguro
- ✅ Controle de acesso por role (admin/student)
- ✅ Middleware de proteção de rotas
- ✅ Validação de credenciais

### Área do Administrador
- 📊 Dashboard com estatísticas em tempo real
- 👥 **Gerenciamento de Usuários:**
  - CRUD completo de alunos
  - Ativação/desativação de contas
  - Controle de módulos liberados por aluno
- 📚 **Gerenciamento de Módulos:**
  - CRUD completo com campos específicos de Curimba
  - Tipo de toque (Ijexá, Nagô, Samba de Angola, Congo, Barravento)
  - Origem, características e aplicação de cada toque
  - Ordem de exibição customizada
- 🎵 **Gestão de Áudios:**
  - Upload de múltiplos arquivos de áudio (MP3/MP4/WAV)
  - Título customizado para cada áudio
  - Preview e player integrado
  - Exclusão individual de áudios
- 🎬 **Gestão de Vídeos:**
  - Adição de múltiplos vídeos do YouTube
  - Título e URL customizados
  - Preview e link direto
  - Exclusão individual de vídeos
- 🖼️ **Gestão de Imagens:**
  - Upload de múltiplas imagens (JPG/PNG/GIF)
  - Título customizado para cada imagem
  - Preview em miniatura
  - Exclusão individual de imagens

### Área do Aluno
- 📚 Visualização de módulos habilitados
- 🎵 Reprodução de áudios dos pontos com player HTML5
- 🖼️ Visualização de imagens dos toques
- 🎬 Reprodução de vídeos do YouTube integrados
- 📄 Download de apostilas em PDF
- 📱 Interface responsiva para celular/tablet

### Sistema de Mídias
- ✅ Upload de arquivos com validação de tipo
- ✅ Armazenamento seguro no servidor
- ✅ Link simbólico para acesso público
- ✅ Relacionamento 1:N (um módulo, várias mídias)
- ✅ Preview de mídias na interface de edição
- ✅ Exclusão segura com limpeza de arquivo
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
