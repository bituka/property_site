<?php

class Properties extends CI_Controller {

//TODO page title for all pages
    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('properties_model');

        $this->members_model->is_logged_in();
        $email = $this->session->userdata('email_add');

        //get user_id
        $data['rows'] = $this->membership_model->get_userid($email);

        //model for drop-down options
        $data['locations'] = $this->properties_model->get_location_dropdown();
        $data['types'] = $this->properties_model->get_type_dropdown();


        $data['main_content'] = 'create_ads_form';
        $this->load->view('includes/template', $data);
    }

    function create_ads() {

        $this->members_model->is_logged_in();
        $user_id = $this->session->userdata('user_id');
        //check ad limit per user
        $house_id = $this->properties_model->get_houseid($user_id);
        // print_r($house_id);
        //  echo count($house_id);
        //  die();
        if (count($house_id) <= 4) {
            // $this->load-library('form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            $this->form_validation->set_rules('rs', 'For rent or sale', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
            $this->form_validation->set_rules('details', 'Details', 'trim|required|');
            //		$this->form_validation->set_rules('user_id', 'Details', 'trim|required|');


            if ($this->form_validation->run() == FALSE) {
                //display errors
                $this->load->view('create_ads_form');
            } else {
                //	echo "validation success";
                // ****for review***
                //insert ads to database
                if ($this->properties_model->create_ads()) {
                    redirect('site/members_area');
                }
            }
        } else {
            echo 'more than 5 ads';
        }
    }

    function upload_photos_c() {
        $this->members_model->is_logged_in();
        $this->load->model('properties_model');
        $email = $this->session->userdata('email_add');
        // user id got from the controller
        $user_id = $this->session->userdata('user_id');
        $data['rows'] = $this->membership_model->get_userid($email);

        $ad_id = $this->uri->segment(3);

        //get user_id
        $data['user_id'] = $this->membership_model->get_userid($email);

        //get images
        //   $data['images'] = $this->properties_model->get_images();
        $data['images'] = $this->properties_model->get_images($user_id);
        $data['error'] = '';
        $data['main_content'] = 'upload_photos';
        $this->load->view('includes/template', $data);
    }

    //TODO test code

    function code_test() {

        $this->members_model->is_logged_in();
        $this->load->model('properties_model');
        $email = $this->session->userdata('email_add');
    }

    function do_upload() {
        $this->members_model->is_logged_in();
        $this->load->model('properties_model');
        $house_id = $this->input->post('house_id');

        //  echo $house_id;die();
        $email = $this->session->userdata('email_add');

        //get user_id
        $data['row_userid'] = $this->membership_model->get_userid($email);
        $user_id = $data['row_userid'][0]->id;

        $images = $this->properties_model->get_images_by_userhouse_ids($user_id, $house_id);

        //  echo count($images);die();
        //   limit the image count to 3 per ad
        if (count($images) <= 2) {


            //upload image
            foreach ($_FILES['userfile'] as $key => $file) {
                $i = 0;
                foreach ($file as $item) {
                    $data[$i][$key] = $item;

                    $i++;
                }
            }

            // END RE-SERIALIZE
            //  print_r($_FILES);die; // see the real income data
            //   print_r($data);// die; // serialized data
            //file = ''; // reset
            //   $_FILES = $data; // re-declarate
            //   print_r($_FILES);die;
            // process file one by one

            foreach ($data as $sep_file) {
                $_FILES = array($sep_file);


                if ($_FILES AND $_FILES['0']['name']) {

                    $config['upload_path'] = './upload_images/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10000';
                    $config['max_width'] = '1024';
                    $config['max_height'] = '768';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload(0)) {//'upload successful';
                        $file = $this->upload->data(0);

                        //insert data -- file info
                        //   insert info to database
                        $filename = $file['file_name'];

                        $insert_data = array(
                            'filename' => "$filename",
                            'user_id' => $this->input->post('user_id'),
                            'house_id' => $this->input->post('house_id'),
                        );

                        $this->properties_model->insert_filename($insert_data);
                    } else { //(not upload)
                        $data['images'] = $this->properties_model->get_images();
                        $data['filename'] = $_FILES['0']['name'];
                        $data['error'] = $this->upload->display_errors('<p class="error">', '</p>');
                        $data['main_content'] = 'upload_photos';
                        $this->load->view('includes/template', $data);
                    }
                }//end if( $_FILES AND $_FILES$_FILES['0']['name'] )
            }//end foreach
            if ($data['error'] === null) {
                redirect('site/members_area/');
            } else { //(not upload)
                $data['images'] = $this->properties_model->get_images();
                $data['filename'] = $_FILES['0']['name'];
                $data['error'] = $this->upload->display_errors('<p class="error">', '</p>');
                $data['main_content'] = 'upload_photos';
                $this->load->view('includes/template', $data);
            }
        } else {

            //    echo 'you are more than'

            $data['main_content'] = 'abovelimit_photos';
            $this->load->view('includes/template', $data);
        }
    }

//end function do_upload

    function edit_info_c() {

//        echo $this->uri->segment(3);

        $this->load->model('properties_model');

        $this->members_model->is_logged_in();
        $email = $this->session->userdata('email_add');

        //get user_id
        $data['rows'] = $this->membership_model->get_userid($email);

        $user_id = $this->session->userdata('user_id');
        //   echo $user_id; die();
        $ad_id = $this->uri->segment(3);

        //model for drop-down options
        $data['locations'] = $this->properties_model->get_location_dropdown();
        $data['types'] = $this->properties_model->get_type_dropdown();

        //get info of selected ad to edit
        $data['house_selected'] = $this->properties_model->get_house_by_house_id($ad_id, $user_id);
        //  print_r($data);die();

        $data['main_content'] = 'edit_ads_form';
        $this->load->view('includes/template', $data);
    }

    //TODO needs to double check if where user_id statement is required
    function edit_ads_c() { {
            $this->members_model->is_logged_in();
            $this->load->model('properties_model');

            // $this->load-library('form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            $this->form_validation->set_rules('rs', 'For rent or sale', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
            $this->form_validation->set_rules('details', 'Details', 'trim|required|');
            //		$this->form_validation->set_rules('user_id', 'Details', 'trim|required|');


            if ($this->form_validation->run() == FALSE) {
                //display errors
                $this->load->view('create_ads_form');
            } else {
                //	echo "validation success";
                // ****for review***
                //insert ads to database
                if ($this->properties_model->edit_ads_model()) {
                    redirect('site/members_area');
                }
            }
        }
    }

    //TODO delete ad and photos with it -- javascript confirmation
    function delete_info_c() {
        $this->members_model->is_logged_in();
        $this->load->model('properties_model');
        $user_id = $this->session->userdata('user_id');
        $house_id = $this->uri->segment(3);


        //delete all images 
        $house_images = $this->properties_model->get_images_by_userhouse_ids($user_id, $house_id);

        if ($house_images == !NULL && count($house_images <= 3)) {
            foreach ($house_images as $house_pic) {
                $filename = $house_pic->filename;

                //       echo count($filename);die();
                $path = "upload_images/" . $filename;
                unlink($path);
            }// echo 'all deleted';
        }
        //    $path = "upload_images/" . $filename;
        //delete all images in DB
        $this->properties_model->delete_imagesdb_perad($user_id, $house_id);

        //delete ad info in DB
        $this->properties_model->delete_adinfo($user_id, $house_id);

        //return members area
        redirect('site/members_area');
    }

    //TODO confirm delete javascript
    function delete_photo_c() {//TODO continue delete photos
        $this->members_model->is_logged_in();

        $data = $this->input->post('check_file');
        // print_r($data);
        //   echo $data[0];
        //   echo count($data);
        if ($data) {
            //echo 'meron';
            //TODO -- serialize 
            foreach ($data as $data => $file) {
                //  echo $file;

                $path = "upload_images/" . $file;

                $result = unlink($path);

                if ($result) { // delete successful
                    //     $data['status'] = "File has been deleted successfully!";
                    $this->db->where('filename', $file);
                    $this->db->delete('house_pics');
                    
                    
                    //TODO redirect?
                    redirect('site/members_area');
                } else {
                    $data['status'] = "There is a problem deleting the file!";
                    echo $data['status'];
                }
            }
        } else {
            //TODO error page
            echo 'Error deleting the data or there is no file selected to delete.';
        }

        /*
          }
          }
          echo $this->uri->segment(3);die();

          $this->members_model->is_logged_in();

          $filename = $this->uri->segment(3);
          $path = "upload_images/" . $filename;

          $result = unlink($path);

          if ($result) { // delet successful
          //     $data['status'] = "File has been deleted successfully!";
          $this->db->where('filename', $filename);
          $this->db->delete('house_pics');

          redirect('site/members_area');
          } else {
          $data['status'] = "There is a problem deleting the file!";
          echo $data['status'];
          }

         */
        //echo $data['status'];
    }

    function delete_photopage() {


        $this->members_model->is_logged_in();
        $this->load->model('properties_model');


        $house_id = $this->uri->segment(3);
        $user_id = $this->session->userdata('user_id');


        $data['images'] = $this->properties_model->get_images_by_userhouse_ids($user_id, $house_id);
        $data['main_content'] = 'delete_photos_form';
        $this->load->view('includes/template', $data);
    }

}