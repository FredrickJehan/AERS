<?php
if (isset($this->session->userdata['logged_in'])) {
    redirect(base_url() . 'dashboard');
}
?>
<?php
    if (isset($logout_message)) {
        echo "<div class='message'>";
        echo $logout_message;
        echo "</div>"; }
?>
<?php
    if (isset($message_display)) {
        echo "<div class='message'>";
        echo $message_display;
        echo "</div>"; }
?>
<?php
    echo "<div class='error_msg'>";
    if (isset($error_message)) {
        echo $error_message;
}
    echo validation_errors();
    echo "</div>";
?>
</head>

<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
            <?php echo form_open('dashboard'); ?>
				<form>
					<div class="input-group form-group">
						<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id= "username" name ="username" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="password" id="password" placeholder="password">
					</div>
					<div class="form-group">
						<center><input type="submit" value="Login" class="btn float-right login_btn"> </center>
					</div>
				</form>
			</div>
			<div class="card-footer">
            <a href=>To SignUp Click Here</a>
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="<?php echo base_url('registration') ?>">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
