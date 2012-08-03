<?php

class Site extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {//TODO display data in home page from DB
//    $data['slide_pics'] = $this->site_model->get_slidepics();
        $data['house_slide'] = $this->site_model->get_house_desc();
//      print_r($data);
//      die();
        $data['main_content'] = 'home';
        $this->load->view('includes/template', $data);
    }

    function login() {
        $data['main_content'] = 'login_form';
        $this->load->view('includes/template', $data);
    }

    function members_area() {
//	$this->is_logged_in();
        $this->members_model->is_logged_in();
        $this->load->model('properties_model');
        $email = $this->session->userdata('email_add');
// user id got from the controller	
        $user_id = $this->session->userdata('user_id');
        $data['rows'] = $this->members_model->get_records_by_userid($user_id);
        $data['profile'] = $this->members_model->get_profile_by_userid($user_id);

        $data['images'] = $this->properties_model->get_images($user_id);
        $data['user_id'] = $this->membership_model->get_userid($email);
        $this->load->view('logged_in_area', $data);
    }

    //public view 1 item
    function get_house_by_id1() {

        $house_id = $this->uri->segment(3);

        $data['rows'] = $this->site_model->get_house_by_house_id_1($house_id);
        $data['images'] = $this->site_model->get_images_by_house_id_1($house_id);

        $data['main_content'] = 'public_1';
        $this->load->view('includes/template', $data);
    }

    //public view all item for rent -- get_house_by_id_rent()
    function public_rent() {
        $this->load->library('pagination');
        $this->load->library('table');


        $config['base_url'] = base_url() . 'site/public_rent/';

        //get count house for rent
        $this->db->where('rs', 'rent');
        $this->db->from('house');
        $rentcount = $this->db->count_all_results();


        //pagination config
        $config['total_rows'] = $rentcount;
        $config['per_page'] = 5;
        $config['num_links'] = 5;
        $config['enable_query_strings'] = FALSE;
        $config['page_query_string' = FALSE;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $data['rows'] = $this->site_model->get_for_rent($config['per_page'], $this->uri->segment(3));

        $data['main_content'] = 'public_rent';
        $this->load->view('includes/template', $data);
    }

    
}