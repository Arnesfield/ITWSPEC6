<h1>Reset Password</h1>

<?php if(validation_errors()): ?>
    <div class="alert alert-danger"> <?= validation_errors() ?> </div>
<?php endif; ?>

<form action="<?=base_url('user/reset_password')?>" method="post">

  <input type="hidden" name="user_id" value="<?=$user_id?>">

  <div>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
  </div>

  <div>
    <label for="repassword">Confirm Password</label>
    <input type="password" name="repassword" id="repassword" required>
  </div>

  <div>
    <button type="submit">Reset</button>
    <a href="<?=base_url('user')?>">Cancel</a>
  </div>

</form>