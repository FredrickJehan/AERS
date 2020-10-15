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
            <div class="form-group col-md-12">
                <label>Department</label>
                <select class="form-control" name="department">
                    <option>Select</option>
                    <option value="Accountancy">Accountancy</option>
                    <option value="Allied Business Courses">Allied Business Courses</option>
                    <option value="Business Management">Business Management</option>
                    <option value="Financial Management">Financial Management</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Digital Arts and Computer Animation">Digital Arts and Computer Animation</option>
                    <option value="Elementary Education">Elementary Education</option>
                    <option value="Secondary Education">Secondary Education</option>
                    <option value="Library Information Science">Library Information Science</option>
                    <option value="Physical Education">Physical Education</option>
                    <option value="Media Studies">Media Studies</option>
                    <option value="Social Sciences">Social Sciences</option>
                    <option value="Literature and Language Studies">Literature and Language Studies</option>
                    <option value="Philosopy">Philosopy</option>
                    <option value="Psychology">Psychology</option>
                    <option value="Nursing">Nursing</option>
                    <option value="Electronics and Computer Engineering">Electronics and Computer Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                    <option value="Natural Sciences">Natural Sciences</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Graduate School">Graduate School</option>
                </select>
                <span class="text-danger"><?php echo form_error("department");?></span>
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
    