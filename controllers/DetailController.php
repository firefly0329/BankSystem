<?php

class DetailController extends Controller
{
    public function detail($msg = "")
    {
        $memberModel = $this->model("MemberModel");
        $detailModel = $this->model("DetailModel");
        $detail = $detailModel->getDetail($_SESSION['account']);
        $total = $memberModel->getTotal($_SESSION['account']);
        $this->view("detail", array($detail, $total, $msg));
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
            $msg = $memberModel->setTotal($_POST['change'], $_POST['money'], $_SESSION['account']);
        } else {
            $msg = "輸入金額必須大於0";
        }
        if ($msg == "修改成功") {
            $detailModel->setDetail($_POST['change'], $_POST['money'], $_SESSION['account']);
        }
        $this->detail($msg);
    }
}