<?php

class MemberModel
{
    public function getTotal($account)
   {
        $pdo = new DatabasePDO;

        $grammer = "SELECT `total` FROM  `member` WHERE `account` = :account";
        $paramArray = [':account' => $account];
        $result = $pdo->selectOnce($grammer, $paramArray);

        return $result;
    }

    public function getTotalUpdate($account, $pdo)
    {
        $grammer = "SELECT * FROM  `member` WHERE `account` = :account FOR UPDATE";
        $paramArray = [':account' => $account];
        $member = $pdo->selectOnce($grammer, $paramArray);
        return $member;
    }
    public function setTotal($change, $money, $account, $pdo)
    {
        if ($change == "支出") {
            $money = -($money);
        }
        $grammer = "UPDATE `member` SET `total` = `total` + :money WHERE `account` = :account";
        $paramArray = [
            ':money' => $money,
            ':account' => $account
        ];
        $result = $pdo->change($grammer, $paramArray);
        return $result;
    }
}
