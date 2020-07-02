<?php

class AdminDao extends Manager {

    public function __construct(){
        $this->tableName="admin";
        $this->className="Admin";
    }
    public function add($obj){
        $sql="";
        return $this->executeUpdate($sql)!=0;
    }
    public function update($obj){

    }

    public function findByLoginAndPwd($login,$pwd){
        $sql="select * from $this->tableName where login='$login'  and pwd='$pwd' ";
        $data=$this->executeSelect($sql);
        if(count($data)==0){
            return null;
        }
        return count($data)==1?$data[0]:$data;
    }



}
