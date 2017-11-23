<?php
/**
 * Created by PhpStorm.
 * User: nghiaduongtrung
 * Date: 11/23/17
 * Time: 5:03 PM
 */

class School_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function get_by_id($id){
        if(isset($id) && is_numeric($id)){
            $this->db->select('*');
            $this->db->from('school');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array()[0];
            }
        }
        return false;
    }
}