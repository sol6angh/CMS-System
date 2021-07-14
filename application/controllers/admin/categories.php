<?php
class categories extends MY_Controller{

	public function __construct(){

        parent::__construct();

        //Access Control
        if(! $this->session->userdata('logged_in')){

			redirect('admin/authenticate/login');
			exit();
        }
	}
	

    public function index(){

        //Get Categories
        $data['categories'] = $this->article_model->get_categories('id','DESC');

        //View
        $data['main_content'] = 'admin/categories/index';
        $this->load->view('admin/layout/main',$data);
    }


    public function add(){
        
		//Validation Rules
		$this->form_validation->set_rules('name','Name','trim|required|min_length[2]');
		
		$data['categories'] = $this->article_model->get_categories();
		
		
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/categories/add';
			$this->load->view('admin/layout/main', $data);
		} else {
			//Create Articles Data Array
			$data = array(
					'name'         => $this->input->post('name')
			);
			
			//Articles Table Insert
			$this->article_model->insert_category($data);
			
			//Create Message
			$this->session->set_flashdata('category_saved', 'Your category has been saved');
			
			//Redirect to pages
			redirect('admin/categories');
			exit();
		}
    }
    

    public function edit($id){
        
		//Validation Rules
		$this->form_validation->set_rules('name','Name','trim|required|min_length[2]');
		
		$data['categories'] = $this->article_model->get_category($id);
		
		
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/categories/edit';
			$this->load->view('admin/layout/main', $data);
		} else {
			//Create Articles Data Array
			$data = array(
					'name'         => $this->input->post('name')
			);
			
			//Articles Table Insert
			$this->article_model->update_category($data,$id);
			
			//Create Message
			$this->session->set_flashdata('category_updated', 'Your category has been updated');
			
			//Redirect to pages
			redirect('admin/categories');
			exit();
		}
    }
    

    public function delete($id){

		$this->article_model->delete_category($id);

		//Create Message
		$this->session->set_flashdata('category_deleted', 'Your category has been deleted successfully');

		redirect('admin/categories');
		exit();
	}
}