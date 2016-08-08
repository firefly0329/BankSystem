<?php 
session_start();
header("Content-Type:text/html; charset=utf-8");
class Detail
{
    function getDetail()
    {
        // if(isset($_SESSION['account'])){
            $pdo = new dbPDO;
            
            $account = $_SESSION['account'];
            $grammer = "SELECT * FROM  `detail` WHERE `account` = :account";
            $paramArray = array(':account' => $account);
            $result = $pdo->selectAll($grammer,$paramArray);
            
            // var_dump($result);
            return $result;
        // } 
    }
}



?>