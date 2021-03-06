<?php

class ChambreDao extends Manager{

    public function add($obj){

    }
    public function update($obj){

    }

    public function __construct(){
        $this->tableName="chambre";
        $this->className="Chambre";
    }
    public function searchByChambre($search){
        $sql = "select * from chambre where numeroChambre like '%$search%'";
        $data = $this->executeSelect($sql);
        return $data;
    }

    public function conmpterChambre(){
        $sql = 'select count(*) as allcount from chambre';
        $req = $this->compter($sql);
        return $req;
    }

    public function findChambre($rowid, $rowperpage){
        $sql = "select * from chambre order by id asc limit $rowid, $rowperpage";
        $data = $this->executeSelect($sql);
        extract($data);
        return $data;
    }

    public  function findAll()
    {
        $this->tableName = 'chambre';
        return parent::findAll(); // TODO: Change the autogenerated stub
    }

    public function addChambre($numeroChambre, $numeroBatiment, $id_type_chambre){
        $req = "INSERT INTO chambre (numeroChambre,numeroBatiment,id_type_chambre) VALUE (:numeroChambre, :numeroBatiment, :id_type_chambre)";
        $row = array(
            'numeroChambre'=>$numeroChambre,
            'numeroBatiment'=>$numeroBatiment,
            'id_type_chambre'=>$id_type_chambre,
        );
        $ligne = $this->executeUpdate($req,$row);
        return $ligne;
    }

    public function updateChambre($id,$numeroChambre,$numeroBatiment){
        $req =  "UPDATE chambre SET numeroChambre = :numeroChambre,numeroBatiment = :numeroBatiment WHERE id = $id";
        $row = array(
            'numeroChambre'=>$numeroChambre,
            'numeroBatiment'=>$numeroBatiment
        );
        $data =  $this->executeUpdate($req,$row);
        return $data;

    }

    public function delete($id)
    {
        $this->tableName = 'chambre';
        return parent::delete($id); // TODO: Change the autogenerated stub
    }
}

