<?php
session_start();
include_once("../../controller/db_connection.php");
//if (!isset($_SESSION['user'])) {
//    header("location: ../login.php");
//}
if(isset($_SESSION['admin'])) {
    $u = unserialize($_SESSION['admin']);

    $name = empty($u->name) ? $u->email : $u->name;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HTTV music – Music makes me</title>
    <meta name="author" content="ThaiVH"/>
    <meta name="description" content="soundcloud"/>
    <meta name="keyword" content="sound, cloud, music"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="/soundcloud/assets/ico/1.ico"/>
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/custom2.css">
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <link rel="stylesheet" href="\soundcloud\adcss\css\bootstrap.min.css">
    <link rel="stylesheet" href="\soundcloud\adcss\css\bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        function addmusic(){
            $('#result').html('<img src="loading.gif"/>');
            setTimeout(function(){
                $('#result').load('addmusic.php',$('#form_addmusic').serializeArray())
            }, 1000);
        }
        function addsong(){
            $('#result').html('<img src="loading.gif"/>');
            setTimeout(function(){
                $('#result').load('addsong.php',$('#form_addsong').serializeArray())
            }, 1000);
        }
        function play(){
            $('#result').html('<img src="loading.gif"/>');
            setTimeout(function(){
                $('#result').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Đang Phát !</strong> Phía Sau Một Cô Gái - SooBin Hoàng Sơn.</div>')
            }, 1000);
        }
        function edit(id){
            $('#'+id).load(''+id,null);

        }

        function Update(id){
            $('#result').html('<img src="loading.gif"/>');
            setTimeout(function(){
                $('#result').load('update.php?id='+id,$('#form'+id).serializeArray())
            }, 1000);
        }
    </script>
</head>
<body style="background-color: #f8f8f8">

<div class="container-fluid" >
    <div style="background-color: #5f5f5f">
<!--        <center><a href="http://StarPhucIT.Com" target="blank"><img src="logo.png" width="280"></a></center>-->
        <form id="form_search" class="form-inline" method="POST" action="search.php" style="padding-left: 10px;padding-bottom: 10px;">
            <input class="form-control" type="text" name="search" placeholder="Search users or songs" size="30">
            <button onclick="search();" class="btn btn-default" ><span class="glyphicon glyphicon-search"></span></button>
        </form>

    </div>
    <div class="row">
        <div class="col-md-9">
            <div id="main">
                <ul class="nav nav-tabs">
<!--                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>-->
<!--                    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>-->
                    <li><a data-toggle="tab" href="#menu1">Users</a></li>
                    <li><a data-toggle="tab" href="#menu2">Songs</a></li>
                </ul>
                <div class="tab-content">
                    <div id="menu1" class="tab-pane fade">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>ProUser</th>
                                <!--                        <th>Mã Nhạc</th>-->
                                <!--                        <th>Tác Vụ</th>-->
                            </tr>
                            </thead>
                            <!--                        <tbody>-->
                            <?php

                            $db_connect = db_connect();
                            $query = "SELECT userID,name,email,ispro FROM user";
                            $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
                            while($row = mysql_fetch_assoc($result)){
                                echo "<tr id=".$row['userID'].">";
                                echo '<td>'.$row['userID'].'</td>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.$row['email'].'</td>';
                                if ($row['ispro']) echo '<td>'.'Yes'.'</td>';
                                else echo'<td>'.'No'.'</td>';
//                        echo '<td>'.$row['type'].'</td>';
                                echo '<td>
								<a href="\soundcloud\view\Admin\delete_user.php?email='.$row['email'].'" title="Delete"><span style="color:red" class="glyphicon glyphicon-remove-sign"></span></a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a onclick="edit('.$row['userID'].');" title="Edit"><span s class="glyphicon glyphicon-pencil"></span></a>
								</td>';
                                echo "</tr>";
                            }
                            //                    ?>

                        </table>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Uploader</th>
<!--                                <th>ProUser</th>-->
                                <!--                        <th>Mã Nhạc</th>-->
                                <!--                        <th>Tác Vụ</th>-->
                            </tr>
                            </thead>
                            <!--                        <tbody>-->
                            <?php

                            $db_connect = db_connect();
                            $query = "SELECT songID,title,userID FROM song";
                            $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
                            while($row = mysql_fetch_assoc($result)){
                                echo "<tr id=".$row['songID'].">";
                                echo '<td>'.$row['songID'].'</td>';
                                echo '<td>'.$row['title'].'</td>';
                                echo '<td>'.$row['userID'].'</td>';
//                                if ($row['ispro']) echo '<td>'.'Yes'.'</td>';
//                                else echo'<td>'.'No'.'</td>';
//                        echo '<td>'.$row['type'].'</td>';
                                echo '<td>
								<a class="delete" href="\soundcloud\view\Admin\delete_song.php?id='.$row['songID'].'" title="Delete"><span style="color:red" class="glyphicon glyphicon-remove-sign"></span></a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a onclick="edit('.$row['userID'].');" title="Edit"><span s class="glyphicon glyphicon-pencil"></span></a>
								</td>';
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>
</html>