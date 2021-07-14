<?php 
class groups extends MY_Controller{

	public function __construct(){

        parent::__construct();

        //Access Control
        if(! $this->session->userdata('logged_in')){

			redirect('admin/authenticate/login');
			exit();
        }
	}
	

    public function index(){

        $data['groups'] = $this->user_model->get_groups('id', 'DESC', 10);

        $data['main_content'] = 'admin/groups/index';
        $this->load->view('admin/layout/main', $data);
    }

    public function add(){

        //Validation Rules
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]');
        
        $data['groups'] = $this->user_model->get_groups('id', 'DESC', 10);
		
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/groups/add';
			$this->load->view('admin/layout/main', $data);
		} else {
			//Create Articles Data Array
			$data = array(
					'name'         => $this->input->post('name'),
			);
			
			//Articles Table Insert
			$this->user_model->insert_group($data);
			
			//Create Message
			$this->session->set_flashdata('group_saved', 'Your group has been saved');
			
			//Redirect to pages
			redirect('admin/groups');
			exit();
		}
    }


    public function edit($id){

        //Validation Rules
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]');
        
        $data['groups'] = $this->user_model->get_groups('id', 'DESC', 10);

        $data['group'] = $this->user_model->get_group($id);
		
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/groups/edit';
			$this->load->view('admin/layout/main', $data);
		} else {
			//Create Articles Data Array
			$data = array(
					'name'         => $this->input->post('name'),
			);
			
			//Articles Table Insert
			$this->user_model->update_group($data, $id);
			
			//Create Message
			$this->session->set_flashdata('group_updated', 'Your group has been updated');
			
			//Redirect to pages
			redirect('admin/groups');
			exit();
		}
    }


    public function delete($id){

		$this->user_model->delete_group($id);

		//Create Message
		$this->session->set_flashdata('group_deleted', 'Your group has been deleted successfully');

		redirect('admin/groups');
		exit();
	}
}