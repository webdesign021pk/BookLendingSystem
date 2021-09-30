<?php
//defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Loginmodel');
        $this->load->model('Bookmodel');
        $this->load->model('Membermodel');
    }
    public function index()
    {
        $booksIssued=$this->Bookmodel->totalIssued();
        $fineDue=$this->Membermodel->fineDue('*');
        $overDueBooks=$this->Membermodel->overDueBooks();
        $totalMembers=$this->Membermodel->totalMembers();
        $totalBooks=$this->Bookmodel->totalBooks();
        $this->load->view('Library/dashboard', compact('booksIssued', 'fineDue', 'totalMembers', 'totalBooks', 'overDueBooks'));
        $this->load->view('Template/footer');
    }
}
