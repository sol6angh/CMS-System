<?php 
class settings extends MY_Controller{

    public function index(){

        $data['main_content'] = 'admin/settings/index';
        $this->load->view('admin/layout/main',$data);
    }


    public function edit(){

        $site_title = $this->input->post($this->global_data['site_title']);

        $this->settings_model->update($site_title);

        $this->session->flashdata('settings_saved','Your setting has been saved');
        redirect('admin/settings/index');
        exit();
    }

}