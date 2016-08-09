<?php

class DetailModel
{
    public function getDetail($account)
    {
        $pdo = new DatabasePDO;

        $grammer = "SELECT * FROM  `detail` WHERE `account` = :account";
        $paramArray = array(':account' => $account);
        $result = $pdo->selectAll($grammer, $paramArray);

        return $result;
    }

    public function setDetail($change, $money, $account)
    {
        $pdo = new DatabasePDO;

        $grammer = "INSERT INTO `detail`(`change`, `money`, `account`) VALUES (:change, :money, :account)";
        $paramArray = array(
            ':change' => $change,
            ':money' => $money,
            ':account' => $account
        );
        $result = $pdo->change($grammer, $paramArray);

        return $result;
    }
}
