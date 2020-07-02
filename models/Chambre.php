<?php
class Chambre implements ILocation {

    private $id;
    private $numeroChambre;
    private $numeroBatiment;
    private $id_type_chambre;

    public   function __construct($row=null){
        if($row!=null){
            $this->hydrate($row);
        }
    }

    public  function hydrate($row){
        $this->id=$row['id'];
        $this->numeroChambre = $row['numeroChambre'];
        $this->numeroBatiment = $row['numeroBatiment'];
        $this->id_type_chambre = $row['id_type_chambre'];
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
    public function getNumeroChambre()
    {
        return $this->numeroChambre;
    }

    /**
     * @param mixed $numeroChambre
     */
    public function setNumeroChambre($numeroChambre)
    {
        $this->numeroChambre = $numeroChambre;
    }

    /**
     * @return mixed
     */
    public function getNumeroBatiment()
    {
        return $this->numeroBatiment;
    }

    /**
     * @param mixed $numeroBatiment
     */
    public function setNumeroBatiment($numeroBatiment)
    {
        $this->numeroBatiment = $numeroBatiment;
    }

    /**
     * @return mixed
     */
    public function getIdTypeChambre()
    {
        return $this->id_type_chambre;
    }

    /**
     * @param mixed $id_type_chambre
     */
    public function setIdTypeChambre($id_type_chambre)
    {
        $this->id_type_chambre = $id_type_chambre;
    }




}