# Sistema Facilita

Sistema interno para gerenciamento de ordens de serviço, produção, entrega e atendimento.

## Tecnologias

* Laravel
* Tailwind CSS
* Alpine.js
* MySQL
* JavaScript
* WampServer

## Funcionalidades

### Ordens de Serviço

* Criar, editar, concluir e entregar ordens.
* Status dinâmicos: Em produção, Concluída, Entregue, Atrasada.
* Registro automático da data de retirada ao finalizar.
* Ações adaptadas por tipo de usuário (Caixa, Admin, Design).
* Mensagens de confirmação e alerta revisadas.
* Paginação e layout de tabela ajustados.

### Usuários e Clientes

* CRUD completo de clientes e funcionários.
* Controle de acesso por perfis.
* Admin e Design podem cadastrar novos usuários.

### Calendário

* Exibe ordens com cores por status.
* Atualização automática a cada 5 segundos.
* Oculta fins de semana.
* Busca por cliente e serviço.

### Interface e Usabilidade

* Botão “Hoje” para datas.
* Máscara para telefone.
* Impressão otimizada.
* Textos e mensagens em pt_BR.

## Estrutura do Projeto

| Diretório / Arquivo        | Descrição                               |
| -------------------------- | --------------------------------------- |
| app/Http/Controllers       | Controladores e autenticação            |
| app/Http/Middleware        | Permissões (Admin, Design)              |
| app/Models                 | Modelos                                 |
| database/factories/seeders | Usuário base (codigo:1, senha:12345678) |
| database/migrations        | Estrutura das tabelas                   |
| public/css/public/js       | Estilos e scripts                       |
| resources/views            | Páginas Blade                           |
| routes/web.php             | Rotas principais                        |
| routes/auth.php            | Rotas autenticadas                      |
| iniciar_wamp.bat           | Inicia o Wamp e o servidor Laravel      |

## Instalação e Configuração

1. Clonar o repositório

   ```bash
   git clone https://github.com/EspacoFacilita/Sistema-Facilita.git
   cd Sistema-Facilita
   ```

2. Instalar dependências

   ```bash
   composer install
   npm install
   npm run build
   ```

3. Configurar o ambiente

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   * Ajustar DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD.
   * Definir APP_URL e fuso horário.

4. Migrar banco e executar seeders

   ```bash
   php artisan migrate --seed
   ```

5. Executar o servidor

   ```bash
   php artisan serve
   ```

   Acessar `http://localhost:8000`.

## Créditos

* Desenvolvimento: Guido Vidal de Oliveira, Carlos Emanuel Sousa Silva.
* Supervisão: Hélia, Eduardo.
* Empresa: Espaço Facilita.
* Curso: Técnico em Desenvolvimento de Sistemas — EEEP Jeová Costa Lima.
