<?php

class Email extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {

	}

	
	function resend_act_code() {

		// $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		// $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		// $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[8]|max_length[32]|numeric');
		$this->form_validation->set_rules('email_add', 'Email Address', 'trim|required|valid_email|');
		// $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|max_length[32]');
		// $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password1]');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('signup_form');
		} else {

			$email = $this->input->post('email_add');

			//check if email address exists returns the value of the id of the email
			$email_exist = $this->membership_model->get_userid($email);
			
		//	echo $email_exist; print_r($email_exist); echo $email_exist[0]->id; die();
				
			if ($email_exist) {
				//get the activation from DB to send - $actcode is same as $hash
				$actcode = $this->membership_model->get_actcode_by_userid($email);
				
				//echo $actcode; die();
								
				// send activation email
				
				$config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'goryo.webdev@gmail.com',
                    'smtp_pass' => '',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1'
                    );
                    $this->load->library('email', $config);

                    //    $this->email->set_crlf("\r\n");
                    $this->email->set_newline("\r\n");
                    $this->email->from('goryo.webdev@gmail.com', 'Goryo Web');
                    $this->email->to($email);
                    $this->email->subject('email from web dev');
                    $this->email->message("
				\r\n
				Thanks for signing up  
		    	\r\n 
				Please click this link to activate your account:  
      			\r\n  
      			http://localhost/site/login/activation/" . $actcode .
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

			if ($registration_confirmed) {//TODO message pages
				echo 'successfully registered!';
			} else {
				echo 'falied to register. no record found for that activation code.';
			}
		}
	}
}
