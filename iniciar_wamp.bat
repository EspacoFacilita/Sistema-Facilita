@echo off
start "" "C:\wamp64\wampmanager.exe"

:: Aguarde alguns segundos para garantir que o WampServer seja iniciado
timeout /t 45 > nul

:: Navegar até o diretório do projeto Laravel
cd C:\wamp64\www\proj_facilita\teste\facilita_projeto

:: Iniciar o servidor Laravel
start "" php artisan serve --host=0.0.0.0 --port=8000

:: Aguarde alguns segundos para garantir que o servidor Laravel esteja rodando
timeout /t 20 > nul

:: Abrir o navegador (Google Chrome) na URL do Laravel
start "" "C:\Program Files\Google\Chrome\Application\chrome.exe" http://127.0.0.1:8000

:: Abrir nova janela cmd e rodar npm run dev
start cmd /k "cd /d C:\wamp64\www\proj_facilita\teste\facilita_projeto && npm run dev"
