<?php

namespace Framework\Middleware;

class Authenticated implements MiddlewareInterface
{
    public function handle(): void
    {
        if(!isset($_SESSION['user'])){
          redirect('/login');
        }
    }
}