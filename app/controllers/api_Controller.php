<?php
    require_once 'app/view/json_View.php';
        class controller {
        protected $view;
        private $data;

        public function __construct(){

            $this->view = new jsonView();
            $this->data = file_get_contents('php://input');
        }

        function getData(){
            return json_decode($this->data);
        }
    }
