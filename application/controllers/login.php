<?php

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['main_content'] = 'login_form';
        $this->load->view('includes/template', $data);
    }

    function validate_credentials() {
        //$this->membership_model->validate();

        $validated = $this->membership_model->validate();

        if ($validated) { // if the user's credentials validated redirect to profile page
            // check if active
            $active = $this->membership_model->active();
			
            if ($active) {

                //get user_id of the logged in member
                $query_id['uids'] = $this->membership_model->get_userid();
                $uids = $query_id['uids'];
                foreach ($uids as $uid) :

                    $data = array(
                        'email_add' => $this->input->post('email_add'),
                        'is_logged_in' => true,
                        'user_id' => $uid->id,
                    );

                endforeach;
                $this->session->set_userdata($data);


                redirect('site/members_area');
            }
            else { //TODO not active yet resend activation code / needs improvement for user's message
            	
                $data['main_content'] = 'not_active_form';
                $this->load->view('includes/template', $data);
            }
        } else { // incorrect username or password
            $this->session->set_flashdata('error_message', '<div class="error">Incorrect username or password</div>');
            redirect('login');
            // $this->index();
        }
    }

    function signup() {
        $data['main_content'] = 'signup_form';
        $this->load->view('includes/template', $data);
    }

    function create_member() {
        // $this->load-library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[8]|max_length[32]|numeric');
        $this->form_validation->set_rules('email_add', 'Email Address', 'trim|required|valid_email|unique[users.email_add]');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|max_length[32]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password1]');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('signup_form');
        } else {

            $hash = md5(rand(0, 1000));


            if ($query = $this->membership_model->create_member($hash)) {

                // send activation email


                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'goryo.webdev@gmail.com',
                    'smtp_pass' => 'Pass@2011',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1'
                );
                $this->load->library('email', $config);

                //    $this->email->set_crlf("\r\n");
                $this->email->set_newline("\r\n");
                $this->email->from('goryo.webdev@gmail.com', 'Goryo Web');
                $this->email->to('goryo.webdev@gmail.com');
                $this->email->subject('email from web dev');
                $this->email->message(" 
				\r\n
				Thanks for signing up  
		    	\r\n 
				Please click this link to activate your account:  
      			\r\n  
      			http://localhost/site/login/activation/" . $hash .
                        "\r\n 
      			or copy the link above in your address bar if it is not clickable.
      			"

                        //echo site_url("/site/login/activation/".$email_add."/".$hash.  -- for testing only
                        // http://www.yourwebsite.com/verify.php?email=".$email_add."&hash=".$hash.  -- for testing only
                );


                if ($this->email->send()) {
                    //	echo "email successful";

                    $data['main_content'] = 'signup_successful';
                    $this->load->view('includes/template', $data);
                } else {
                    show_error($this->email->print_debugger());
                }
            }
        } // end else of 	if($this->form_validation->run() == FALSE)
    }

// end of function

    function logout() {
        $this->session->sess_destroy();
        $this->index();
    }

    //TODO successfully and unsuccessfull page
    function activation() {
        //	$email_add		= $this->uri->segment(3);
        $activation_code = $this->uri->segment(3);

        if ($activation_code == '') {
            echo 'Error with the activation code.';
        } else {
            $registration_confirmed = $this->membership_model->confirm_registration($activation_code);
            
            //TODO page display for activation
            if ($registration_confirmed) {
                echo 'successfully registered!';
            } else {
                echo 'falied to register. no record found for that activation code.';
            }
        }
    }

    function forgot_password() {
        $data['main_content'] = 'forgot_form';
        $this->load->view('includes/template', $data);
    }

    function forgot_password_c() {


        $email = $this->input->post('email_add');
        $temppass = md5(rand(0, 1000));

        //check if email address exists
        $email_exist = $this->membership_model->get_userid($email);

        //if email address exists send temp password on email


        if ($email_exist) {

            if ($this->membership_model->create_temppass($temppass)) {

                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'goryo.webdev@gmail.com',
                    'smtp_pass' => 'Pass@2011',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1'
                );
                $this->load->library('email', $config);

                $this->email->set_crlf("\r\n");
                $this->email->set_newline("\r\n");
                $this->email->from('goryo.webdev@gmail.com', 'Goryo Web');
                $this->email->to('goryo.webdev@gmail.com');
                $this->email->subject('email from web dev');
                $this->email->message(" 
				\r\n
				Thanks for signing up  
		    	\r\n 
				Please click this link to activate your account:  
      			\r\n  
      			http://localhost/site/login/tempchangepass/" . $temppass .
                        "\r\n 
      			or copy the link above in your address bar if it is not clickable.
      			"

                        //echo site_url("/site/login/activation/".$email_add."/".$hash.  -- for testing only
                        // http://www.yourwebsite.com/verify.php?email=".$email_add."&hash=".$hash.  -- for testing only
                );


                if ($this->email->send()) { //TODO successful page
                    echo "email successful";

                    // $data['main_content'] = 'signup_successful';
                    // $this->load->view('includes/template', $data);
                } else {
                    show_error($this->email->print_debugger());
                }
            }
        } else {
            $data['main_content'] = 'email_notexist';
            $this->load->view('includes/template', $data);
        }
    }

    //chnage password if temporary password matches in user's info
    function tempchangepass() {

        $temppass = $this->uri->segment(3);
//        echo $temppass;die();
        if ($temppass == '') {
            echo 'Error -- Please contact the web master -- email.';
        } else {
            $change_pass = $this->membership_model->change_pass($temppass);

            if ($change_pass) {
                //    redirect('email/send_genpass/' . $change_pass);
                redirect('login/change_password/' . $change_pass . '/' . $temppass);
            } else {
                echo 'falied to register. no record found for that activation code.';
            }
        }
    }


    function change_password() {

        $data['userid'] = $this->uri->segment(3);
        $data['temppass'] = $this->uri->segment(4);

        $data['main_content'] = 'changepass_form';
        $this->load->view('includes/template', $data);
    }

    function do_change_password() {
        $userid = $this->input->post('userid');
        $temppass = $this->input->post('temppass');

        $temp_pass = $this->membership_model->get_temppass_by_userid($userid);

        //validate password
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|max_length[32]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password1]');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('changepass_form');
        } else {
            if ($temppass === $temp_pass) {
                if ($this->membership_model->update_pass($userid, $temppass)) {
                    $data['main_content'] = 'changepass_successful';
                    $this->load->view('includes/template', $data);
                } else {
                    $data['main_content'] = 'temppass_error';
                    $this->load->view('includes/template', $data);
                }
            } else {
                $data['main_content'] = 'temppass_error';
                $this->load->view('includes/template', $data);
            }
        }
    }

}