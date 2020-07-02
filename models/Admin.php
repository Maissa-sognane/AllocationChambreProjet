<?php
class Admin implements ILocation {
    private $login;
    private $pwd;
    private $nom;



    public   function __construct($row=null){
        if($row!=null){
            $this->hydrate($row);
        }
    }

    public  function hydrate($row){
        $this->id=$row['id'];
        $this->nom=$row['pwd'];
    }


    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }


}
