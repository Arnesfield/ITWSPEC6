<div class="container">

  <h1><?=$title?></h1>

  <form action="<?=base_url('activity/create')?>" method="post">

    <!-- name -->
    <div class="relative">
      <i class="material-icons mdl-color-text--indigo-500 icon-input">label</i>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
        <input class="mdl-textfield__input js-val-input" type="text" name="name" id="name"
          maxlength="128" value="<?=set_value('name')?>"/>
        <label for="name" class="mdl-textfield__label">Activity Name</label>
      </div>
    </div>

    <!-- date -->
    <div class="relative">
      <i class="material-icons mdl-color-text--indigo-500 icon-input">date_range</i>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
        <input class="mdl-textfield__input js-val-input" type="date" name="date" id="date"
          value="<?=set_value('date')?>"/>
        <!-- <label for="date" class="mdl-textfield__label">Activity Date</label> -->
      </div>
    </div>

    <!-- time -->
    <div class="relative">
      <i class="material-icons mdl-color-text--indigo-500 icon-input">alarm</i>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
        <input class="mdl-textfield__input js-val-input" type="time" name="time" id="time"
          value="<?=set_value('time')?>"/>
        <!-- <label for="price" class="mdl-textfield__label">Item Price</label> -->
        <!-- <span class="mdl-textfield__error">Number required!</span> -->
      </div>
    </div>

    <div class="mdl-card__actions mdl-card--border my-p-2 my-mt-2">
      <div>
        
        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
          <i class="material-icons">send</i> Add
        </button>

        <!-- <a id="reset" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
          <i class="material-icons">clear</i> Reset
        </a> -->

        <a href="<?=base_url('activity')?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
          <i class="material-icons">view_list</i> View Activities
        </a>

      </div>
    </div>

  </form>

  <!-- form errors -->
  <div class="my-pt-5 my-pb-3" style="color: #f44336">
    <?php echo validation_errors(); ?>
  </div>

</div>

<!-- <script>
$('#reset').click(function() {
  $('.js-val-input').val('')
  $('.js-val-input').parent().removeClass('is-upgraded is-dirty is-invalid')
})
</script> -->