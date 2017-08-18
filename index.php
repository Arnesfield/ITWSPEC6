<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>JavaScript Review</title>

<!-- scripts -->
<script src="vendor/jquery.min.js"></script>

</head>
<body>
  
<input type="text" id="text" name="text"/>
<div id="content"></div>

<script>

$('#text').keyup(function() {
  $.ajax({
    'method': 'POST',
    'url': 'ajax.php',
    'dataType': 'JSON',
    'data': {
      'text': $('#text').val()
    },
    'success': function(res) {

      var keys = Object.keys(res.val)
      var values = Object.values(res.val)
      var str = ''

      for (var i = 0; i < keys.length; i++) {
        str += keys[i] + ' - ' + values[i] + '<br/>'
      }

      $('#content').html(str)
      // Object.keys(res.val)
      
    }
  })

})

</script>

</body>
</html>