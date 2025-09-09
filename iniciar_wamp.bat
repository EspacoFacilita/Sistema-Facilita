@echo off
start "" "C:\wamp64\wampmanager.exe"

:: Aguarde alguns segundos para garantir que o WampServer seja iniciado
timeout /t 45 > nul

:: ----- Projeto 1 -----
cd C:\wamp64\www\proj_facilita\teste\facilita_projeto
start cmd /k "php artisan serve --host=0.0.0.0 --port=8000"

:: Aguarde alguns segundos para garantir que o servidor Laravel 1 esteja rodando
timeout /t 10 > nul

:: ----- Projeto 2 -----
cd C:\wamp64\www\sistema_guiche
start cmd /k "php artisan serve --host=0.0.0.0 --port=8001"

:: Aguarde alguns segundos para garantir que o servidor Laravel 2 esteja rodando
timeout /t 10 > nul

:: ----- Abrir o navegador -----
start "" "C:\Program Files\Google\Chrome\Application\chrome.exe" http://127.0.0.1:8000 http://127.0.0.1:8001
