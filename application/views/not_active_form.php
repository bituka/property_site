<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/nostrong_nav'); ?>

	<div id="main" class="wrapper">
	<article>
	<div id="login_form">
	<?php echo $this->session->flashdata('error_message'); ?>
	<h1>Please Enter Email Address to resend activation code.</h1>
    <?php 
	echo form_open('email/resend_act_code');
	echo form_input('email_add', 'Username/Email Address');
	//echo form_password('password1', 'Password');
	echo form_submit('submit', 'Submit');
	echo form_close();
	
	?>
        </article>
	
	
</div><!-- end login_form-->
</div>
		