<div class="container">

<h1>Reset password</h1>

<form class="form" action="<?=base_url('email/reset/' . $code)?>" method="post">

  <input type="hidden" name="id" value="<?=$id?>">

  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="password" name="password" id="password"
        maxlength="128"/>
      <label for="password" class="mdl-textfield__label">Password</label>
    </div>
  </div>

  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="password" name="confirm_password" id="confirm_password"
        maxlength="128"/>
      <label for="confirm_password" class="mdl-textfield__label">Confirm Password</label>
    </div>
  </div>

  <div>
    <button type="submit"
      class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
      Reset
    </button>

    <a href="<?=base_url()?>"
      class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
      Cancel
    </a>
  </div>

</form>

<div class="my-pt-5 my-pb-3" style="color: #f44336">
  <?php echo validation_errors(); ?>
</div>

</div>