<?php
class AdminController extends Controller{

    public  function __construct(){
        $this->folder="admin";
        $this->layout="admin";
        $this->validator=new Validator();

    }

    public function createEtudiant(){
        $this->view="CreateEtudiant";
        $this->render();
    }

    public function createChambre(){
        $this->view="CreateChambre";
        $this->render();
    }
    public function listeEtudiant(){
        $this->view="ListeEtudiant";
        $this->render();
    }
    public function listeChambre(){
        $this->view="ListeChambre";
        $this->render();
    }
}
