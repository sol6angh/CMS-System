<?php
class authenticate extends MY_Controller{

    public function login(){

        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() === FALSE){

            $this->load->view('admin/layout/login');
        }else{

            $username = filter_var($this->input->post('username'), FILTER_SANITIZE_STRING);
            $password = filter_var($this->input->post('password'), FILTER_SANITIZE_STRING);
            
            
            $user_id = $this->authenticate_model->login($username,$password);

            if($user_id){

                $user_data = array(
                    'id' => $user_id->id,
                    'first_name' => $user_id->first_name,
                    'last_name' => $user_id->last_name,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_success','You logged in successfully, Welcome ');
                $this->session->sess_regenerate($destroy = TRUE);

                redirect('admin/dashboard');
                exit();
            }else{

                $this->session->set_flashdata('access_denied','Access Denied');
                redirect('admin/authenticate/login');
                exit();
            }

        }

    }


    public function logout(){

        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();

        $this->session->set_flashdata('logged_out', 'You logged out successfully');
        redirect('admin/authenticate/login');
        exit();
    }
}