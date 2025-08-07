@echo off

:: Configurações
set PROJECT_DIR=C:\wamp64\bin\mysql\mysql8.3.0\data\facilita
set BACKUP_DIR=\\Mimaki-pc\e\BackupDoSistema
set DB_NAME=facilita
set DB_USER=root
set DB_PASSWORD=
set MYSQLDUMP_PATH="C:\wamp64\bin\mysql\mysql8.3.0\bin\mysqldump.exe"
set DATE=%date:~6,4%-%date:~3,2%-%date:~0,2%_%time:~0,2%.%time:~3,2%

:: Criar pasta de backup (se não existir)
if not exist "%BACKUP_DIR%" (
    mkdir "%BACKUP_DIR%"
)

:: Backup do banco de dados
echo Iniciando backup do banco de dados...
%MYSQLDUMP_PATH% -u%DB_USER% %DB_NAME% > "%BACKUP_DIR%\db_backup_%DATE%.sql"

if %errorlevel% neq 0 (
    echo Erro: Não foi possível fazer o backup do banco de dados.
    pause
    exit /b 1
)
echo Backup do banco de dados concluído com sucesso.

:: Backup dos arquivos do projeto
echo Iniciando backup dos arquivos do projeto...
xcopy "%PROJECT_DIR%" "%BACKUP_DIR%\project_backup_%DATE%" /E /I /Y
if %errorlevel% neq 0 (
    echo Erro ao copiar os arquivos do projeto.
    pause
    exit /b 1
)
echo Backup dos arquivos do projeto concluído com sucesso.

:: Finalização
echo Todos os backups foram concluídos com sucesso!
pause
