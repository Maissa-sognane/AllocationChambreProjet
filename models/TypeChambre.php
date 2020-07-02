<?php
class TypeChambre implements ILocation {

    private $categorie;
    private $id;

    public   function __construct($row=null){
        if($row!=null){
            $this->hydrate($row);
        }
    }

    public  function hydrate($row){
        $this->id = $row['id'];
        $this->categorie = $row['categorie'];
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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }




}