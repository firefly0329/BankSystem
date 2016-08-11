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
        $grammer = "SELECT * FROM  `member` WHERE `account` = :account";
        $paramArray = [':account' => $account];
        $member = $pdo->selectOnce($grammer, $paramArray);

        return $member;
    }
    public function setTotal($change, $money, $account, $version, $pdo)
    {
        if ($change == "支出") {
            $money = -($money);
        }
        $grammer = "UPDATE `member` SET `total` = `total` + :money ,`version`= `version` + 1
            WHERE (`account` = :account AND `version` = :version)";
        $paramArray = [
            ':money' => $money,
            ':account' => $account,
            ':version' => $version
        ];
        $result = $pdo->change($grammer, $paramArray);

        return $result;
    }
}
