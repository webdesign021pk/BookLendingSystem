<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Books extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bookmodel');
        $this->form_validation->set_error_delimiters("<div class='text-danger' style='font-size:0.7em'>", '</div>');
    }
    public function index()
    {
        $books = $this->bookmodel->booksList();
        $this->load->view('Library/books', ['books'=>$books]);
        $this->load->view('Template/footer');
    }
    public function cover()
    {
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Library/Books'));
        }
        $id=$this->uri->segment(4); // gets 'bookID from URL'
        $bookCategory=$this->bookmodel->bookCategory('*');
        $bookLanguage=$this->bookmodel->bookLanguage();

        if ($this->form_validation->run('modifyBook')==false) {
            $book=$this->bookmodel->bookCard($id);
            $this->load->view('Library/cover', compact('book', 'bookCategory', 'bookLanguage'));
            $this->load->view('Template/footer');
        } else {
            $post=$this->input->post();
            $post = $this->security->xss_clean($post);
            if ($this->bookmodel->bookModify($id, $post)) {
                $this->session->set_flashdata('msg', 'Book modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Library/Books/cover/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Book, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Books'));
            }
        }
    }
    public function add()
    {
        if ($_SESSION['userLevel']<2) {
            redirect(base_url().'Library/Books');
        }
        $bookCategory=$this->bookmodel->bookCategory('*');
        $bookLanguage=$this->bookmodel->bookLanguage();
        if ($this->form_validation->run('modifyBook')==false) {
            $this->load->view('Library/addBook', compact('bookCategory', 'bookLanguage'));
            $this->load->view('Template/footer');
        } else {
            $post=$this->input->post();
            $post = $this->security->xss_clean($post);
            if ($this->bookmodel->addBook($post)) {
                $this->session->set_flashdata('msg', 'New book added successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Library/Books'));
            } else {
                $this->session->set_flashdata('msg', 'Failed to Add Book, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Books'));
            }
        }
    }
    public function fetchSubCat()
    {
        if ($this->input->post('cat_id')) {
            echo $this->bookmodel->subCat($this->input->post('cat_id'));
        }
    }
}
