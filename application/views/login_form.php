<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/home_nav'); ?>
	</div>
	<div id="main" class="wrapper">
		
        <article>
	<div id="login_form">
	<?php echo $this->session->flashdata('error_message'); ?>
	<h1>Log-in</h1>
    <?php 
	echo form_open('login/validate_credentials');
	echo form_input('email_add', 'Username/Email Address');
	echo form_password('password1', 'Password');
	echo form_submit('submit', 'Login');
	echo anchor('login/signup', 'Create Account');
	echo '<br />';
        echo anchor('login/forgot_password', 'forgot password?');
        echo form_close();	
	?>
        </article>
</div><!-- end login_form-->
</div>
			
	

