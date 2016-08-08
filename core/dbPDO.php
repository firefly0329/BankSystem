<?php 

class dbPDO{
    private static $connection = null;
    function __construct()
    {
        $db = new PDO("mysql:host=localhost;dbname=BankSystem;port=3306", "firefly0329", "");
        $db->exec("SET CHARACTER SET utf8");
        self::$connection = $db;
        $db = null;
    }
    function __destruct()
    {
        self::$connection = null;
    }
    function lastInsertId()
    {
        return self::$connection->lastInsertId();
    }

    function selectAll($grammer,$paramArray)
    {
        $pdoLink = self::$connection;

        $prepare = $pdoLink->prepare($grammer);
        $prepare->execute($paramArray);
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    function selectOnce($grammer,$paramArray)
    {
        $pdoLink = self::$connection;
        
        $prepare = $pdoLink->prepare($grammer);
        $prepare->execute($paramArray);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
    function change($grammer,$paramArray)
    {
        $pdoLink = self::$connection;
        
        $prepare = $pdoLink->prepare($grammer);
        $result = $prepare->execute($paramArray);

        return $result;
    }
}



/*使用此class的範例

function getOnceActivity($Aid){
        $pdo = new dbPDO;

        $grammer = "SELECT * FROM  `activity` WHERE `Aid` = :Aid";
        $paramArray = array(':Aid' => $Aid);
        $result = $pdo->selectOnce($grammer, $paramArray);
        
        return $result;
    }

*/





?>
