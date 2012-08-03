<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/home_nav'); ?>
	
	<div id="main" class="wrapper">
	<?php echo validation_errors('<p class="error">'); ?>	
<article>

	<div id ="signup_form">	
	
	<h1>Free Sign Up</h1>
	
<fieldset>
<legend>Personal Information</legend>
<?php echo form_open('login/create_member'); ?>
<legend>First Name</legend>
<?php echo form_input('first_name', set_value('first_name', 'First Name')); ?>
<legend>Last Name</legend>
<?php echo form_input('last_name', set_value('last_name', 'Last Name')); ?>
<legend>Phone  Number</legend>
<?php echo form_input('phone_number', set_value('phone_number', 'Phone Number')); ?>
</fieldset>

<fieldset>
<legend>Login Info</legend>

<legend>Note: Your Username will be the same as your email address.</legend>
<?php echo form_input('email_add', set_value('email_add', 'Email Address')); ?>
<legend>Password</legend>
<?php echo form_password('password1', set_value('password1', 'Password')); ?>
<legend>Retype Password</legend>
<?php 
echo form_password('password2', 'Password');

echo form_submit('submit', 'Create Acccount');
?>

</fieldset>
</div>
</article>

</div><!-- end signup_form-->
<?php //$this->load->view('includes/footer'); ?>

			
	

