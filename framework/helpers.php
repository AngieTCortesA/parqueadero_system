<?php

use Framework\Database;
use Framework\SessionManager;

function flash($mensaje, $tipo = 'success') {
    $_SESSION['flash_mensaje'] = $mensaje;
    $_SESSION['flash_tipo'] = $tipo;
}

if (!function_exists('root_path')) {
    function root_path(string $path): string
    {
        // return __DIR__ . '/../';
        return dirname(__DIR__) . '/' . normalize_path($path);
    }
}

if (!function_exists('normalize_path')) {
    function normalize_path(string $path): string
    {
        return trim($path, '/');
    }
}

if (!function_exists('view')) {
    function view(string $view, array $data = []): void
    {
        extract($data);

        $filePath = root_path("resources/{$view}.template.php");

        require $filePath;
    }
}

if (!function_exists('old')) { 
    function old (string $key, mixed $default = null): mixed 
    {
        $key = 'old_' . $key;

        return session()->getFlash($key,$default);
    }
}

if (!function_exists('requestIs')) {
    function requestIs(string $uri)
    {
        return $_SERVER['REQUEST_URI'] === '/' . normalize_path($uri);
    }
}

if (!function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        $config = require root_path('config/app.php');

        return $config[$key] ?? $default;
    }
}

if (!function_exists('redirect')) {
    function redirect(
        string $uri,
        string|null $message = null,
        string $type = 'success',
        int $status= 302
    ): void
    {
        if($message){
            session ()->setFlash('message',$message);
            session()->setFlash('type', $type);
        }

        http_response_code($status);

        header("Location: /" . normalize_path($uri));
        exit;
    }
}

if (!function_exists('db')) {
    function db(): Database
    {
        static $db = null;

        if ($db === null) {
            $db = new Database();
        }

        return $db;
    }
}

if (!function_exists('resource_path')) {
    function resource_path(string $path = ''): string 
    {
        return root_path("resources/{$path}");
    }
}

if (!function_exists('isAuthenticated')) {
    function isAuthenticated(): bool
    {
        return (bool) ($_SESSION['user'] ?? false);
    }
}

if (!function_exists('back')) {
    function back(): void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER'] ?? '/');
        exit;
    }
}

if (!function_exists('session')) {
    function session(): SessionManager
    {
        return new SessionManager();        
    }
}

if (!function_exists('errors')) {
    function errors(): string
    {
        $errors = session()->getFlash('errors') ?? [];

        if (empty($errors)){
            return '';
        }

        if(!is_array($errors)){
          $errors = [$errors];  
        }

        $html = '<ul class="mt-4 text-red-500">';

        foreach ($errors as $error) {
            $html .= "<li class='text-xs'>&rarr; {$error}</li>";
        }
        
        $html .= '</ul>';
    
        return $html;
    }
}

if (!function_exists('alert')) {
    function alert():string
    {
        $message = session()->getFlash('message');

        if (!$message){
            return '';
        }

        return <<<HTML
<div class="bg-blue-100 border border-blue-400 text-blue-700 text-xs px-2 py-1 rounded mb-4">
    <strong class="font-bold">&rarr;</strong>
    {$message}
</div>
HTML;
    }
}