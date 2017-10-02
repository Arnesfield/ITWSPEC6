
<div class="container">


<div class="row">
    <?php $this->load->view('includes/menu'); ?>
    <div class="col-md-4">
        <br><br><br><br>
    <h1>LOGIN </h1>
    <?php if(validation_errors()){ ?>
        <div class="alert alert-danger"> <?= validation_errors() ?> </div>
    <?php } ?>
    
    <form method="post" action="<?= base_url().'user/do_login' ?>">
        <div class="form-group">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <br>
        <center><button type="submit" class="btn btn-warning">SUBMIT</button>
        <a href="<?= base_url().'user/register'?>" class="btn btn-info">REGISTER</a>
        <a href="<?= base_url().'user/forgot'?>" class="btn btn-info">Forgot Password?</a>
    </form>
    <br><br>
    <!-- <a href="" class="btn btn-info" data-toggle="modal" data-target="#myModal">REGISTER </a> -->
    </div>




    <div class="col-md-4"></div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REGISTRATION FORM</h4>
      </div>


      <div class="modal-body">
      <form>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Password">
        </div>
        
        <button type="submit" class="btn btn-warning">SUBMIT</button>
        </form>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>