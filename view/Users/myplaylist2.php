<?php
echo "<br/><br/><br/><br/><br/>";
//if (!isset($_SESSION['user'])) {

//}
//if(isset($_SESSION['user']))
//{
 ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>HTTV music – Music makes me</title>
        <meta name="author" content="ThaiVH" />
        <meta name="description" content="soundcloud"/>
        <meta name="keyword" content="sound, cloud, music"/>
        <meta charset="utf-8"/>
        <link rel="icon"  href="/soundcloud/assets/ico/1.png"/>
        <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/custom2.css">
        <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
        <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
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
                $('#'+id).load('edit.php?id='+id,null);

            }

            function Update(id){
                $('#result').html('<img src="loading.gif"/>');
                setTimeout(function(){
                    $('#result').load('update.php?id='+id,$('#form'+id).serializeArray())
                }, 1000);
            }
        </script>
    </head>

    <body>
    <?php
    $db_connect = db_connect();
    $id = $_GET['id'];
    $query = "SELECT * FROM playlist WHERE userID = '$id'";
    $result = mysql_query($query,$db_connect)or die("Error in query $query");
    $num_row = mysql_num_rows($result);
    if ($num_row == 0) echo "This user don't have any playlist :(";
    else{
        ?>
        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-9">
                    <div id="main">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Playlist Name</th>
                                <!--                        <th>Number of Songs</th>-->
                                <th>Views</th>
                                <th>Likes</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $db_connect = db_connect();
                            $query = "SELECT * FROM playlist WHERE userID = '$id'";
                            $result = mysql_query($query,$db_connect)or die("Error in query $query");
                            $num_row = mysql_num_rows($result);
                            if ($num_row == 0) echo "You don't have any playlist :(";
                            else while($row = mysql_fetch_array($result)){
//                        $query2 = "SELECT COUNT(songID) AS total FROM songinplaylist WHERE playlistID = '$row[playlistID]' ";
//                        $result2 = mysql_query($query,$db_connect)or die("Error in query $query");
//                        $row2 = mysql_fetch_assoc($result2);
                                echo "<tr id=".$row['playlistID'].">";
                                echo '<td>'.$row['playlistID'].'</td>';
                                echo '<td>'.$row['name'].'</td>';
//                        echo '<td>'.$row2['total'].'</td>';
                                echo '<td>'.$row['viewCount'].'</td>';
                                echo '<td>'.$row['likeCount'].'</td>';
                                echo '<td><a  href="../playlist.php?id='.$row['playlistID'].'" title="Show song lists"><span class="glyphicon glyphicon-list"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								</td>';
                                echo "</tr>";

                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>

<!--    <form align="center"  method="post" action="/soundcloud/view/Users/songlist.php">-->
<!--        <input type="text" required name="pname" placeholder="Playlist Name">-->
<!--        <input type="submit" name="add" value="Create Playlist"  >-->
<!--    </form>-->
    </body>
    </html>
    <?php
    echo "</br></br></br></br>";
//    include_once ("../layout/footer.php");
 db_closeconnect($db_connect); ?>