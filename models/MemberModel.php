<?php

class MemberModel
{
    public function getTotal($account)
   {
        $pdo = new DatabasePDO;

        $grammer = "SELECT `total` FROM  `member` WHERE `account` = :account";
        $paramArray = array(':account' => $account);
        $result = $pdo->selectOnce($grammer, $paramArray);

        return $result;
    }

    public function setTotal($change, $money, $account)
    {
        $pdo = new DatabasePDO;
        try{
            $pdoLink = $pdo->linkConnection();
            $pdoLink->beginTransaction();
            $grammer = "SELECT * FROM  `member` WHERE `account` = :account FOR UPDATE";//LOCK IN SHARE MODE SELECT
            $paramArray = array(':account' => $account);
            $member = $pdo->selectOnce($grammer, $paramArray);
            if ($change == "支出" && $money > $member['total']) {
                throw new Exception("您的餘額不足");
            } else {
                $change == "收入" ? $total = $member['total'] + $money : $total = $member['total'] - $money;
                $grammer = "UPDATE `member` SET `total` = :total WHERE `account` = :account";
                $paramArray = array(
                    ':total' => $total,
                    ':account' => $account
                );
                $result = $pdo->change($grammer, $paramArray);
                if ($result > 0) {
                    $msg = "修改成功";
                } else {
                    throw new Exception("修改失敗");
                }
            }
            $pdoLink->commit();
        }catch(Exception $err){
            $pdo->linkConnection()->rollback();
            $msg = $err->getMessage();
        }
        return $msg;
    }
}
