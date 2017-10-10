
<div class="container-fluid h-100">

<div class="row h-100">
  <div class="my-center my-middle col-md-6 h-100 mdl-color--indigo-500 mdl-color-text--white">
    <div>
      <h3>my awesome form</h3>
    </div>
  </div>

  <div class="col-md-6 quite-white h-100 form-wrapper">

    <div class="my-center my-middle h-100">
      <form class="" action="<?=base_url('form')?>" method="post">
<!-- 
        <?php if(validation_errors()): ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
        <?php endif; ?> -->

        <div class="form-group <?=!empty(form_error('username')) ? 'has-error' : '' ?>">
          <label class="control-label" for="username">Username</label>
          <input class="form-control"
            type="text" name="username" id="username" value="<?=set_value('username')?>" size="50" />
          <?=form_error('username')?>
        </div>

        <div class="form-group <?=!empty(form_error('password')) ? 'has-error' : '' ?>">
          <label class="control-label" for="password">Password</label>
          <input class="form-control"
            type="password" name="password" id="password" value="" size="50" />
          <?=form_error('password')?>
        </div>

        <div class="form-group <?=!empty(form_error('passconf')) ? 'has-error' : '' ?>">
          <label class="control-label" for="passconf">Password Confirm</label>
          <input class="form-control"
            type="password" name="passconf" id="passconf" value="" size="50" />
          <?=form_error('passconf')?>
        </div>

        <div class="form-group <?=!empty(form_error('email')) ? 'has-error' : '' ?>">
          <label class="control-label" for="email">Email Address</label>
          <input class="form-control"
            type="text" name="email" id="email" value="<?=set_value('email')?>" size="50" />
            <?=form_error('email')?>
        </div>

        <div class="form-group">
          <input class="btn btn-primary"
            type="submit" value="Submit" />
        </div>

      </form>
    </div>

  </div>

</div>

</div>

