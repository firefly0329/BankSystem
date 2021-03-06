<?php

class DatabasePDO
{
    private static $connection = null;

    public function __construct()
    {
        $db = new PDO("mysql:host=localhost;dbname=BankSystem;port=3306", "firefly0329", "");
        $db->exec("SET CHARACTER SET utf8");
        self::$connection = $db;
        unset($db);
        echo "<script>console.log('資料庫連線1')</script>";
    }

    public function __destruct()
    {
        self::$connection = null;
        echo "<script>console.log('資料庫斷線1')</script>";
    }

    public function linkConnection()
    {
        return self::$connection;
    }

    public function selectAll($grammer, $paramArray)
    {
        $pdoLink = self::$connection;

        $prepare = $pdoLink->prepare($grammer);
        $prepare->execute($paramArray);
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function selectOnce($grammer, $paramArray)
    {
        $pdoLink = self::$connection;

        $prepare = $pdoLink->prepare($grammer);
        $prepare->execute($paramArray);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function change($grammer, $paramArray)
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