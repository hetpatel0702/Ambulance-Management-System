<html>
  <head>
    <script language="javascript" type="text/javascript" src="jquery.js"></script>
  </head>
  <body>

  <h3>Output: </h3>
  <div id="output">this element will be accessed by jquery and this text replaced</div>

  <script id="source" language="javascript" type="text/javascript">

  $(function (){
    var response = '';
    $.ajax({
        type: "GET",
        url:'RetrivingDrivers.php',
        data:"",
        dataType:'html',
        async:false,
        success: function(data){
            $('#output').html(data);
        }
    })
    alert(response);
  });

  </script>
  </body>
  </html>