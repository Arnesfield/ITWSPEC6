<div class="container">

<h1>Forgot password</h1>

<form class="form" action="<?=base_url('login/forgot')?>" method="post">

  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="email" name="email" id="email"
        maxlength="128"/>
      <label for="email" class="mdl-textfield__label">Enter Email</label>
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