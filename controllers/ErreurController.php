<?php
class ErreurController{

    public function showError($errorMessage){
        die($errorMessage);
    }
}