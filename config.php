<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define('BASE_PATH', __DIR__);
define('URL_SITE', 'https://localhost/www/Lince/');
define('VERSION', '1.0.0.0');
