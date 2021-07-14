<?php
class users extends MY_Controller{

	public function __construct(){

        parent::__construct();

        //Access Control
        if(! $this->session->userdata('logged_in')){

			redirect('admin/authenticate/login');
			exit();
		}
		
		//Load Email Library
		$this->load->library('email');
	}
	

    public function index(){

        $data['users'] = $this->user_model->get_users('id', 'DESC', 5);

        $data['main_content'] = 'admin/users/index';
        $this->load->view('admin/layout/main',$data);
    }

    public function add(){

        //Validation Rules
		$this->form_validation->set_rules('first_name','First Name','trim|required|min_length[2]');
		$this->form_validation->set_rules('last_name','Last Name','trim|required|min_length[2]');
		$this->form_validation->set_rules('email','Email','required|is_unique[users.email]');
        $this->form_validation->set_rules('username','UserName','required|is_unique[users.username]');
        $this->form_validation->set_rules('password','Password','required|min_length[3]');
        $this->form_validation->set_rules('confirm_password','Confirm Password','required|min_length[3]|matches[password]');
				
		$data['groups'] = $this->user_model->get_groups();
		
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/users/add';
			$this->load->view('admin/layout/main', $data);
		} else {

			$password_hashed = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

			//Create Articles Data Array
			$data = array(
					'first_name'        => $this->input->post('first_name'),
					'last_name'         => $this->input->post('last_name'),
					'email'             => $this->input->post('email'),
					'username'          => $this->input->post('username'),
					'password'   		=> $password_hashed,
					'group_id'          => $this->input->post('group')
			);
			
			//Articles Table Insert
			$this->user_model->insert($data);
/*
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_port'] = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user'] = 'sol6angh@gmail.com';
			$config['smtp_pass'] = 'muxkqboejxsxuuow';
			$config['newline'] = '\r\n';
			$config['mailtype'] = 'text';
			$config['charset'] = 'utf-8';
			$config['validation'] = TRUE;*/

			//$this->email->initialize($config);

			$this->email->from('sol6angh@gmail.com', 'MOI');
			$this->email->to($data['email']);

			$this->email->subject('استدعاء| وزارة الداخلية');
			$this->email->message('المواطن فارس الغامدي لقد تم استدعائك لمقر الداخلية وذلك لاستجوابك عن قضية غسيل اموال مشبوه بها الرجاء الحضور عند تلقيك هذا الايميل قبل استعمال القوة المفرطة وجمعه مباركه يا حبي ههههههه');

			if($this->email->send()){

				//Create Message
			$this->session->set_flashdata('email_sent', 'Email has sent successfully');

			//Create Message
			$this->session->set_flashdata('user_saved', 'Your user has been saved');
			
			//Redirect to pages
			redirect('admin/users');
			exit();

			}else{
				echo $this->email->print_debugger();
			}
			
		}
    }


    public function edit($id){

		if(isset($id) && !empty($id)){

			//Validation Rules
			$this->form_validation->set_rules('first_name','First Name','trim|required|min_length[2]');
			$this->form_validation->set_rules('last_name','Last Name','trim|required|min_length[2]');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('username','UserName','required');
					
			$data['groups'] = $this->user_model->get_groups();
			
			$data['user'] = $this->user_model->get_user($id);
			
			if($this->form_validation->run() == FALSE){
				//Views
				$data['main_content'] = 'admin/users/edit';
				$this->load->view('admin/layout/main', $data);
			} else {
				
				$email = $this->input->post('email');
				$username = $this->input->post('username');

				if($this->user_model->check_email($email)){
					
					if($this->user_model->check_username($username)){

						//Create User Data Array
				$data = array(
					'first_name'        => $this->input->post('first_name'),
					'last_name'         => $this->input->post('last_name'),
					'email'             => $this->input->post('email'),
					'username'          => $this->input->post('username'),
					'group_id'          => $this->input->post('group')
					);
				
					//Articles Table Insert
					$this->user_model->update($data, $id);
					
					//Create Message
					$this->session->set_flashdata('user_updated', 'Your user has been updated');
					
					//Redirect to pages
					redirect('admin/users');
					exit();

					}else{

						//Create Message
						$this->session->set_flashdata('username_exists', 'This username already exist');

						//Redirect to pages
						redirect('admin/users');
						exit();

					}

				}else{

					//Create Message
					$this->session->set_flashdata('email_exists', 'This email already exist');

					//Redirect to pages
					redirect('admin/users');
					exit();
				}
				
			}

		}
    }


    public function delete($id){

        $this->user_model->delete($id);

        //Create Message
			$this->session->set_flashdata('user_deleted', 'Your user has been deleted');
			
			//Redirect to pages
			redirect('admin/users');
			exit();
	}
	
}