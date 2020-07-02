<?php
class Boursiers implements ILocation {

    private $id;
    private $ishoused;
    private $id_etudiant;
    private $id_type_bourse;
    private $id_chambre;


    public   function __construct($row=null){
        if($row!=null){
            $this->hydrate($row);
        }
    }

    public  function hydrate($row){
        $this->id=$row['id'];
        $this->ishoused=$row['ishoused'];
        $this->id_etudiant=$row['id_etudiant'];
        $this->id_type_bourse=$row['id_type_bourse'];
        $this->id_chambre=$row['id_chambre'];
    }

    /**
     * @return mixed
     */
    public function getIdChambre()
    {
        return $this->id_chambre;
    }

    /**
     * @param mixed $id_chambre
     */
    public function setIdChambre($id_chambre)
    {
        $this->id_chambre = $id_chambre;
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
    public function getIshoused()
    {
        return $this->ishoused;
    }

    /**
     * @param mixed $ishoused
     */
    public function setIshoused($ishoused)
    {
        $this->ishoused = $ishoused;
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

    /**
     * @return mixed
     */
    public function getIdTypeBourse()
    {
        return $this->id_type_bourse;
    }

    /**
     * @param mixed $id_type_bourse
     */
    public function setIdTypeBourse($id_type_bourse)
    {
        $this->id_type_bourse = $id_type_bourse;
    }



}
