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
            $pdoLink = $pdo->linkConnection();
            try {
                $pdoLink->beginTransaction();
                //取得餘額並鎖資料(FOR UPDATE)
                $member = $memberModel->getTotalUpdate($_SESSION['account'], $pdo);
                if ($_POST['change'] == "支出" && $_POST['money'] > $member['total']) {
                    throw new Exception("您的餘額不足");
                } else {
                    $result = $memberModel->setTotal($_POST['change'], $_POST['money'], $_SESSION['account'], $member['version'], $pdo);
                    $result2 = $detailModel->setDetail($_POST['change'], $_POST['money'], $_SESSION['account'], $pdo);
                }

                //version不一樣 丟出錯誤
                $member2 = $memberModel->getTotalUpdate($_SESSION['account'], $pdo);
                if($member['version'] == $member2['version']){
                    throw new Exception("修改失敗");
                }

                if ($result == true && $result2 == true) {
                    $msg = "修改成功";
                } else {
                    throw new Exception("修改失敗");
                }
                sleep(5);
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
