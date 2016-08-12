<?php

class DetailModel
{
    public function setDetail($change, $money, $account, $pdo)
    {
        $grammer = "INSERT INTO `detail`(`change`, `money`, `account`) VALUES (:change, :money, :account)";
        $paramArray = [
            ':change' => $change,
            ':money' => $money,
            ':account' => $account
        ];
        $result = $pdo->change($grammer, $paramArray);

        return $result;
    }
}
