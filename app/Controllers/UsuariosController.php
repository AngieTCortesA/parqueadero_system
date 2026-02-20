<?php

namespace App\Controllers;

class UsuariosController
{
    public function index()
    {
        view('usuarios',[
            'title' => 'Usuarios',
        ]);
    }

    public function cuenta()
    {
        view('cuenta',[
            'title' => 'Mi Cuenta',
            ]);
    }

    public function configuracion()
    {
        view('configuracion',[
            'title' => 'Configuracion',
            ]);
    }

    public function editarCuenta()
    {
        $currentUser = session()->get('user');

        if (!$currentUser) {
            redirect('login');
        }

        $usuario = db()->query(
            'SELECT p_nombre, s_nombre, p_apellido, s_apellido, email, telefono 
            FROM usuarios 
            WHERE id = :id',
            ['id' => $currentUser['id']]
        )->first();

        if (!$usuario) {
            redirect('login');
        }

        return view('editar-cuenta', [
            'usuario' => $usuario,
            'title' => 'Editar Cuenta'
        ]);
    }

    public function cambiarContraseña()
    {
        view('cambiar-password',[
            'title' => 'Editar Contraseña',
            ]);
    }

    public function updateCuenta()
    {
        // Validación básica
        \Framework\Validator::make($_POST, [
            'p_nombre' => 'required|min:2',
            'p_apellido' => 'required|min:2',
            'email'    => 'required|email|domain:3shape.com',
            'telefono' => 'required|min:7',
        ]);

        $currentUser = session()->get('user');
        if (!$currentUser) {
            redirect('login', 'Debes iniciar sesión');
        }

        // Verificar email único si cambia
        $nuevoEmail = trim($_POST['email']);
        if ($nuevoEmail !== ($currentUser['email'] ?? '')) {
            $existe = db()->query('SELECT id FROM usuarios WHERE email = :email AND id != :id', [
                'email' => $nuevoEmail,
                'id'    => $currentUser['id'],
            ])->first();

            if ($existe) {
                session()->setFlash('errors', 'Ya existe una cuenta con este correo electrónico');
                back();
            }
        }

        db()->query(
            'UPDATE usuarios SET p_nombre = :p_nombre, s_nombre = :s_nombre, p_apellido = :p_apellido, s_apellido = :s_apellido, email = :email, telefono = :telefono WHERE id = :id',
            [
                'p_nombre'   => trim($_POST['p_nombre']),
                's_nombre'  => trim($_POST['s_nombre']),
                'p_apellido'   => trim($_POST['p_apellido']),
                's_apellido'  => trim($_POST['s_apellido']),
                'email'    => $nuevoEmail,
                'telefono' => trim($_POST['telefono']),
                'id'       => $currentUser['id'],
            ]
        );

        // Refrescar sesión mínima
        session()->set('user', [
            'id'    => $currentUser['id'],
            'email' => $nuevoEmail,
            'name'  => trim
                ($_POST['p_nombre'].' '.
                ($_POST['s_nombre'] ? $user['s_nombre'].' ' : '').
                $_POST['p_apellido'].' '.
                ($_POST['s_apellido'] ?? '')
                )      
        ]);

        // También sincronizar variables usadas en templates
        $_SESSION['usuario_nombre'] = trim(
            $_POST['p_nombre'].' '.
            ($_POST['s_nombre'] ?? '').' '.
            $_POST['p_apellido'].' '.
            ($_POST['s_apellido'] ?? '')
        );
        $_SESSION['usuario_email'] = $nuevoEmail;
        $_SESSION['usuario_telefono'] = trim($_POST['telefono']);

        session()->setFlash('success', 'Datos actualizados correctamente');
        redirect('/editar-cuenta');
    }

    public function passwordUpdate()
    {
        \Framework\Validator::make($_POST, [
            'current_password'  => 'required|min:6',
            'password'          => 'required|min:8',
            'password_confirm'  => 'required|min:8',
        ]);

        $currentUser = session()->get('user');
        if (!$currentUser) {
            redirect('login', 'Debes iniciar sesión');
        }

        if ($_POST['password'] !== $_POST['password_confirm']) {
            session()->setFlash('errors', 'Las contraseñas no coinciden');
            back();
        }

        // Obtener hash actual
        $user = db()->query('SELECT id, password FROM usuarios WHERE id = :id', [
            'id' => $currentUser['id']
        ])->first();

        if (!$user || !password_verify($_POST['current_password'], $user['password'])) {
            session()->setFlash('errors', 'La contraseña actual es incorrecta');
            back();
        }

        if (password_verify($_POST['password'], $user['password'])) {
            session()->setFlash('errors', 'La nueva contraseña debe ser diferente a la actual');
            back();
        }

        $nuevoHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        db()->query('UPDATE usuarios SET password = :password WHERE id = :id', [
            'password' => $nuevoHash,
            'id'       => $currentUser['id']
        ]);

        redirect('/cambiar-password', 'Contraseña actualizada correctamente');
    }

}

