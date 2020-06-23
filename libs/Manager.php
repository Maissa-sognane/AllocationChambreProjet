<?php
abstract class Manager implements IDao{

    private $pdo = null;
    protected $tableName;
    protected $className;

    private function getConnexion(){
        if($this->pdo==null){
            try {
                $this->pdo = new PDO("mysql:host=localhost;dbname=sama_chambre","root","");
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            }catch (PDOException $ex){
                die('Erreur de connexion à la base de donné');
            }
        }
    }

    private function closeConnexion(){
        if($this->pdo != null){
            $this->pdo = null;
        }
    }

    public function executeUpdate($sql){
        $this->getConnexion();
        $nbreLigne= $this->pdo->exec($sql);
        $this->closeConnexion();
        return $nbreLigne;
    }

    public function executeSelect($sql){
        $this->getConnexion();
        $result=$this->pdo->query($sql);
        $data=[];
        foreach( $result as $rowBD){
            $data[]=new $this->className($rowBD);
        }
        $this->closeConnexion();
        return $data;

    }

    public function findAll(){
        $sql="select * from $this->tableName";
        $data=$this->executeSelect($sql);
    }
    public function findById($id){
        $sql="select * from $this->tableName where id=$id ";
        $data=$this->executeSelect($sql);
        return count($data)==1?$data[0]:$data;
    }

    public function delete($id){
        $sql="delete from $this->tableName where id=$id";
        return $this->executeUpdate($sql)!=0;
    }
}
