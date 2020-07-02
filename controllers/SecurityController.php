<?php
session_start();
class SecurityController extends Controller{

    public  function __construct(){
        $this->folder="admin";
        $this->layout="default";
        $this->validator=new Validator();

    }

    public function index(){
        $this->view = 'connexion';
        $this->render();
    }


    public function connexion(){
        if(isset($_POST['btn_connexion'])){
            extract($_POST);
            $this->dao=new AdminDao();
            //Validation
            $this->validator->isVide($login,"login","Le Login est vide");
            $this->validator->isVide($password,"password","Le Mot de Passe est vide");
            if($this->validator->isValid()){
                $user=$this->dao->findByLoginAndPwd($login,$password);
                if($user!=null){
                    //Ajouter dans la session
                        $_SESSION['statut'] = 1;
                        if(isset($_SESSION['statut'])){
                            $this->layout = "admin";
                            $this->view = "CreateEtudiant";
                            $this->render();
                        }
                }else{
                    //User Not Existe
                    $this->data_view["error"]="Login Mot de Passe Incorrect";
                    $this->index();
                }

            }else{
                $this->data_view["error"]= $this->validator->getErrors();
                $this->index();
            }

        }else{
            if(!isset($_SESSION['statut'])){
                $this->index();
            }
        }
    }
    public function deconnexion(){
        $this->index();
        session_destroy();
    }

}