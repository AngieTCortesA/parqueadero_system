<?php

namespace Framework\Middleware;

class Guest implements MiddlewareInterface
{
    public function handle(): void
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }
    }
}