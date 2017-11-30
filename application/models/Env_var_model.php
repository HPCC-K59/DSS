<?php
/**
 * Created by PhpStorm.
 * User: nghiaduongtrung
 * Date: 11/23/17
 * Time: 5:03 PM
 */

class Env_var_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function get_weights_by_types($types){
        if(isset($types)){
            $this->db->select('id, name, weight');
            $this->db->from('env_var');
            $this->db->where_in('type', $types);
            $this->db->order_by('id', 'asc');
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }
        }
        return false;
    }
}