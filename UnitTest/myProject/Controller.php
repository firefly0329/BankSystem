<?php

class Controller
{
    public function model($model)
    {
        require_once "DatabasePDO.php";
        require_once "$model.php";
        $obj = new $model();
        return $obj;
    }

}
