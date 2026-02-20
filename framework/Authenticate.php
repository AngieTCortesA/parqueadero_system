<?php

namespace Framework;

class Authenticate
{
    public function login(string $email, string $password): bool
    {
        $user = db()->query('SELECT * FROM usuarios WHERE email = :email', [
            'email' => $email,
        ])->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user', [
                'id'    => $user['id'],
                'email' => $user['email'],
                'name'  => $user['nombres']
            ]);

            return true;
        } 

        return false;
    }

    public function logout(): void
    {
        // unset($_SESSION['user']);
        session()->remove('user');

        session_destroy();
    }
}