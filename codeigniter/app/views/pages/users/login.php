<div class="container">

<h1>Login</h1>

<form class="form" action="<?=$action?>" method="post">

  <div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-input">
      <input class="mdl-textfield__input js-val-input" type="text" name="username" id="username"
        maxlength="128"/>
      <label for="username" class="mdl-textfield__label">Username</label>
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
    <button type="submit"
      class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
      Login
    </button>

    <a href="<?=base_url('login/signup')?>"
      class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
      Register
    </a>
  </div>

</form>

</div>

