<?php

class DetailController extends Controller
{
    public function detail($msg = "")
    {
        $memberModel = $this->model("MemberModel");
        $detailModel = $this->model("DetailModel");
        $detail = $detailModel->getDetail($_SESSION['account']);
        $total = $memberModel->getTotal($_SESSION['account']);
        $this->view("detail", [$detail, $total, $msg]);
    }

    public function memberLogin()
    {
        $memberModel = $this->model("MemberModel");
        $_SESSION['account'] = $_POST['account'];
        header("location:/BankSystem/DetailController/detail");
    }

    public function changeMoney()
    {
        $memberModel = $this->model("MemberModel");
        $detailModel = $this->model("DetailModel");

        if ($_POST['money'] > 0) {
            $pdo = new DatabasePDO;
            try{
                $pdoLink = $pdo->linkConnection();
                $pdoLink->beginTransaction();
                $member = $memberModel->getTotalUpdate($_SESSION['account'], $pdo);//取得餘額並鎖資料
                sleep(5);
                if ($_POST['change'] == "支出" && $_POST['money'] > $member['total']) {
                    throw new Exception("您的餘額不足");
                } else {
                    //更改餘額
                    $result = $memberModel->setTotal($_POST['change'], $_POST['money'], $_SESSION['account'], $pdo);
                    //增加明細
                    $result2 = $detailModel->setDetail($_POST['change'], $_POST['money'], $_SESSION['account']);
                }

                // echo $result;
                // echo $result2;

                $pdoLink->commit();
            } catch(Exception $err) {
                $pdoLink->rollback();
                $msg = $err->getMessage();
            }
        } else {
            $msg = "輸入金額必須大於0";
        }
        $this->detail($msg);
    }
}
