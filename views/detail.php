<?php

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>sakamoto_activity</title>
        <link rel="stylesheet" type="text/css" href="/Activity/views/css/firefly_frame.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/Activity/views/css/table.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/Activity/views/css/form.css" media="screen">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    </head>
    <body>
        <div id="wrapper">
            <h1 class="ta-c pd-t-1">收支查詢</h1>
            <div class="pd-t-3">
                <form action="/BankSystem/DetailController/memberLogin" method="post" class="">
                    <div class="w-100">
                        <label for="">會員編號</label>
                        <input type="text" name="account" pattern="[0-9]{3,20}" value="<?php echo $_SESSION['account']; ?>"/>
                        <input type="submit" value="送出" name="memberBTM"/>
                    </div>
                </form>
            </div>
            <div class="pd-t-3">
                <h2 class="ta-c pd-b-1">明細</h2>
                <table class="margin-center">
                    <tr>
                        <th>收支</th>
                        <th>金額</th>
                    </tr>
                    <?php foreach($data[0] as $row){ ?>
                    <tr>
                        <td><?php echo $row['change']; ?></td>
                        <td><?php echo $row['money']; ?></td>
                    </tr>
                    <?php } ?>
                    
                </table>
                <h3 class="ta-c pd-t-1">餘額:<?php echo $data[1]['total']; ?></h3>
            </div>

            <div class="pd-t-3">
                <form action="/BankSystem/DetailController/changeMoney" method="post" class="">
                    <div class="w-100">
                        <label for="">收支</label>
                        <select name="change" id="">
                            <option value="收入">收入</option>
                            <option value="支出">支出</option>
                        </select>
                    </div>
                    <div class="w-100">
                        <label for="">金額</label>
                        <input type="text" name="money" value="1000"/>
                    </div>
                    <div class="w-100">
                        <!--<input type="hidden" id="Aid" name="Aid" value="">-->
                        <input type="submit" value="新增" name="changeBTN"/>
                    </div>
                    
                </form>
            </div>
            <h3 class="pd-t-3 pd-b-3 ta-c" style="color: red;"><?php echo $data[2]; ?></h3>


        </div>
        <script type="text/javascript" src="/Activity/views/js/jquery-1.11.3.min.js"></script>
    </body>
</html>