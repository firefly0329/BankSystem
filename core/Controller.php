<?php

class Controller
{
    public function model($model)
    {
        require_once "DatabasePDO.php";
        require_once "../BankSystem/models/$model.php";
        $obj = new $model();
        return $obj;
    }

    public function view($view, $data = Array())
    {
        require_once "../BankSystem/views/$view.php";
    }
}
