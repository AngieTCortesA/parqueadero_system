<?php

namespace App\Controllers;

class AboutController
{
    public function index()
    {
        view('about',[
            'title' => 'Sistema de parqueadero',
        ]);
    }
}

