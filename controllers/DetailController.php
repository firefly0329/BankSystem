<?php

class DetailController extends Controller
{
    public function detail($msg = "")
    {
        $memberModel = $this->model("MemberModel");
        $detailModel = $this->model("DetailModel");
        $detail = $detailModel->getDetail();
        $total = $memberModel->getTotal();
        $this->view("detail", array($detail, $total, $msg));
    }

    public function memberLogin()
    {
        $memberModel = $this->model("MemberModel");
        $memberModel->setSESSION($_POST['account']);
        header("location:/BankSystem/Detail_Controller/detail");
    }

    public function changeMoney()
    {
        $memberModel = $this->model("MemberModel");
        $detailModel = $this->model("DetailModel");

        $msg = $memberModel->setTotal($_POST['change'], $_POST['money']);
        if ($msg == "修改成功") {
            $detailModel->setDetail($_POST['change'], $_POST['money']);
        }
        $this->detail($msg);
    }
}

?>