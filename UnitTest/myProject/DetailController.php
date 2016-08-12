<?php

require_once "Controller.php";
require_once "DatabasePDO.php";

class DetailController extends Controller
{
    public function changeMoney($money, $change, $account)
    {
        $memberModel = $this->model("MemberModel");
        $detailModel = $this->model("DetailModel");

        if ($money > 0) {

            $pdo = new DatabasePDO;
            $pdoLink = $pdo->linkConnection();
            try {
                $pdoLink->beginTransaction();
                //取得餘額並鎖資料(FOR UPDATE)
                $member = $memberModel->getTotalUpdate($account, $pdo);
                if ($change == "支出" && $money > $member['total']) {
                    throw new Exception("您的餘額不足");
                } else {
                    $result = $memberModel->setTotal($change, $money, $account, $member['version'], $pdo);
                    $result2 = $detailModel->setDetail($change, $money, $account, $pdo);
                }

                //version不一樣 丟出錯誤
                $member2 = $memberModel->getTotalUpdate($account, $pdo);
                if($member['version'] == $member2['version']){
                    throw new Exception("修改失敗");
                }

                if ($result == true && $result2 == true) {
                    $msg = "修改成功";
                } else {
                    throw new Exception("修改失敗");
                }
                $pdoLink->commit();
            } catch(Exception $err) {
                $pdoLink->rollback();
                $msg = $err->getMessage();
            }


        } else {
            $msg = "輸入金額必須大於0";
        }
        return $msg;
    }
}