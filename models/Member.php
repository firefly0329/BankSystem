<?php 
session_start();
header("Content-Type:text/html; charset=utf-8");
class Member{
    
    function setSESSION($account)
    {
        $_SESSION['account'] = $account;
    }
    function unsetSESSION($account)
    {
        unset($_SESSION['account']);
    }
    
    function getTotal(){
        $pdo = new dbPDO;
        
        $account = $_SESSION['account'];
        $grammer = "SELECT `total` FROM  `member` WHERE `account` = :account";
        $paramArray = array(':account' => $account);
        $result = $pdo->selectOnce($grammer,$paramArray);
        
        // var_dump($result);
        return $result;
    }
}



?>