<?php

if (! function_exists('view')) {
    function view($view, $data= [])
    {
        $viewRenderer = new \Everwing\View(__DIR__.'/pages');

        return $viewRenderer->render($view, $data);
    }
}
