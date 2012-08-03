<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/home_nav'); ?>
	</div>
	<div id="main" class="wrapper">
		
        <article>
	<div id="login_form">
	<?php echo $this->session->flashdata('error_message'); ?>
	<h1>Please Enter Email Address</h1>
    <?php 
	echo form_open('login/forgot_password_c');
	echo form_input('email_add', 'Username/Email Address');
	//echo form_password('password1', 'Password');
	echo form_submit('submit', 'Submit');
	echo form_close();
	
	?>
        </article>
</div><!-- end login_form-->
</div>
			
	

