@echo off
echo ========================================
echo   Limpeza de Cache - Laravel
echo ========================================
echo.

echo [1/5] Limpando cache de configuracao...
php artisan config:clear
echo.

echo [2/5] Limpando cache de rotas...
php artisan route:clear
echo.

echo [3/5] Limpando cache de views...
php artisan view:clear
echo.

echo [4/5] Limpando cache geral...
php artisan cache:clear
echo.

echo [5/5] Otimizando configuracao...
php artisan config:cache
echo.

echo ========================================
echo   Cache limpo com sucesso!
echo ========================================
echo.
echo Pressione qualquer tecla para fechar...
pause > nul
