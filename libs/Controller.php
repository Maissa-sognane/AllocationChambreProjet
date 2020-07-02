<?php
class Controller{
    protected $layout;
    protected $view;
    protected $folder;
    protected $data_view = [];
    protected $dao;
    protected $validator;

    public function render(){

        $pathView="./views/".$this->folder."/".$this->view.".php";
        $pathLayout="./views/layout/".$this->layout.".php";
        ob_start();
        extract($this->data_view);
        require_once($pathView);
        $content_for_layout=ob_get_clean();
        require_once($pathLayout);
    }

}
