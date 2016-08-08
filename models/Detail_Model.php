<?php 
session_start();
header("Content-Type:text/html; charset=utf-8");
class Detail_Model
{
    function getDetail()
    {
        $pdo = new dbPDO;
        
        $account = $_SESSION['account'];
        $grammer = "SELECT * FROM  `detail` WHERE `account` = :account";
        $paramArray = array(':account' => $account);
        $result = $pdo->selectAll($grammer,$paramArray);
        
        return $result;
    }
    
    function setDetail($change, $money)
    {
        $pdo = new dbPDO;
        
        $account = $_SESSION['account'];
        $grammer = "INSERT INTO `detail`(`change`, `money`, `account`) VALUES (:change, :money, :account)";
        $paramArray = array(':change' => $change,
                            ':money' => $money,
                            ':account' => $account);
        $result = $pdo->change($grammer,$paramArray);
        
        return $result;
    }
}



?>