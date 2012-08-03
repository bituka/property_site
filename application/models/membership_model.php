<?php

class Membership_model extends CI_Model {

    function _prep_password($password) {
        return sha1($password . $this->config->item('encryption_key'));
    }

    function validate() {
        //	echo $this->input->post('email_add');
        //	echo $this->_prep_password($this->input->post('password1'));

        $this->db->where('email_add', $this->input->post('email_add'));
        $this->db->where('password1', $this->_prep_password($this->input->post('password1')));
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            return true;
        }
    }

    function create_member($hash) {
        //	$hash = md5( rand(0,1000) );


        $new_member_insert_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'phone_number' => $this->input->post('phone_number'),
            'email_add' => $this->input->post('email_add'),
            'password1' => $this->_prep_password($this->input->post('password1')),
            'password2' => $this->_prep_password($this->input->post('password2')),
            'hash' => $hash
        );

        $insert_data = $this->db->insert('users', $new_member_insert_data);
        return $insert_data;
    }

    function get_userid($email) {

        if ($this->input->post('email_add')) {
            $email_add = $this->input->post('email_add');
        } else {
            $email_add = $email;
        }
        // 	echo $email_add;  -- echo testing only 

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('email_add', $email_add);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function confirm_registration($activation_code) {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('hash', $activation_code);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            $this->db->where('hash', $activation_code);
            $this->db->set('active', 1);
            $this->db->update('users');

            return true;
        } else {
            return false;
        }
    }

    function active() {
        $this->db->where('email_add', $this->input->post('email_add'));
        $this->db->where('active', 1);
        $query = $this->db->get('users');
		
        if ($query->num_rows == 1) {
            return true;
        }else{
        	return false;
        }
    }
    
    function create_temppass($temppass) {
        
        $temppass_update_data = array(
            'temp_pass' => $temppass
        );
        
        $this->db->where('email_add', $this->input->post('email_add'));   
        $update_data = $this->db->update('users', $temppass_update_data);
        return $update_data;
    }
    
    function change_pass($tempass){
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('temp_pass', $tempass);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {

     //       $this->db->where('hash', $activation_code);
     //       $this->db->set('active', 1);
     //       $this->db->update('users');

            return true;
        } else {
            return false;
        }
    }
    
    function get_email($userid) {

        $this->db->select('email_add');
        $this->db->from('users');
        $this->db->where('id', $userid);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            foreach ($query->result() as $row) {
                $data = $row->email_add;
                
            }
           // print_r($data);die(); 
            return $data;
        }
    }
    
    function update_pass($userid, $temppass){
        
        $pass_update_data = array(
            'password1' => $this->_prep_password($this->input->post('password1')),
            'password2' => $this->_prep_password($this->input->post('password2')),
            'temp_pass' => NULL
        );
        
        $this->db->where('id', $userid);   
        $this->db->where('temp_pass', $temppass);
        $update_data = $this->db->update('users', $pass_update_data);
        return $update_data;
                
        
    }
    
    function get_temppass_by_userid($userid){
        
        $this->db->select('temp_pass');
        $this->db->from('users');
        $this->db->where('id', $userid);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            foreach ($query->result() as $row) {
                $data = $row->temp_pass;
                
            }
          //  print_r($data);die(); 
            return $data;
        }
        
    }
    
    function get_actcode_by_userid($email){
        
        $this->db->select('hash');
        $this->db->from('users');
        $this->db->where('email_add', $email);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            foreach ($query->result() as $row) {
                $data = $row->hash;
                
            }
            //print_r($data);die(); 
            return $data;
        }
        
    }

}