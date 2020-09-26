<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Registration</h1>
</div>

<div class="card shadow mb-4">
<div class="card-body">

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
                <option value="Researcher">Researcher</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
    </div>
    <div id="Researcher" stlye="display:none">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Department</label>
                <select class="form-control" name="department">
                    <option>Select</option>
                    <option value="Department of Media Studies">Department of Media Studies</option>
                    <option value="Department of Social Studies">Department of Social Studies</option>
                    <option value="Department of Literature and Language Studies">Department of Literature and Language Studies</option>
                    <option value="Department of Philosophy">Department of Philosophy</option>
                    <option value="Department of Psychology">Department of Psychology</option>
                    <option value="Department of Computer Science">Department of Computer Science</option>
                    <option value="Department of Digital Arts and Computer Animation">Department of Digital Arts and Computer Animation</option>
                </select>
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

</div>
</div>

<script>
     function userForm(userType){
       if(userType.value == "Researcher"){
            document.getElementById('Researcher').style.display = "block";
       } else if(userType.value == "Admin"){
            document.getElementById('Researcher').style.display = "none";
            document.getElementById('departmentid').value = "";
            document.getElementById('contactid').value = "";
       }
     }
</script>
    