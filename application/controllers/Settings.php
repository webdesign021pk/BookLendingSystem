<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->form_validation->set_error_delimiters("<div class='text-danger' style='font-size:0.7em'>", '</div>');
    }

    public function users()
    {
        if ($_SESSION['userLevel']<3) {
            redirect(base_url());
        }
        $userList=$this->loginmodel->userList();
        $this->load->view('users', compact('userList'));
        $this->load->view('Template/footer');
    }
    public function profile()
    {
        $id=$this->session->userdata('userIdPK');
        $user=$this->loginmodel->userProfile($id);
        if (empty($_POST)) {
            $this->load->view('Users/profile', compact('user'));
            $this->load->view('Template/footer');
        }
        if (isset($_POST['userEmail'])) {
            if ($this->form_validation->run('profile_email_rule')==false) {
                $this->load->view('Users/profile',compact('user'));
                $this->load->view('Template/footer');
            } else {
                $post = $this->input->post();
                $post = $this->security->xss_clean($post);
                if ($this->loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Member modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Settings/profile'));
                }
            }
        }
        if (isset($_POST['userName'])) {
            if ($this->form_validation->run('profile_userName_rule')==false) {
                $this->load->view('Users/profile',compact('user'));
                $this->load->view('Template/footer');
            } else {
                $post=$this->input->post();
                $post = $this->security->xss_clean($post);
                if ($this->loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Member modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Settings/profile'));
                }
            }
        }
        if (isset($_POST['others'])) {
            if ($this->form_validation->run('profile_fields_rule')==false) {
                $user=$this->loginmodel->userProfile($id);
                $this->load->view('Users/profile', compact('user'));
                $this->load->view('Template/footer');
            } else {
                $post=$this->input->post();
                $post = $this->security->xss_clean($post);
                unset($post['others']);
                if ($this->loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Member modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Settings/profile'));
                }
            }
        }
    }
    public function modifyPass()
    {
        $id=$this->session->userdata('userIdPK');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[3]');
        $this->form_validation->set_rules('confirm_pass', 'confirm_pass', 'required|matches[password]');
        if ($this->form_validation->run()==false) {
            $user=$this->loginmodel->userProfile($id);
            $this->load->view('Users/profile', compact('user'));
            $this->load->view('Template/footer');
        } else {
            $userName=$this->input->post('userName');
            $password=$this->input->post('oldpwd');
            $match=$this->loginmodel->isValidate($userName, $password);
            if ($match) {
                $post=$this->input->post();
                $post = $this->security->xss_clean($post);
                $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
                unset($post['oldpwd'], $post['userName'], $post['confirm_pass']);
                if ($this->loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Password modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify password, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Settings/profile'));
                }
            } else { //echo 'no match';
                $this->session->set_flashdata('msg', 'Incorrect Old Password !!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Settings/profile'));
            }
        }
    }
}
