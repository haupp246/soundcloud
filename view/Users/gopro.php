<?php
session_start();
include_once("../../controller/db_connection.php");
include_once ("../layout/header.php");
echo "<br/><br/><br/><br/><br/>";
$db_connect = db_connect();
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user']))
{
$u = unserialize($_SESSION['user']);

$name = empty($u->name) ? $u->email : $u->name;
?>
<!DOCTYPE html>
<html>
<head>
    <title>HTTV music – Music makes me</title>
    <meta name="author" content="ThaiVH" />
    <meta name="description" content="soundcloud"/>
    <meta name="keyword" content="sound, cloud, music"/>
    <meta charset="utf-8"/>
    <link rel="icon"  href="/soundcloud/assets/ico/1.ico"/>
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/custom2.css">
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>

<body>


<?php


$query = "SELECT ispro FROM user WHERE userID = '$u->userID'";
$result = mysql_query($query,$db_connect)or die("Error in query $query");
//$num_row = mysql_num_rows($result);
$row = mysql_fetch_array($result);
if ($row['ispro']==0)
{
?>   
    
    <button class="btn" id="goPro" >Go pro</button>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Go Pro</h4>
                </div>
                <div class="modal-body">
                    <h1>Price 60$</h1>

                   


                </div>
                <div class="modal-footer">

                    <button  type="button" class="btn" id='go'  > Go pro </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>

        </div>
    </div>    

<?php
}
else echo "<h1>You have already a Pro!</h1>";

    echo "</br></br></br></br>";
    include_once ("../layout/footer.php");
} db_closeconnect($db_connect); ?>
<script>
     $(document).ready(function () {
        $('#goPro').on("click", function () {
            // body...
              $("#myModal").modal();
        });
        $('#go').on("click", function () {
            // body...
              $.ajax({
                  url: '/soundcloud/controller/check_gopro.php',
                  type: 'POST',
                  data: {id:<?php echo $u->userID ?> },
                  success: function(ok)
                  {
                      alert("Success");
                        $("#myModal").modal('toggle');
                         location.reload();
                  }
              });
              
              
        });
        })
</script>