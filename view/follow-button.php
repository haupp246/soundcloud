<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
			 initiateFollow();
		});

		function initiateFollow() {  
			  $("a.unfollow").bind("mouseover",function(){
			   //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
			   $(this).children("span").text("UnFollow");
			  });

			  $("a.unfollow").bind("mouseout",function(){
			   //$(this).children("img").attr("src","/soundcloud/assets/img/following.png");
			   $(this).children("span").text("Following");
			  }); 
			  
			  $("a.unfollow").bind("click",function(){     
				//$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
			    $(this).children("a.unfollow span").text("Follow");
			    $(this).removeClass("unfollow");
			    $(this).addClass("follow");
			    $(this).unbind();
			    initiateFollow();
			  });
			  
			  $("a.follow").bind("click",function(){
			    //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
			    $(this).children("span").text("UnFollow");
			    $(this).removeClass("follow");
			    $(this).addClass("unfollow");
			    $(this).unbind();
			    initiateFollow();
			  });
		}
	</script>
	<style type="text/css" media="screen">
a.button {
    text-align: center;
    background-origin: padding-box;
    background-size: auto;
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-left-style: solid;
    border-left-width: 1px;
    border-right-style: solid;
    border-right-width: 1px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    border-top-style: solid;
    border-top-width: 1px;
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 20px;
    font-style: normal;
    font-variant: normal;
    font-weight: bold;
    line-height: 23px;
    outline-color: rgb(255, 255, 255);
    outline-style: none;
    outline-width: 0px;
    text-decoration: none;
    text-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 0px;
    vertical-align: middle;
    padding: 15px 30px 15px 30px;
    zoom: 1;
    width: 180px;
}

a.follow {
    background-image: linear-gradient(rgb(0, 150, 255), rgb(0, 93, 255));
    color: rgb(255, 255, 255);
    border-bottom-color: rgb(0, 113, 224);
    border-left-color: rgb(0, 113, 224);
    border-right-color: rgb(0, 113, 224);
    border-top-color: rgb(0, 113, 224);
}

a.follow:hover,a.follow:active {
    background: linear-gradient(#008aea, #024dcf);
    border-color: #0055a7;
}

a img {
    width: 14px;
    margin-right: 3px;
}

a.unfollow {
    color: #6e6e6e;
    background: #f3f3f3;
    background: -webkit-gradient(linear, 0% 40%, 0% 70%, from(#F5F5F5),
        to(#F1F1F1));
    background: -moz-linear-gradient(linear, 0% 40%, 0% 70%, from(#F5F5F5),
        to(#F1F1F1));
    border-bottom-color: #dcdcdc;
    border-left-color: #dcdcdc;
    border-right-color: #dcdcdc;
    border-top-color: #dcdcdc;
}

a.unfollow:hover,a.unfollow:active {
    background: linear-gradient(#eb3845, #d9030a);
    border-color: #e7473c;
    color: #fff;
}
</style>
</head>
<body>
<a href="#" class="button follow"><img width="10px" /> <span>Follow</span></a>
</body>

</html>