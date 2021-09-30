<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('userIdPK')) {
            return redirect(base_url().'login');
        }
        //parent::__construct();
        $this->load->model('Loginmodel');
        $userDetail=$this->Loginmodel->userDetail();
        $this->load->view('Template/header', ['userDetail'=>$userDetail]);
    }
}
