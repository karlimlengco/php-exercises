<?php

namespace Everwing\Controllers;

class CoolController
{
    public function index()
    {
        return view('parameter', [
            'persons' => 'Darick'
        ]);
    }
}