<div id="main" class="wrapper">
    <aside>
        <?php if ($this->session->userdata('is_logged_in') == true) { ?>
            <h5>Hi <?php echo $this->session->userdata('email_add'); ?>!</h5>
            <?php
            echo anchor('login/logout', 'Logout');
            echo '<br />';
            echo anchor('site/members_area', 'Profile Page');
            } else {
            echo anchor('login', 'Login');
            }
             ?>

    </aside>