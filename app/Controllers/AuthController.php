<?php

namespace App\Controllers;

use Framework\Authenticate;
use Framework\Validator;

class AuthController
{
    public function login()
    {
        view('login');
    }

    public function authenticate()
    {
         \Framework\Validator::make($_POST, [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $auth = new \Framework\Authenticate();

        if (!$auth->login($_POST['email'], $_POST['password'])) {
            session()->setFlash('errors', 'Credenciales incorrectas');
            back();
        }

        redirect('/');
    }


    public function logout()
    {
        (new Authenticate())->logout();
        redirect('/login');
    }

 // Mostrar el formulario de registro
public function register()
{
    view('registrar');
}

public function reglamento()
{
    view('reglamento');
}

// Procesar el registro de nuevo usuario
public function store()
{
    // Validar los datos del formulario
    Validator::make($_POST, [
        'primer_nombre'   => 'required|min:2',
        'primer_apellido' => 'required|min:2',
        'email'           => 'required|email|domain:3shape.com',
        'telefono'        => 'required|min:10',
        'password'        => 'required|min:6',
        'repeat-password' => 'required|min:6',
        'terms'          =>  'required'
    ]);

    // Verificar que las contraseñas coincidan
    if ($_POST['password'] !== $_POST['repeat-password']) {
        session()->setFlash('errors', 'Las contraseñas no coinciden');
        session()->setFlash('old_name', $_POST['name'] ?? '');
        session()->setFlash('old_email', $_POST['email'] ?? '');
        back();
    }

    // Verificar que el email no esté ya registrado
    $existingUser = db()->query('SELECT id FROM usuarios WHERE email = :email', [
        'email' => $_POST['email']
    ])->first();

    if ($existingUser) {
        session()->setFlash('errors', 'Ya existe una cuenta con este correo electrónico');
        session()->setFlash('old_primer_nombre', $_POST['primer_nombre'] ?? '');
        session()->setFlash('old_email', $_POST['email'] ?? '');
        back();
    }

    // Crear el nuevo usuario
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        
        db()->query('INSERT INTO usuarios (p_nombre, s_nombre, p_apellido, s_apellido, telefono, email, password, fecha_registro) VALUES (:p_nombre, :s_nombre, :p_apellido, :s_apellido, :telefono, :email, :password, NOW())', [
            'p_nombre'  =>  $_POST['primer_nombre'],
            's_nombre'  =>  $_POST['segundo_nombre'] ?? null,
            'p_apellido'  =>  $_POST['primer_apellido'],
            's_apellido'  =>   $_POST['segundo_apellido'] ?? null,
            'email'    => $_POST['email'],
            'telefono' => $_POST['telefono'],
            'password' => $hashedPassword
        ]);

    } catch (\Throwable $e) {
        echo $e->getMessage();
        die();
    }

    // Redirigir al usuario a la página principal
    session()->setFlash('success', 'Cuenta creada correctamente. Inicia sesión.');
    redirect('/login');
}
}