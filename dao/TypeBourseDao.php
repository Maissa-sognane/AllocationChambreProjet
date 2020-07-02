<?php

class TypeBourseDao extends Manager{

    public function add($obj){

    }
    public function update($obj){

    }

    public function __construct(){
        $this->tableName="type_bourse";
        $this->className="TypeBourse";
    }

    public function findTypeBourse(){
        $sql = "select * from $this->tableName";
        $data = $this->executeSelect($sql);
        extract($data);
        return $data;
    }

    public function searchBourse($search){
        $sql = "select * from type_bourse where libele like '%$search%'";
        $data = $this->executeSelect($sql);
        return $data;
    }

    public function findElementBourse($type){
        $this->tableName = 'type_bourse';
        $sql = "select id from $this->tableName where libele = '$type'";
        $data = $this->executeSelect($sql);
        var_dump($data);
        return $data;
    }
}
