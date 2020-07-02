<?php
class TypeChambreDao extends Manager{

    public function add($obj){

    }
    public function update($obj){

    }

    public function __construct(){
        $this->tableName="type_chambre";
        $this->className="TypeChambre";
    }

    public function findTypeChambre(){
        $sql = "select * from $this->tableName";
        $data = $this->executeSelect($sql);
        extract($data);
        return $data;
    }

}
