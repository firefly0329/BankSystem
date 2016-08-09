<?php 
session_start();
header("Content-Type:text/html; charset=utf-8");
class Detail_Controller extends Controller
{
    
    public function detail($msg = "") 
    {
        $memberModel = $this->model("Member_Model");
        $detailModel = $this->model("Detail_Model");
        $detail = $detailModel->getDetail();
        $total = $memberModel->getTotal();
        // var_dump($result);
        $this->view("detail", array($detail, $total, $msg));
    }
    public function memberLogin()
    {
        $memberModel = $this->model("Member_Model");
        $memberModel->setSESSION($_POST['account']);
        header("location:/BankSystem/Detail_Controller/detail");
    }
    public function changeMoney()
    {
        $memberModel = $this->model("Member_Model");
        $detailModel = $this->model("Detail_Model");
        
        $msg = $memberModel->setTotal($_POST['change'], $_POST['money']);
        // echo $msg;
        if ($msg == "修改成功") {
            // echo $msg;
            $detailModel->setDetail($_POST['change'], $_POST['money']);
            
            // header("location:/BankSystem/Detail_Controller/detail/");
        }
        
        $this->detail($msg);
        
    }
    
}

?>