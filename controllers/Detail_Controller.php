<?php 
// session_start();
header("Content-Type:text/html; charset=utf-8");
class Detail_Controller extends Controller
{
    
    function detail() 
    {
        $memberModel = $this->model("Member");
        $detailModel = $this->model("Detail");
        $detail = $detailModel->getDetail();
        $total = $memberModel->getTotal();
        // var_dump($result);
        $this->view("detail", array($detail,$total));
    }
    function memberLogin()
    {
        $memberModel = $this->model("Member");
        if (isset($_POST['memberBTM'])) {
            $memberModel->setSESSION($_POST['account']);
            header("location:/BankSystem/Detail_Controller/detail");
        }
    }
    
}

?>