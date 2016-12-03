<?php
$u 		= isset($_SESSION['user']) ? unserialize($_SESSION['user']) :'';
$link 	= isset($u->avatar) ? $u->avatar : '';
$linkav = '/soundcloud/assets/img/uploads/'.$link;
?>
<link rel="stylesheet" type="text/css" href="/soundcloud/lib/bootstrap/css/bootstrap.min.css"/>
<script src="/soundcloud/lib/jquery/jquery-3.1.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/soundcloud/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css" media="screen">
    body{
        background-color: #F2F2F2;
    }
    body>div:first-of-type{
        min-height: 300px;
    }
    .container{
        padding-top: 50px;
        background-color: white;
        padding: 50px;
        z-index: 1;
    }
    #navbar{
        position: fixed;
        background-color: red;
        width: 100%;
        height: 50px;
        background-color: #333333;
        border-radius: 0;
        box-shadow: 0px 0px 10px black;
        display:flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
    }
    .navbar>li:first-child{
        background-clip: border-box;
        background-color: rgb(255, 72, 0);
    }
    .navbar>li{
        display: inline-flex;
        float: left;
        height: 50px;
        margin-right: 20px;
        position: relative;
        top: -1px;
        /* border-right: 1px solid black; */
        padding-right: 15px;
    }
    .navbar a{
        display: flex;
        margin: auto;
        text-decoration: none;
        color: rgb(204, 204, 204);
    }
    .navbar form{
        position: relative;
        top: 10px;
    }
    input[name='search']{
        width: 600px;
        height: 30px;
        padding-left: 10px;
        border-radius: 3px;
    }
    input[name='searchSubmit']{
        width: 20px;
        height: 20px;
        position: absolute;
        right: 3px;
        top: 5px;
        background-color: white;
        background-image: url('/soundcloud/assets/img/Search.png');
        background-repeat: no-repeat;
    }
    #ava{
        /* position: absolute; */
        display: inline-flex;
        float: right;
        z-index: 2;
    }
    .col{
        display: inline-block;
    }
    .span1{
        width: 25%;
        float: left;
        min-height: 52px;
    }
    .span2{

        min-height: 52px;
    }
    input[type="button"]{
        color: black;
    }
    .container2{
        padding-top: 100px;
        width: 400px;
        height: 600px;
        margin: auto;
    }
    input[name="name"],input[name="pass"],input[name="email"],input[name="pass2"]{
        width: 400px;
        height: 40px;
        border-radius: 5px;
        padding-left: 10px;
        font-size: 1.1em;
    }
    h1{
        display: block;

        text-align: center;
    }
    div.ava{
        height: 30px;
        width: 30px;
        border-radius: 100px;
        background-color: red;
        background-image: url( <?php echo $linkav;?> );
        background-size: 100%;
        margin-right: 10px;
    }
    .dropdown:hover .dropdown-menu {
        display: block;
    }
    .dropdown-menu{
        z-index: 3;
        margin: 0px;
    }
    .navbar>li>a>img{
        padding-left: 15px;
        padding-right: 0px;
        margin-right: 0px;
    }
    .modal-header, h4, .close {
        background-color: #FF4800;
        color:white !important;
        text-align: center;
        font-size: 30px;
    }
    .modal-footer {
        background-color: #f9f9f9;
    }
    .modal-content{
        top: 80px;
    }
    #result {
        display: none;
    }
    .input_container ul {
        width: 206px;
        border: 1px solid #eaeaea;
        position: absolute;
        z-index: 9;
        background: #f3f3f3;
        list-style: none;
    }
    .input_container ul li {
        padding: 2px;
    }
    .input_container ul li:hover {
        background: #eaeaea;
    }
    #noti{
        left: -100px;
        font-size: 0.8em;
        display: none;
    }
    #bellpar:hover #noti{
        display: block;
    }
    .newNoti{
        background-color: rgb(255, 72, 0);
    }
</style>
<ul id="navbar" class="navbar">
    <li><a href="/soundcloud/" title=""><img src="/soundcloud/assets/img/logo.png" height="50px" alt="" ></a></li>
    <li><a href="/soundcloud/" title="">Home</a></li>
    <li><a href="" title="">Overview</a></li>
    <li><a href="/soundcloud/view/chart.php" title="">Chart</a></li>
    <li><div>
            <form action="/soundcloud/view/search.php" method="GET" accept-charset="utf-8">
                <input id="search-box" type="text" name="search" placeholder="Search" onkeypress="autocomplet() " autocomplete="off">
                <div class="input_container">
                    <ul id="result"></ul>
                </div>
                <input type="submit" class="btn" name="searchSubmit" value="">
            </form>
        </div></li>
	<?php if(!isset($_SESSION['user'])) { ?>
        <li><a href="/soundcloud/view/signup.php"><input type="button" class="btn btnn" value="Join us now !"></a></li>
        <li><a href="/soundcloud/view/login.php"><input type="button" class="btn btnn" value="Sign In"></a></li>
	<?php } else { ?>
        <li><a href="/soundcloud/view/Users/upload.php" title="">Upload</a></li>
        <li class="dropdown"><a href="/soundcloud/view/Users/index.php" title="">
                <div class="ava"></div>
                <a href="/soundcloud/view/Users/index.php" title=""><?php echo $u->name ?></a>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/soundcloud/view/Users/profile.php" title="">Profile</a></li>
                <li><a href="/soundcloud/view/Users/users_list.php" title="">List User</a></li>
                <li><a href="/soundcloud/view/Users/suggest.php" title="">Suggest</a></li>
                <li><a href="/soundcloud/view/Users/gopro.php" title="">Go Pro</a></li>
                <li><a href="/soundcloud/view/Users/myplaylist.php" title="">My Playlists</a></li>
                <li><a href="/soundcloud/view/Users/delete.php" title="">Delete Account</a></li>
                <li><a href="/soundcloud/controller/logout.php" title="">Log Out</a></li>
            </ul>
        </li>
        <li id="bellpar"><img onmouseout="shownoti();" id="bell" style="margin: auto; margin-left: 15px;" src="/soundcloud/assets/img/bell.png" height="33px" alt="">
            <ul class="dropdown-menu" id="noti"></ul>
        </li>
	<?php } ?>
</ul>
<script>
    function autocomplet() {
        var min_length = 0; // min caracters to display the autocomplete
        var keyword = $('#search-box').val();
        if (keyword.length >= min_length) {
            $.ajax({
                url: '/soundcloud/controller/test_search.php',
                type: 'POST',
                data: {keyword:keyword},
                success:function(data){
                    $('#result').show();
                    $('#result').html(data);
                }
            });
        } else {
            $('#result').hide();
        }
        $(document).click(function(e)
        {
            var $box = $('#result');
            if (e.target.id !== 'search-box' && e.target.id !== 'result' && !$.contains($box[0], e.target))
                $("#result").hide();
        });

        $("#search-box").focusin(function(){
            $('#result').show();
        });
    }

    // set_item : this function will be executed when we select an item
    function set_item(item) {
        // change input value
        $('#result').val(item);
        // hide proposition list
        $('#result').hide();
    }
//     shownoti
    $.ajax({
        url: '/soundcloud/controller/noti.php',
        type: 'POST',
        data: {id: <?php echo $u->userID; ?>, count: 'none'},
        success:function(data){
            $('#noti').html(data);
            //sort ul li by ID
            var elems = $('#noti').children('li').remove();
            elems.sort(function(b,a){
                return parseInt(a.id) > parseInt(b.id);
            });
            $('#noti').append(elems);
            //

            if ($('#checkNew').val() == '1')
            {
                $('#bellpar').addClass('newNoti');
            }
            $('#bellpar').mouseout(function ()
            {
                $('#bellpar').removeClass('newNoti');
            })
        }
    });
        setInterval(function ()
        {
            var count = $("#noti li").length;
            $.ajax({
                url: '/soundcloud/controller/noti.php',
                type: 'POST',
                data: {id: <?php echo $u->userID; ?>, count: count},
                success:function(data){
                    $('#noti').html(data);
                    //sort ul li by ID
                    var elems = $('#noti').children('li').remove();
                    elems.sort(function(b,a){
                        return parseInt(a.id) > parseInt(b.id);
                    });
                    $('#noti').append(elems);
                    //

                    if ($('#checkNew').val() == '1')
                    {
                        $('#bellpar').addClass('newNoti');
                    }
                    $('#bellpar').mouseout(function ()
                    {
                        $('#bellpar').removeClass('newNoti');
                    })
                }
            });
        },2000);
</script>

