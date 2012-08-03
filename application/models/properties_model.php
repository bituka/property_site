<?php

class Properties_model extends CI_Model {

    // get location for dropdown option in form create ads
    function get_location_dropdown() {

        $this->db->select('locations');
        $this->db->from('location_options');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                /* 	$row = $this->{'mod_'.$content->type}->get($content->id);
                  print_r($item);
                  $items[] = clone $item;
                 */
                $data[$row->locations] = $row->locations;
            }
            return $data;
        }
    }

    function get_type_dropdown() {

        $this->db->select('types');
        $this->db->from('type_options');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                $data[$row->types] = $row->types;
            }
            return $data;
        }
    }

    function create_ads() {

        $new_house_insert_data = array(
            'location' => $this->input->post('location'),
            'type' => $this->input->post('type'),
            'rs' => $this->input->post('rs'),
            'price' => $this->input->post('price'),
            'details' => $this->input->post('details'),
            'user_id' => $this->input->post('user_id')
        );

        $insert_data = $this->db->insert('house', $new_house_insert_data);
        return $insert_data;
    }

    function insert_filename($insert_data) {
        $this->db->insert('house_pics', $insert_data);
        return;
    }

    function get_images($user_id) {
        $this->db->select('filename, id, user_id, house_id');
        $this->db->from('house_pics');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
              return $data;
        }
    }

    //get house_id per user
    function get_houseid($user_id) {


        $this->db->select('id');
        $this->db->from('house');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function get_images_by_userhouse_ids($user_id, $house_id) {

        $this->db->select('filename, id');
        $this->db->from('house_pics');
        $this->db->where('user_id', $user_id);
        $this->db->where('house_id', $house_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function get_house_by_house_id($ad_id, $user_id) {
        $this->db->select();
        $this->db->from('house');
        $this->db->where('user_id', $user_id);
        $this->db->where('id', $ad_id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            /*    foreach ($query->result() as $row) {
              $data[] = $row;
              //   $data[$row->house] = $row->house;
              //   echo $data;
              //   print_r($data);
              } */
            $row = $query->row();

            // if wanted to use array
            $data = array("id" => "$row->id",
                "location" => "$row->location",
                //"user_id" => "$row->user_id")
                "type" => "$row->type",
                "rs" => "$row->rs",
                "price" => "$row->price",
                "details" => "$row->details");
            //       $data = $row;
            //   print_r($arr);
            //   echo $row->id;
            //   echo $row->location;
            //   echo $row->type;
        }
        //   die();
        return $data;
    }

    function edit_ads_model() { 
        $new_house_update_data = array(
            'location' => $this->input->post('location'),
            'type' => $this->input->post('type'),
            'rs' => $this->input->post('rs'),
            'price' => $this->input->post('price'),
            'details' => $this->input->post('details'),
                //     'user_id' => $this->input->post('user_id')
        );

        $this->db->where('id', $this->input->post('house_id'));
        $update_data = $this->db->update('house', $new_house_update_data);
        return $update_data;
    }

    function delete_imagesdb_perad($user_id, $house_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('house_id', $house_id);
        $this->db->delete('house_pics');
    }

    function delete_adinfo($user_id, $house_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('id', $house_id);
        $this->db->delete('house');
    }

    function get_housedetails() { //TODO checking if being displayed properly
        $this->db->select('id, details');
        $this->db->from('house');
        $this->db->limit(10);
        $this->db->order_by("id", "desc");
        
        $query = $this->db->get();
     //   print_r($query);die();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
             //   print_r($row);
                
                $query2 = $this->db->query("select filename from house_pics where
                house_id=".$row['id']. " order by rand() limit 1");
                if($query2 -> num_rows() > 0){
                    $pic = $query2 -> row_array();
                    $PIC = $pic['filename'];
              
                }else{
                    $PIC = '';
                }
                $query2 -> free_result();
                $data[] = array(
                    'id' => $row['id'],
                    'details' => $row['details'],
                    'photo' => $PIC
                );
                $query->free_result();
               // print_r($data);die();
                        
                }
            
                return $data;        
        
        }
    }

}