@echo off
cd /d "%~dp0\Modulo Servicios\La esperanza\public"
start "" /B php -S localhost:3000
start "" http://localhost:3000