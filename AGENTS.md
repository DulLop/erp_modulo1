# Proyecto ERP Modulo 1

## Stack
- PHP 8.x
- Laravel
- MySQL
- Node.js
- TailwindCSS
- Vite

## Instalación de dependencias

Backend:
composer install

Frontend:
npm install

## Configuración del entorno

Copiar archivo .env:
cp .env.example .env

Generar key:
php artisan key:generate

Migraciones:
php artisan migrate

## Desarrollo

Servidor Laravel:
php artisan serve

Compilar frontend:
npm run dev

## Tests

php artisan test

## Notas importantes

- No modificar estructura base de Laravel
- Respetar arquitectura MVC
- Usar controladores para lógica
- No escribir lógica en vistas Blade
