<?php 
header("Content-Type:text/html; charset=utf-8");
class Detail_Controller extends Controller
{
    function detail() 
    {
        $memberModel = $this->model("Member");
        $memberModel->detail();
        $this->view("detail");
    }
    function memberLogin(){
        $memberModel = $this->model("Member");
        if(isset($_POST['memberBTM'])){
            $memberModel->setSESSION($_POST['account']);
            $this->detail();
        }
    }
    
}

?>