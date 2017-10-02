
<div class="row">
    <?php $this->load->view('includes/menu'); ?>
    <div class="col-md-4"> 
    <h1>REGISTRATION FORM</h1>

    <?php if(validation_errors()){ ?>
        <div class="alert alert-danger"> <?= validation_errors() ?> </div>
    <?php } ?>

    <form method="post" action="<?= base_url().'user/do_register'?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="repassword" class="form-control" placeholder="Password">
        </div>
         <div class="form-group">
          <label>Type of Account</label>
         <select name="type_account">        
                <option value = "1">User</option>
                <option value = "2">Admin</option>
         </select>
           
        </div>
        
        <button type="submit" class="btn btn-warning">SUBMIT</button>
    </form>
    
    
    </div>
    


    <div class="col-md-4"> </div>
</div>