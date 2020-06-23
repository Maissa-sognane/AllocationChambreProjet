<?php
class Validator{
    private $errors=[];

    public function getErrors(){
        return $this->errors;
    }

    public function isValid(){
        return count($this->errors)==0;
    }


    public function isVide($champ,$key,$sms="Champ Obligatoire"){
        if($champ==""){
            $this->errors[$key]=$sms;
        }
    }

    public function isEamil($champ,$key,$sms="Champ Obligatoire"){}




}
