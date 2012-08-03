<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/home_nav'); ?>
</div>
<div id="main" class="wrapper">

    <article>
        <div id="login_form">
            <?php echo $this->session->flashdata('error_message'); ?>
            <h1>Please Enter New Password</h1>
            <?php echo form_open('login/do_change_password'); ?>
            <?php echo form_hidden('userid', $userid); 
                  echo form_hidden('temppass', $temppass); 
            ?>
            <legend>Password</legend>
            <?php echo form_password('password1', set_value('password1', 'Password')); ?>
            <legend>Retype Password</legend>
            <?php
            echo form_password('password2', 'Password');

            echo form_submit('submit', 'Submit');
            echo form_close();
            ?>

    </article>
</div><!-- end login_form-->
</div>



