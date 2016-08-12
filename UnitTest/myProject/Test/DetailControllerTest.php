<?php

require_once "myProject/DetailController.php";

class DetailControllerTest extends \PHPUnit_Framework_TestCase {

    public function testRepeatString1() {
        $detailController = new DetailController;
        $money = 200;
        $change = "支出";
        $account = "111";
        $expectedResult = "修改成功";

        $result = $detailController->changeMoney($money, $change, $account);
        $this->assertEquals($expectedResult, $result);
    }


    public function testRepeatString2() {
        $detailController = new DetailController;
        $money = 400;
        $change = "支出";
        $account = "111";
        $expectedResult = "您的餘額不足";

        $result = $detailController->changeMoney($money, $change, $account);
        $this->assertEquals($expectedResult, $result);
    }

    public function testRepeatString3() {
        $detailController = new DetailController;
        $money = -2000;
        $change = "支出";
        $account = "111";
        $expectedResult = "輸入金額必須大於0";

        $result = $detailController->changeMoney($money, $change, $account);
        $this->assertEquals($expectedResult, $result);
    }

    public function testRepeatString4() {
        $detailController = new DetailController;
        $money = 2000;
        $change = "收入";
        $account = "333";
        $expectedResult = "修改失敗";

        $result = $detailController->changeMoney($money, $change, $account);
        $this->assertEquals($expectedResult, $result);
    }





}


?>