<head>
  <title>AERS</title>
  <link href="URCstyles/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?php echo base_url('URCstyles/css/sb-admin-2.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('URCstyles/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
</head>

<div id="signup">
<form method="post" action="<?php echo base_url()?>welcome/user_registration">
    <div class="form-row">
        <div class="form-group col-md-12">    
            <label>Username</label>
            <input type="text" name="username" class="form-control">
            <span class="text-danger"><?php echo form_error("username");?></span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-5">
            <label>First Name*</label>
            <input type="text" name="first_name" class="form-control">
            <span class="text-danger"><?php echo form_error("first_name");?></span>
        </div>
        <div class="form-group col-md-2">
        <label>Middle Initial/s*</label>
            <input type="text" name="middle_name" class="form-control">
            <span class="text-danger"><?php echo form_error("middle_name");?></span>
        </div>
        <div class="form-group col-md-5">
        <label>Last Name*</label>
            <input type="text" name="last_name" class="form-control">
            <span class="text-danger"><?php echo form_error("last_name");?></span>
        </div>
    </div>    
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Email*</label>
            <input type="email" name="email" class="form-control">
            <span class="text-danger"><?php echo form_error("email");?></span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Password*</label>
            <input type="password" name="password" class="form-control">
            <span class="text-danger"><?php echo form_error("password");?></span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Type of User</label>
            <select id="usertype" name="user_type" onchange="userForm(this)" class="form-control">
                <option value="0">Researcher</option>
                <option value="1">Admin</option>
            </select>
        </div>
    </div>
    <div id="Researcher" stlye="display:none">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Department</label>
                <input id="departmentid" type="text" name="department" class="form-control">
                <span class="text-danger"><?php echo form_error("department");?></span>
            </div>
            <div class="form-group col-md-6">
                <label>Contact Number</label>
                <input id="contactid" type="number" name="contact_number" class="form-control">
                <span class="text-danger"><?php echo form_error("contact_number");?></span>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group" style="text-align:center;">
            <input type="submit" value="Submit" class="btn btn-primary"></input>
        </div>
    </div>
</form>
</div>
<!-- ./Signup form -->

<a href="<?php echo base_url('login') ?> ">For Login Click Here</a>

<script>
     function userForm(userType){
       if(userType.value == "0"){
            document.getElementById('Researcher').style.display = "block";
       } else if(userType.value == "1"){
            document.getElementById('Researcher').style.display = "none";
            document.getElementById('departmentid').value = "";
            document.getElementById('contactid').value = "";
       }
     }
</script>
    