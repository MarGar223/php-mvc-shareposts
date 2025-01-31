<?php
    /*
    * App Core Class
    * Creates URL n' loads core controller
    * URL FORMAT - /controller/method/params
    */
    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            // print_r($this->getUrl());
            $url = $this->getUrl();

            // Look in controllers for first value
            if (file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
                // if exists, set as controller
                $this->currentController = ucwords($url[0]);
                // unset 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once '../app/controllers/'.$this->currentController.'.php';

            // instansiate controller class
            $this->currentController = new $this->currentController;

            //Check for 2nd part of url
            if(isset($url[1])){
                //Check if see method exists in controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl()
        {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }