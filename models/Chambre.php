<?php
class Chambre{

    private $id;
    private $numeroChambre;
    private $numeroBatiment;

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


}