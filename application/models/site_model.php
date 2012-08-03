<?php

class Site_model extends CI_Model {

    function get_slidepics() {

        $this->db->select('filename');
        $this->db->from('house_pics');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function get_house_desc() {

        $this->db->select('id, details, rs');
        $this->db->from('house');
        $this->db->limit(4);
        $this->db->order_by("id", "desc"); 

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // $data[] = $row;
                //   print_r($row);
                //    echo $row->id ;

                $this->db->select('filename');
                $this->db->from('house_pics');
                $this->db->where('house_id', $row->id);
                $this->db->order_by('filename', 'random');
                $this->db->limit(1);

                $query2 = $this->db->get();

                if ($query2->num_rows() > 0) {
                    $pic = $query2->row_array();

                    $PIC = $pic['filename'];
                } else {
                    $PIC = 'no_image.png';
                }
                $query2->free_result();
                $data[] = array(
                    'id' => $row->id,
                    'details' => $row->details,
                    'rs' => $row->rs,
                    'photo' => $PIC
                );
                $query->free_result();
            }
        } else {
            echo 'no data';
        }

        return $data;
    }

    function get_house_by_house_id_1($house_id) {
        $this->db->select();
        $this->db->from('house');
        $this->db->where('id', $house_id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
                //   $data[$row->house] = $row->house;
                //   echo $data;
                //   print_r($data);
            }
            //    $row = $query->row();
            // if wanted to use array
            //     $data = array("id" => "$row->id",
            //        "location" => "$row->location",
            //"user_id" => "$row->user_id")
            //         "type" => "$row->type",
            //         "rs" => "$row->rs",
            //         "price" => "$row->price",
            //         "details" => "$row->details");
            //   print_r($arr);
            //   echo $row->id;
            //   echo $row->location;
            //   echo $row->type;
        }
        //   die();
        return $data;
    }

    function get_images_by_house_id_1($house_id) {

        $this->db->select('filename');
        $this->db->from('house_pics');
        $this->db->where('house_id', $house_id);
        // $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }
    
    
     function get_for_rent($num, $offset) {
             
     //   echo $num  . 'putek'. $offset; die();
         
        $this->db->select('id, location, type, rs, price');
        $this->db->from('house');
        $this->db->where('rs', 'rent');
        $this->db->limit($num, $offset);

        $query = $this->db->get(); 
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
                
            }
        }
    //    print_r($data);
    //    die();
        return $data;
         
   //     $query = $this->db->get_where('house',array('rs' => 'rent'), $num, $offset);
     //   $this->db->limit($num, $offset);
     //   return $query;
  }

}

