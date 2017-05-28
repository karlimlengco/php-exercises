<?php

namespace Everwing;

class View
{
    protected $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function render($view, $data = [])
    {
        $file = $view . '.php';

        if (!file_exists($this->basePath. '/' . $file)) {
            throw new \Exception('View does not exists.');
        }

        extract($data);

        require_once($this->basePath . '/' . $file);
    }
}