<?php
interface IDao{
    public function add($obj);
    public function update($objet);
    public function delete($id);
    public function findAll();
    public function findById($id);
}
