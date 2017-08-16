<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="vendor/material/css/material.indigo-pink.min.css" />
<link rel="stylesheet" href="vendor/material/icons/material-icons.css" />
<link rel="stylesheet" href="vendor/material/fonts/Roboto/roboto.css" />

<link rel="stylesheet" href="vendor/my.css" />
<link rel="stylesheet" href="assets/css/style.css" />

<title>Pre Assessment</title>

</head>
<body>
  
<?php

// proj props
$no_of_fields = 2;
$arr_op = array('add', 'subtract', 'multiply', 'divide');

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $valid = true;

  // test
  /* echo '<pre>';
  print_r($_POST);
  echo '</pre>'; */

  // to var
  foreach ($_POST as $key => $val) {
    $$key = $val;
  }

  // filter here
  if (isset($num)) {
    foreach ($num as $key => $val) {
      $num[$key] = strip_tags(trim($val));
      $valid = $valid && is_numeric($val);
    }
  }

  // check if operation is correct
  $valid = $valid && isset($operation) && in_array($operation, $arr_op);
  
  if ($valid) {
    switch ($operation) {
      // addition
      case $arr_op[0]:
        $res = 0;
        foreach ($num as $val) {
          $res += $val;
        }
        break;

      // subtraction
      case $arr_op[1]:
        foreach ($num as $key => $val) {
          $res = $key === 0 ? $num[0] : $res - $val;
        }
        break;

      // multiplication
      case $arr_op[2]:
        $res = 1;
        foreach ($num as $val) {
          $res *= $val;
        }
        break;

      // division
      case $arr_op[3]:
        foreach ($num as $key => $val) {
          if ($key === 0) {
            $res = $num[0];
          }
          else if ($val == 0) {
            $res = 'Invalid. Cannot be divided by 0.';
            break;
          }
          else {
            $res /= $val;
          }
        }
        break;
    }
  }
  
}
else {
  $valid = false;
}

?>

<!-- form -->
<div class="container-fluid">

<div class="row h-100">
  <div class="hidden-sm hidden-xs col-md-3 mdl-color--indigo-500 h-100"></div>

  <div class="col-md-9 h-100 quite-white my-pb-2 my-pt-4">

    <div class="my-pb-5 my-pt-5 my-pl-5">
      <h2><i class="material-icons">assessment</i> Calculator</h2>
    </div>

    <form method="post" action="./" class="row">

      <div class="hidden-xs col-sm-1"></div>

      <div class="col-sm-5">

        <h5 class="my-mt-1">Enter numbers</h5>
        <hr/>

        <?php for ($i = 0; $i < $no_of_fields; $i++): ?>

        <div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label field-cont">
            <input type="text" name="num[]" id="<?='num'.($i+1)?>"
              value="<?=isset($num[$i]) ? $num[$i] : ''?>"
              class="field mdl-textfield__input" pattern="-?[0-9]*(\.[0-9]+)?" />
            <label class="mdl-textfield__label" for="<?='num'.($i+1)?>">Number <?=$i+1?></label>
            <span class="mdl-textfield__error">Number required!</span>
          </div>
        </div>
        
        <?php endfor; ?>
      </div>

      <div class="col-sm-5 my-pb-1">

        <div>

          <h5 class="my-mt-1">Choose Operation</h5>
          <hr/>

          <?php foreach ($arr_op as $val): ?>
          
          <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="<?=$val?>">
            <input type="radio" name="operation" value="<?=$val?>" id="<?=$val?>"
              class="op mdl-radio__button"
              <?php
                if (isset($operation))
                  echo $operation === $val ? 'checked' : '';
              ?>
            />
            <span class="mdl-radio__label"><?=ucfirst($val)?></span>
          </label> <br/>

          <?php endforeach; ?>
        </div>

        <div class="my-mt-3 my-mb-3">
          <button type="submit" name="submit"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
            <i class="material-icons">done</i>&nbsp; Calculate
          </button>
          
          <button type="button" id="clear"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
            <i class="material-icons">clear</i>&nbsp; Clear
          </button>
          
        </div>


        <!-- output -->
        <?php if ($valid): ?>

        <div id="output" class="my-pt-1">

          <h5 class="my-mt-1">Result</h5>
          <hr/>

          <h6><?=$res?></h6>
        </div>

        <?php 
        // if posted and not valid
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])):
        ?>

        <div id="output" class="my-pt-1">

          <h5 class="my-mt-1">Result</h5>
          <hr/>

          <h6>Invalid. Kindly review your inputs.</h6>
        </div>

        <?php endif; ?>

        <p class="my-ls-1 my-pt-3"><small>&copy; 2017 jefferson rylee</small></p>

      <!-- end of col -->
      </div>

    </form>


    

  <!-- end of col -->
  </div>

<!-- end of row -->
</div>

<!-- end of container -->
</div>

<!-- scripts -->
<script src="vendor/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/material/js/material.min.js"></script>
<script>

$('#clear').click(function() {
  $('.field').val('')
  $('.op').prop('checked', false)
  $('#output').remove()

  // for mdl
  $('.field').parent().removeClass('is-dirty')
  $('.op').parent().removeClass('is-checked')
})

</script>

</body>
</html>