<?php
class Settings_model extends CI_Model{

    public function get_global_settings(){

       $query = $this->db->get('settings');
       $result = $query->result();
       return $result;
    }


    public function update($site_title){

        $this->db->where('site_title->key = site_title->value',$site_title);
        $this->db->update('settings');
        return true;
    }

}