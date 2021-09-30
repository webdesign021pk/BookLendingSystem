<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Members extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters("<div class='text-danger' style='font-size:0.7em'>", '</div>');
        $this->load->model('membermodel');
    }
    public function index()
    {
        $members = $this->membermodel->membersList();
        $this->load->view('Library/members', ['members'=>$members]);
        $this->load->view('Template/footer');
    }
    public function add()
    {
        if ($_SESSION['userLevel']<2) {
            redirect(base_url('Library/Members'));
        }
        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        $file_name='';
        if (isset($_POST['cnic'])) {
            $file_name=$post['cnic'];
        }
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 170;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $config['overwrite']     = true;
        $config['file_name']     = $file_name;
        $this->load->library('upload', $config);
        if ($this->form_validation->run('add_member_rules') && $this->upload->do_upload('userfile')) {
            $data = $this->upload->data();
            //$image_path=base_url('uploads/'.$data['raw_name'].$data['file_ext']);
            $image_path='uploads/'.$data['raw_name'].$data['file_ext'];
            $post['image_path']=$image_path;
            if ($this->membermodel->addMember($post)) { //echo "insert successful";
                $this->session->set_flashdata('msg', 'Member added successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Library/Members'));
            } else { //echo "sorry";
                $this->session->set_flashdata('msg', 'Failed to add Member, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Members'));
            }
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('Library/addMember', $error);
            $this->load->view('Template/footer');
        }
    }
    public function modifyImage($id)
    {
        if ($_SESSION['userLevel']<2) {
            redirect(base_url('Library/Members'));
        }
        $post=$this->input->post();
        $file_name='';
        if (isset($_POST['cnic'])) {
            $file_name=$post['cnic'];
        }
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 170;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $config['overwrite']     = true;
        $config['file_name']     = $file_name;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('userfile')) {
            $data = $this->upload->data();
            //$image_path=base_url('uploads/'.$data['raw_name'].$data['file_ext']);
            $image_path='uploads/'.$data['raw_name'].$data['file_ext'];
            $post['image_path']=$image_path;
            if ($this->membermodel->modifyMember($id, $post)) {
                //echo "member updated";
                $this->session->set_flashdata('msg', 'Image modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Library/Members/card/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Image, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Members'));
            }
        } else {
            $error = $this->upload->display_errors();
            $member=$this->membermodel->memberCard($id);
            $this->load->view('Library/card', compact('member', 'error'));
            $this->load->view('Template/footer');
        }
    }
    public function card()
    {
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Library/Members'));
        }
        $id=$this->uri->segment(4); // gets memberID from URL'
        if ($this->form_validation->run('add_member_rules')==false) {
            $member=$this->membermodel->memberCard($id);
            $institution=$this->membermodel->instituteDetails('monthlyFees');
            $this->load->view('Library/card', compact('member', 'institution'));
            $this->load->view('Template/footer');
        } else {
            $post=$this->input->post();
            $post = $this->security->xss_clean($post);
            if ($this->membermodel->modifyMember($id, $post)) { //echo "member updated";
                $this->session->set_flashdata('msg', 'Member modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Library/Members/card/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Members'));
            }
        }
    }
    public function checkout($id)
    {
        $payFine=$this->membermodel->payDues($id);
        $fineDue=$this->membermodel->fineDue($id);
        $issuedBooks=$this->membermodel->fetchIssuedBooks($id);
        $member=$this->membermodel->memberCard($id);
        $instituteDetails=$this->membermodel->instituteDetails('dueDays');
        $this->load->view('Library/checkout', compact('member', 'issuedBooks', 'instituteDetails', 'fineDue', 'payFine'));
        $this->load->view('Template/footer');
    }
}
