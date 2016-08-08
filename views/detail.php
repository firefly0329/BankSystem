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
                <form action="/BankSystem/Detail_Controller/memberLogin" method="post" class="">
                    <div class="w-100">
                        <label for="">會員編號</label>
                        <input type="text" name="account" pattern="[0-9]{3,20}"/>
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
                    <!--<?php foreach($data[1] as $row){ ?>-->
                    <!--<tr>-->
                    <!--    <td><?php echo $row['Snumber']; ?></td>-->
                    <!--    <td><?php echo $row['Sname']; ?></td>-->
                    <!--    <td><?php echo $row['sign']; ?></td>-->
                    <!--    <td><?php echo $row['together']; ?></td>-->
                    <!--</tr>-->
                    <!--<?php } ?>-->
                    
                </table>
                <h3 class="ta-c pd-t-1">餘額</h3>
            </div>
            
            <div class="pd-t-3">
                <form action="/Activity/back_con/newPeople" method="post" class="">
                    <div class="w-100">
                        <label for="">收支</label>
                        <input type="text" name="Snumber" pattern="[0-9]{3,20}"/>
                    </div>
                    <div class="w-100">
                        <label for="">金額</label>
                        <input type="text" name="Sname"/>
                    </div>
                    <div class="w-100">
                        <!--<input type="hidden" id="Aid" name="Aid" value="">-->
                        <input type="submit" value="新增" name="changeBTN"/>
                    </div>
                    
                </form>
            </div>
            
        </div>
        <script type="text/javascript" src="/Activity/views/js/jquery-1.11.3.min.js"></script>
    </body>
</html>