<?php 
session_start();
header("Content-Type:text/html; charset=utf-8");
class Member_Model{
    
    function setSESSION($account)
    {
        $_SESSION['account'] = $account;
    }
    function unsetSESSION($account)
    {
        unset($_SESSION['account']);
    }
    
    function getTotal()
    {
        $pdo = new dbPDO;
        
        $account = $_SESSION['account'];
        $grammer = "SELECT `total` FROM  `member` WHERE `account` = :account";
        $paramArray = array(':account' => $account);
        $result = $pdo->selectOnce($grammer,$paramArray);
        
        // var_dump($result);
        return $result;
    }
    
    function setTotal($change, $money)
    {
        $pdo = new dbPDO;
        try{
            $pdo->linkConnection()->beginTransaction();
        
            $account = $_SESSION['account'];
            $grammer = "SELECT * FROM  `member` WHERE `account` = :account FOR UPDATE";
            $paramArray = array(':account' => $account);
            $member = $pdo->selectOnce($grammer,$paramArray);
            
            if ($change == "支出" && $money > $member['total']) {
                throw new Exception("您的餘額不足");
            } else {
                $change == "收入" ? $total = $member['total'] + $money : $total = $member['total'] - $money;
                $grammer = "UPDATE `member` SET `total` = :total WHERE `account` = :account";
                $paramArray = array(':total' => $total,
                                    ':account' => $account);
                // var_dump($paramArray);
                $result = $pdo->change($grammer, $paramArray);
                if ($result > 0) {
                    $msg = "修改成功";
                } else {
                    throw new Exception("修改成功");
                }
            }
            $pdo->linkConnection()->commit();
        }catch(Exception $err){
            $pdo->linkConnection()->rollback();
            $msg = $err->getMessage();
        }
        return $msg;
    }
}



?>