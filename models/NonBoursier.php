<?php
class NonBoursier implements ILocation {

    private $id;
    private $adresse;
    private $id_etudiant;

    public   function __construct($row=null){
        if($row!=null){
            $this->hydrate($row);
        }
    }

    public  function hydrate($row){
        $this->id=$row['id'];
        $this->adresse=$row['adresse'];
        $this->id_etudiant=$row['id_etudiant'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getIdEtudiant()
    {
        return $this->id_etudiant;
    }

    /**
     * @param mixed $id_etudiant
     */
    public function setIdEtudiant($id_etudiant)
    {
        $this->id_etudiant = $id_etudiant;
    }




}
