## 💼 Sistema Facilita

Sistema desenvolvido para a empresa Facilita, com o objetivo de gerenciar ordens de serviço e otimizar o controle interno de produção, entrega e atendimento.

👥 Equipe de Desenvolvimento

2024: Sidarta e Elton

2025: Guido e Carlos

⚙️ Tecnologias Utilizadas

Laravel Breeze – estrutura e autenticação

PHP / Blade / JavaScript / CSS

WampServer – ambiente local de execução

🚀 Principais Funcionalidades
🔧 Ordens de Serviço

Criação, edição, conclusão e entrega de ordens.

Status dinâmicos (Em produção, Concluída, Entregue, Atrasada).

Data de retirada registrada automaticamente ao marcar como Entregue.

Botões e ações ajustados conforme o tipo de usuário (Caixa, Admin, Design).

Mensagens de sucesso e alerta aprimoradas.

Paginação e layout refinado das tabelas.

👤 Usuários e Clientes

CRUD completo de clientes e funcionários.

Controle de acesso por tipo de usuário.

Admin e Design podem cadastrar novos usuários.

🗓️ Calendário de Ordens

Exibição de ordens com cores por status.

Atualização automática a cada 5 segundos.

Oculta finais de semana.

Pesquisa por cliente e serviço.

🎨 Interface e Usabilidade

Botão “Hoje” para preenchimento rápido de datas.

Máscara para números de telefone.

Ajustes visuais em tabelas, botões e notificações.

Impressão otimizada (oculta botões e alertas).

Textos e mensagens traduzidos para pt_BR.

🧩 Estrutura do Projeto
Diretório / Arquivo	Descrição
App/Http/Controllers	Controladores principais e autenticação
App/Http/Middleware	Permissões de acesso (Admin, Design)
App/Models	Modelos e integridade de dados
database/factories / seeders	Cria usuário base (codigo:1, senha:12345678)
database/migrations	Estrutura das tabelas do banco
public/css / public/js	Estilos e scripts (busca, máscaras, etc.)
resources/views	Páginas e layouts Blade
routes/web.php	Rotas principais
routes/auth.php	Rotas protegidas por login
iniciar_wamp.bat	Inicializa Wamp e executa php artisan serve

▶️ Como Executar o Sistema

Inicie o WampServer

Execute o arquivo:

iniciar_wamp.bat


O sistema será aberto automaticamente no navegador.
