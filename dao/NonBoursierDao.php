<?php
class NonBoursierDao extends Manager{
    public function add($obj){

    }
    public function update($obj){

    }

    public function __construct(){
        $this->tableName="non_boursier";
        $this->className="NonBoursier";
    }

    public function addEtudiantNonBoursier($adresse, $id_etudiant){
        $req = "INSERT INTO non_boursier (adresse,id_etudiant) VALUE (:adresse,:id_etudiant)";
        $row = array(
            'adresse'=>$adresse,
            'id_etudiant'=>$id_etudiant,

        );
        $ligne = $this->executeUpdate($req,$row);
        return $ligne;
    }

    public function findAllNonBoursiers()
    {
        $sql= "select * from non_boursier ";
        $req = $this->executeSelect($sql);
        return $req;
    }
}
