<?php
    // load config
    require_once '../app/config/config.php';
    // Load helpers
    require_once '../app/helpers/url_helper.php';
    require_once '../app/helpers/session_helper.php';

    // Autoload core libs
    spl_autoload_register(function($className){
        require 'libs/'.$className.'.php';
    });