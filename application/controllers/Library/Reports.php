<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bookmodel');
        $this->load->model('membermodel');
        $this->load->model('reportmodel');
        $this->load->model('loginmodel');
    }
    public function index()
    {
        $userDetail=$this->loginmodel->userDetail();
        $this->load->view('Template/header', ['userDetail'=>$userDetail]);
        $bookCategory=$this->bookmodel->bookCategory('*');
        $this->load->view('Library/reports', compact('bookCategory'));
        $this->load->view('Template/footer');
    }
    public function printCatalogue()
    {
        $post=$this->input->post('cat');
        $post = $this->security->xss_clean($post);
        $this->load->view('Template/header-report');
        echo $this->reportmodel->printCatalogue($post);
    }
    public function printMembers()
    {
        $post=$this->input->post('status');
        $post = $this->security->xss_clean($post);
        $this->load->view('Template/header-report');
        echo $this->reportmodel->printMembers($post);
    }
    public function printIdCards()
    {
        $institute=$this->membermodel->instituteDetails('*');
        $id=$this->input->post('id');
        $id = $this->security->xss_clean($id);
        $this->load->view('Template/header-report');
        echo $this->reportmodel->printIdCards($id, $institute);
    }
    public function printStatement()
    {
        $id=$this->input->post('id');
        $id = $this->security->xss_clean($id);
        $member=$this->membermodel->memberCard($id);
        $type=$this->input->post('type');
        $type = $this->security->xss_clean($type);
        $this->load->view('Template/header-report');
        echo $this->reportmodel->printStatement($id, $type, $member);
    }
}
