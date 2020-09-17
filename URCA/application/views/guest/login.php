<!DOCTYPE html>
<html lang="en">
<head>
	<title>AERS Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/vendor/bootstrap/css/bootstrap.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/fonts/font-awesome-4.7.0/css/font-awesome.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/fonts/Linearicons-Free-v1.0.0/icon-font.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/vendor/animate/animate.css');?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/vendor/css-hamburgers/hamburgers.min.css');?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/vendor/animsition/css/animsition.min.css');?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/vendor/select2/select2.min.css');?>">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/vendor/daterangepicker/daterangepicker.css');?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/css/util.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('guestdesign/css/main.css');?>">
<!--===============================================================================================-->
</head>
<?php
if (isset($this->session->userdata['logged_in'])) {
    redirect(base_url() . 'dashboard');
}
?>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
			<?php echo form_open('dashboard'); ?>
				<form class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-51">
						Login
					</span>
					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="text" name="username" id="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="password" name="password" id= "password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn " type="submit" value="Login" class="btn float-right login_btn">
						Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url('guestdesign/vendor/jquery/jquery-3.2.1.min.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('guestdesign/vendor/animsition/js/animsition.min.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('guestdesign/vendor/bootstrap/js/popper.js');?>"></script>
	<script src="<?php echo base_url('guestdesign/vendor/bootstrap/js/bootstrap.min.js');?>"></script>	
<!--===============================================================================================-->
	<script src="<?php echo base_url('guestdesign/vendor/select2/select2.min.js');?>"></script>	
<!--===============================================================================================-->
	<script src="<?php echo base_url('guestdesign/vendor/daterangepicker/moment.min.js');?>"></script>	
	<script src="<?php echo base_url('guestdesign/vendor/daterangepicker/daterangepicker.js');?>"></script>	
<!--===============================================================================================-->
	<script src="<?php echo base_url('guestdesign/vendor/countdowntime/countdowntime.js');?>"></script>	
<!--===============================================================================================-->
	<script src="<?php echo base_url('guestdesign/js/main.js');?>"></script>	
</body>
</html>