<?php
class Authenticate_model extends CI_Model{

    public function login($username, $password){
          
            $query = $this->db->get_where('users', array('username' => $username));
            $user = $query->row();

        if(password_verify($password, $user->password)){

            return $user;       
        }else{
            return false;
        }
            
    }
}