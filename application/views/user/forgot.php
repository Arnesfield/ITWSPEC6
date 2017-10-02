<h1>Forgot Password</h1>

<?php if(validation_errors()): ?>
    <div class="alert alert-danger"> <?= validation_errors() ?> </div>
<?php endif; ?>

<form action="<?=base_url('user/forgot')?>" method="post">

  <div>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
  </div>

  <div>
    <button type="submit">Reset</button>
    <a href="<?=base_url('user')?>"></a>
  </div>

</form>