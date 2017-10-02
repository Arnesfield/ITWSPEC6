<div class="container">

<h1>Signup</h1>

<form action="<?=$action?>" method="post">

  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="text" name="firstname" id="firstname"
        maxlength="128" value="<?=set_value('firstname')?>"/>
      <label for="firstname" class="mdl-textfield__label">First Name</label>
    </div>
  </div>

  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="text" name="lastname" id="lastname"
        maxlength="128" value="<?=set_value('lastname')?>"/>
      <label for="lastname" class="mdl-textfield__label">Last Name</label>
    </div>
  </div>

  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="text" name="username" id="username"
        maxlength="128" value="<?=set_value('username')?>"/>
      <label for="username" class="mdl-textfield__label">Username</label>
    </div>
  </div>
  
  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="email" name="email" id="email"
        maxlength="128" value="<?=set_value('email')?>"/>
      <label for="email" class="mdl-textfield__label">Email</label>
    </div>
  </div>

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
    <select name="account_access" id="account_access">
      <option value="1" <?=set_value('account_access') == 1 ? 'selected' : ''?>>Admin</option>
      <option value="2" <?=set_value('account_access') == 2 ? 'selected' : ''?>>User</option>
    </select>
  </div>

  <div class="my-pt-4">
    <button type="submit"
      class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
      Sign Up
    </button>

    <a href="<?=base_url()?>"
      class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
      Back
    </a>
  </div>

</form>

<div class="my-pt-5 my-pb-3" style="color: #f44336">
  <?php echo validation_errors(); ?>
</div>

</div>

