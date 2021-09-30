<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
    /*With out header/UI other functions*/
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bookmodel');
        $this->load->model('membermodel');
        $this->load->model('loginmodel');
    }
    public function checkoutTable()
    {
        $book=$this->input->post('bookId');
        $book = $this->security->xss_clean($book);
        $duedays=$this->input->post('dueDays');
        if ($book) {
            echo $this->bookmodel->fetchBookCheckout($book, $duedays);
        }
    }
    public function checkIn2()
    {
        if (!$this->input->is_ajax_request()) {
            exit('no valid req.');
        }
        $book=$this->input->post('bookNumber');
        if ($this->form_validation->run('checkIn')==false) { //echo $book;
            echo '<div class="alert-danger rounded p-1">'.validation_errors().'</div>';
        } else {
            if ($book) {
                $msg1=$this->bookmodel->checkIn($book);
                echo '<div class="alert-success rounded p-1">';
                echo $msg1;
                echo '</div>';
            }
        }
    }
    public function checkOut()
    {
        $book=$this->input->post();
        $book = $this->security->xss_clean($book);
        if ($book) {
            $this->bookmodel->checkOut($book);
            redirect(base_url('Library/Members/checkout/').$book['memberId']);
        }
    }
    public function textRegex($str)
    {
        if (!preg_match('/^[a-z .,\-]+$/i', $str)&& $str!= "") {
            return false;
        }
    }
    public function addCategory()
    {
        if (!$this->input->is_ajax_request()) {
            exit('no valid req.');
        }
        $book=$this->input->post();
        $book = $this->security->xss_clean($book);
        $this->form_validation->set_message('textRegex', 'Only alphabets and commas are allowed');
        if ($this->form_validation->run('newBookCategory')==false) {
            echo '<div class="alert-danger rounded p-1">'.validation_errors().'</div>';
        } else {
            if ($book) {
                $this->bookmodel->addCategory($book);
                echo '1';
            }
        }
    }
    public function modifyCategory()
    {
        $id = $this->input->post('id');
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        // Update records
        $this->bookmodel->modifyCategory($id, $field, $value);
        echo 1;
        exit;
    }
    public function addLanguage()
    {
        if (!$this->input->is_ajax_request()) {
            exit('no valid req.');
        }
        $book=$this->input->post();
        $book = $this->security->xss_clean($book);
        if ($this->form_validation->run('newBookLanguage')==false) { //echo $book;
            echo '<div class="alert-danger rounded p-1">'.validation_errors().'</div>';
        } else {
            if ($book) {
                $this->bookmodel->addLanguage($book);
                echo '1';
            }
        }
    }
    public function modifyLanguage()
    {
        $id = $this->input->post('id');
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        // Update records
        $this->bookmodel->modifyLanguage($id, $field, $value);
        echo 1;
        exit;
    }
    public function modifyUser()
    {
        $id = $this->input->post('id');
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        // Update records
        $this->loginmodel->modifyUser($id, $field, $value);
        echo 1;
        exit;
    }
    public function getDues($id)
    {
        echo $this->membermodel->getDues($id);
    }
    public function payFine($memID)
    {
        $dues=$this->input->post();
        $dues = $this->security->xss_clean($dues);
        if ($dues) {
            $this->membermodel->payFine($dues, $memID);
            redirect(base_url('Library/Members/checkout/'.$memID));
        }
    }
    public function payMonthlyFees($memID)
    {
        $details=$this->input->post();
        $details = $this->security->xss_clean($details);
        if ($details) {
            $this->membermodel->payMonthlyFees($details, $memID);
            $this->session->set_flashdata('msg', 'Fees Paid successfully!');
            $this->session->set_flashdata('alert', 'success');
            redirect(base_url('Library/Members/card/'.$memID));
        }
    }
}
