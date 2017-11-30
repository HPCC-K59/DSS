<?php
/**
 * Created by PhpStorm.
 * User: nghiaduongtrung
 * Date: 11/23/17
 * Time: 5:03 PM
 */

class Major_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function get_majors_by_ids($ids){
        if(isset($ids)){
            $this->db->select('*');
            $this->db->from('major');
            $this->db->where_in('id', $ids);
            $this->db->order_by('id');
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }
        }
        return false;
    }
}