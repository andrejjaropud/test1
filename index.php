<?php

use \Controllers\MainController;

    require_once('src/Autoloader.php');
    spl_autoload_register('Autoloader::loader');

    MainController::run();
