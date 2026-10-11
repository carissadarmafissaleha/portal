<p align="center">
    <a href="https://github.com/filamentphp/filament/actions"><img alt="Filament" src="https://img.shields.io/badge/Filament-v3.x-orange?style=for-the-badge"></a>
    <a href="https://laravel.com"><img alt="Laravel v11.x" src="https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://livewire.laravel.com"><img alt="Livewire v3.x" src="https://img.shields.io/badge/Livewire-v3.x-FB70A9?style=for-the-badge"></a>
    <a href="https://php.net"><img alt="PHP 8.2" src="https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php"></a>
</p>

<br>
<br>

## Screenshot

<summary> 
<p align="center">
    <img src="#" />
    <br>
      <em>-</em>

</p>
</summary>

---

## Installation Guide

Follow the steps below to set up the project:

1. Copy the example environment file and update as necessary:
   ```bash
   cp .env.example .env
   ```
2. Install project dependencies:
   ```bash
   composer install
   ```
3. Generate the application key:
   ```bash
   php artisan key:generate
   ```
4. Run database migrations:
   ```bash
   php artisan migrate
   ```
5. (Optional) Refresh the database with seed data:
   ```bash
   php artisan migrate:fresh --seed
   ```
6. Optimize the application:
   ```bash
   php artisan optimize:clear
   ```
7. Generate permissions and roles:
   ```bash
   php artisan shield:generate --all
   ```

    ```bash
   php artisan shield:super-admin
   ```
8. Create a symbolic link for storage:
   ```bash
   php artisan storage:link
   ```
9. Install front-end dependencies:
   ```bash
   npm install
   ```
10. Build front-end assets:
    ```bash
    npm run build
    ```
11. Serve the application:
    ```bash
    php artisan serve
    ```

### Installing VS Code Extensions

To install all required VS Code extensions, run:
```bash
cat extensions-list.txt | xargs -n 1 code --install-extension
```

### Command for Setting Storage Link in cPanel

If deploying in cPanel, use the following command to set up the storage link:
```bash
ln -s /home/username/public_html/web.com/storage/app/public /home/username/public_html/web.com/public/storage
```
(Replace `username` and `web.com` with your specific details.)

---


## Demo

## Framework

<p align="center">
    <a href="https://github.com/filamentphp/filament/actions"><img alt="Filament" src="https://img.shields.io/badge/Filament-v3.x-orange?style=for-the-badge"></a>
    <a href="https://laravel.com"><img alt="Laravel v10.x" src="https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://livewire.laravel.com"><img alt="Livewire v3.x" src="https://img.shields.io/badge/Livewire-v3.x-FB70A9?style=for-the-badge"></a>
    <a href="https://php.net"><img alt="PHP 8.1" src="https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php"></a>
</p>
