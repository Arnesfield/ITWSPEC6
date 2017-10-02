<div class="container">

  <h1><?=$title?></h1>

  <form action="<?=base_url('item/update/' . $item->item_slug)?>" method="post">

    <!-- name -->
    <div class="relative">
      <i class="material-icons mdl-color-text--indigo-500 icon-input">label</i>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
        <input class="mdl-textfield__input js-val-input" type="text" name="name" id="name"
          maxlength="128" value="<?=$item->item_name?>"/>
        <label for="name" class="mdl-textfield__label">Item Name</label>
      </div>
    </div>

    <!-- desc -->
    <div class="relative">
      <i class="material-icons mdl-color-text--indigo-500 icon-textarea">info</i>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-textarea">
        <textarea class="mdl-textfield__input js-val-input" type="text" name="desc" id="desc"
          maxlength="128" cols="30" rows="5"><?=$item->item_desc?></textarea>
        <label for="desc" class="mdl-textfield__label">Item Description</label>
      </div>
    </div>

    <!-- price -->
    <div class="relative">
      <i class="material-icons mdl-color-text--indigo-500 icon-input">monetization_on</i>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
        <input class="mdl-textfield__input js-val-input" type="text" name="price" id="price"
          maxlength="128" pattern = "[0-9]*(\.[0-9]+)?" value="<?=$item->item_price?>"/>
        <label for="price" class="mdl-textfield__label">Item Price</label>
        <span class="mdl-textfield__error">Number required!</span>
      </div>
    </div>

    <div class="mdl-card__actions mdl-card--border my-p-2 my-mt-2">
      <div>
        
        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
          <i class="material-icons">send</i> Update
        </button>

        <a id="reset" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
          <i class="material-icons">clear</i> Reset
        </a>

        <a href="<?=base_url()?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
          <i class="material-icons">view_list</i> View Items
        </a>

      </div>
    </div>

  </form>

</div>

<script>
$('#reset').click(function() {
  $('.js-val-input').val('')
  $('#name').val('<?=$item->item_name?>')
  $('#desc').val('<?=$item->item_desc?>')
  $('#price').val('<?=$item->item_price?>')
  $('.js-val-input').parent().addClass('is-upgraded is-dirty')
})
</script>