<?php

use controller\HomeC;
use controller\LoginC;

    return function (\FastRoute\RouteCollector $r)
    {
        $r->addRoute('GET', '/', [LoginC::class, 'index']);
        $r->addRoute('GET', '/home', [HomeC::class, 'index']);
    }

?>