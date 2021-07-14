<?php
class User_model extends CI_Model{

    public function get_users($order_by , $sort  , $limit , $offset = 0){

        $query = $this->db->get('users');
        
        if($limit != null){

            $this->db->limit($limit,$offset);
        }
        if($order_by != null){

            $this->db->order_by($order_by,$sort);
        }

        return $query->result();
    }

    public function get_user($id){

        $query = $this->db->get_where('users',array('id' => $id));

        return $query->row();
    }


    public function get_groups($order_by = null , $sort = 'DESC' , $limit = null , $offset = 0){

        $query = $this->db->get('groups');
        
        if($limit != null){

            $this->db->limit($limit,$offset);
        }
        if($order_by != null){

            $this->db->order_by($order_by,$sort);
        }

        return $query->result();
    }


    public function get_group($id){

        $query = $this->db->get('groups',array('id' => $id));

        return $query->row();
    }


    public function insert($data){

        $this->db->insert('users', $data);
        return true;
    }


    public function insert_group($data){

        $this->db->insert('groups', $data);
        return true;
    }


    public function update($data, $id){

        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return true;
    }


    public function update_group($data, $id){

        $this->db->where('id', $id);
        $this->db->update('groups', $data);
        return true;
    }


    public function delete($id){

        $this->db->where('id', $id);
        $this->db->delete('users');
        return true;
    }


    public function delete_group($id){

        $this->db->where('id', $id);
        $this->db->delete('groups');
        return true;
    }


    public function check_email($email){

        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if($query->num_rows() == 1){

            return false;
        }else{

            return true;
        }
    }


    public function check_username($username){

        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if($query->num_rows() == 1){

            return false;
        }else{

            return true;
        }
    }
}