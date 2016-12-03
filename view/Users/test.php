<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style >
 {
  margin: 0;
  padding: 0;
}
body {
  padding: 10px;
  background: #eaeaea;
  text-align: center;
  font-family: arial;
  font-size: 12px;
  color: #333333;
}
.container {
  width: 1000px;
  height: auto;
  background: #ffffff;
  border: 1px solid #cccccc;
  border-radius: 10px;
  margin: auto;
  text-align: left;
}
.header {
  padding: 10px;
}
.main_title {
  background: #cccccc;
  color: #ffffff;
  padding: 10px;
  font-size: 20px;
  line-height: 20px;
}
.content {
  padding: 10px;
  min-height: 100px;
}
.footer {
  padding: 10px;
  text-align: right;
}
.footer a {
  color: #999999;
  text-decoration: none;
}
.footer a:hover {
  text-decoration: underline;
}
.label_div {
  width: 120px;
  float: left;
  line-height: 28px;
}
.input_container {
  height: 30px;
  float: left;
}
.input_container input {
  height: 20px;
  width: 200px;
  padding: 3px;
  border: 1px solid #cccccc;
  border-radius: 0;
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
#result {
  display: none;
}
  </style>
</head>
<body>
    <div class="input_container">
                    <input type="text" id="search" onkeyup="autocomplet()">
                    <ul id="result"></ul>
    </div>


</body>
</html>
<script>
function autocomplet() {
  var min_length = 0; // min caracters to display the autocomplete
  var keyword = $('#search').val();
  if (keyword.length >= min_length) {
    $.ajax({
      url: 'soundcloud/controller/test_search.php',
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
}
 
// set_item : this function will be executed when we select an item
function set_item(item) {
  // change input value
  $('#result').val(item);
  // hide proposition list
  $('#result').hide();
}
</script>