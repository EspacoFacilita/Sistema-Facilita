Este sistema foi desenvolvido para a empresa Facilita,feito por dois estagiarios da escola EEEP Jeova Costa Lima,com intuito de facilitar a gestão das ordens de serviços. Abaixo você verá os aspectos importantes sobre o sistema:

-> Primeiramente o projeto foi criado e desenvolvido usando laravel breeze;

-> No sistema á niveis de acessos, baseados no tipo do usuário,que lhes permitem alterar o status da ordem de servico e nos niveis mais altos que são os tipos "Admin" e "Design"conseguem cadastrar novos usuários/funcionarios;

-> Em "App/Http/controllers" estão os controllers do sistema, e dentro de Auth está os controller de criação dos usuarios(Funcionários);

-> Em "App/Http/Middleware" está o middleware dos admins(e Designs) que lhes permite acesso maximo do sistema;

-> Em "App/Models" estão os arquivos que protegem a Integridade das informações do banco de dados;

-> Em "database/factories" e "database/seeders" esta o codigo que ja cria automaticamente o usuario base para cadastro dos demais(codigo:1; Senha:12345678;);

-> Em "database/migrations" está o codigo que gera as tabelas do banco de dados;

-> Em "public/css/styles.css" está todo o nosso css do sistema;

-> Em "public/img" está a imagem da logo da Facilita;

-> Em "public/js" estão todos os nosso codigos js do sistema(search,mascara,etc...);

-> Em "resources/views/admin" estão todos os arquivos para cada pagina do sistema e as demais arquivos dentro de "resources/views" são elementos complementares;

-> Em "routes/Auth" estão definidas as rotas que só podem ser acessados somente por usuarios logados,e tem rotas que so podem ser acessados por usuarios deslogados;

-> Em "routes/web" estão as demais rotas do sistema;

-> No arquivo "iniciar_wamp.bat" está um codigo que inicializara o servidor,ligando primeiramente o WampServer, e logo após rodando o codigo:"php artisan serve" para abrir a pagina web;

-> Abaixo está uma descrição padrão sobre o laravel:

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
