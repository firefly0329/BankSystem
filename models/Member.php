<?php 
session_start();
class Member{
    
    function setSESSION($account)
    {
        $_SESSION['account'] = $account;
    }
    function detail()
    {
        if(isset($_SESSION['account'])){
            $pdo = new dbPDO;

            $grammer = "SELECT * FROM  `member` WHERE `account` = :account";
            $paramArray = array(':account' => $_SESSION['account']);
            $result = $pdo->selectAll($grammer,$paramArray);
        
            return $result;
        } 
    }
}



?>