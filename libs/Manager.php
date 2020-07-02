<?php
abstract class Manager implements IDao{

    private $pdo = null;
    protected $tableName;
    protected $className;

    public function getConnexion(){
        if($this->pdo==null){
            try {
                $this->pdo = new PDO("mysql:host=localhost;dbname=sama_chambre","root","");
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            }catch (PDOException $ex){
                die('Erreur de connexion à la base de donné');
            }
        }
    }

    public function closeConnexion(){
        if($this->pdo != null){
           $this->pdo = null;
        }
    }

    public function executeUpdate($sql,$row){
        $this->getConnexion();
        $prepare = $this->pdo->prepare($sql);
        $nbreLigne = $prepare->execute($row);
        $id = $this->pdo->lastInsertId();
        $tab = [$id,$nbreLigne];
        $this->closeConnexion();
        return $tab;
    }

    public function executeUpdateSimple($sql){
        $this->getConnexion();
        $nbreLigne = $this->pdo->exec($sql);
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

    public function compter($sql){
        $this->getConnexion();
        $result=$this->pdo->query($sql);
        $fetchresult = $result->fetch();
        return $fetchresult;
    }


    public function findAll(){
        $sql="select * from $this->tableName";
        $data=$this->executeSelect($sql);
        return $data;
    }
    public function findById($id){
        $sql="select * from $this->tableName where id=$id ";
        $data=$this->executeSelect($sql);
        return count($data)==1?$data[0]:$data;
    }

    public function findByelement($id, $elementTable){
        $sql="select * from $this->tableName where $elementTable=$id ";
        $data=$this->executeSelect($sql);
        return $data;
    }

    public function findByEmail($email){
        $this->getConnexion();
        $sql="select * from $this->tableName where email='$email' ";
        $req = $this->pdo->query($sql);

        $this->closeConnexion();
        return $req;
    }

    public function findLastId(){
        $this->getConnexion();
            $id = $this->pdo->lastInsertId();
        $this->closeConnexion();
        var_dump($this->pdo);
        return $id;
    }

    public function delete($id){
        $sql="delete from $this->tableName where id=$id";
        return $this->executeUpdateSimple($sql)!=0;
    }
}
