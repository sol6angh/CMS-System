<?php
class Article_model extends CI_Model{

    public function get_articles($order_by = null ,$sort = 'DESC', $limit = null, $offset = 0){

            /*
        * Get Articles
        * 
        * @param - $order_by (string)
        * @param - $sort (string)
        * @param - $limit (int)
        * @param - $offset (int)
        * 
        */
            $this->db->select('a.*, b.name as category_name, c.first_name, c.last_name');
            $this->db->from('articles as a');
            $this->db->join('categories AS b', 'b.id = a.category_id','left');
            $this->db->join('users AS c', 'c.id = a.user_id','left');

            if($limit != null){
                $this->db->limit($limit, $offset);
            }
            if($order_by != null){
                $this->db->order_by($order_by, $sort);
            }
            $query = $this->db->get();	
            return $query->result();
        
    }


    public function get_filtered_articles($keywords, $order_by = null ,$sort = 'DESC', $limit = null, $offset = 0){

        $this->db->select('a.*, b.name as category_name, c.first_name, c.last_name');
            $this->db->from('articles as a');
            $this->db->join('categories AS b', 'b.id = a.category_id','left');
            $this->db->join('users AS c', 'c.id = a.user_id','left');
            $this->db->like('title', $keywords);
            $this->db->or_like('body', $keywords);

            if($limit != null){
                $this->db->limit($limit, $offset);
            }
            if($order_by != null){
                $this->db->order_by($order_by, $sort);
            }
            $query = $this->db->get();	
            return $query->result();
    }


    public function get_menu_items(){

        $this->db->where('in_menu', 1);
        $this->db->order_by('order');
        $query = $this->db->get('articles');
        return $query->result();
    }


    public function get_article($id){

        $query = $this->db->get_where('articles',array('id' => $id));
        return $query->row();
    }


    public function get_categories($order_by = null , $sort = 'DESC' , $limit = null , $offset = 0){

        $query = $this->db->get('categories');
        
        if($limit != null){

            $this->db->limit($limit,$offset);
        }
        if($order_by != null){

            $this->db->order_by($order_by,$sort);
        }

        return $query->result();
    }


    public function get_category($id){

        $query = $this->db->get_where('categories',array('id' => $id));
        return $query->row();
    }


    public function insert($data){

        $this->db->insert('articles', $data);
        return true;
    }


    public function update($data,$id){

        $this->db->where('id',$id);
        $this->db->update('articles',$data);
        return true;
    }


    public function delete($id){

        $this->db->where('id', $id);
        $this->db->delete('articles');
        return true;
    }


    public function insert_category($data){

        $this->db->insert('categories', $data);
        return true;
    }


    public function update_category($data,$id){

        $this->db->where('id',$id);
        $this->db->update('categories',$data);
        return true;
    }


    public function delete_category($id){

        $this->db->where('id', $id);
        $this->db->delete('categories');
        return true;
    }
}