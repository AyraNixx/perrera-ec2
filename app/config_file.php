<?php

    define("ROOT_APP", dirname(__FILE__));

    define("ROOT_PERRERA", dirname("./" . __FILE__));

    echo ROOT_APP;

    $path = realpath(dirname(__FILE__) . '/include');
    ini_set('include_path', $path . PATH_SEPARATOR . ini_get('include_path'));


?>