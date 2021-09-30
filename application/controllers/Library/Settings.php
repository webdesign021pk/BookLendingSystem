<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bookmodel');
        $this->load->model('membermodel');
        $this->load->model('loginmodel');
        $this->form_validation->set_error_delimiters("<div class='text-danger' style='font-size:0.7em'>", '</div>');
    }
    public function category()
    {
        $category=$this->bookmodel->bookCategory('*');
        $catOnly=$this->bookmodel->bookCategory('category');
        $this->load->view('Library/category', ['category'=>$category, 'catOnly'=>$catOnly]);
        $this->load->view('Template/footer');
    }
    public function language()
    {
        $language=$this->bookmodel->languages();
        $this->load->view('Library/language', ['language'=>$language]);
        $this->load->view('Template/footer');
    }
    public function institute()
    {
        $id='1';
        if ($this->form_validation->run('modify_institute_rules')==false) {
            $institute=$this->membermodel->instituteDetails('*');
            $this->load->view('Library/institute', ['institute'=>$institute]);
            $this->load->view('Template/footer');
        } else {
            $post=$this->input->post();
            $post = $this->security->xss_clean($post);
            if ($this->membermodel->modifyInstitute($id, $post)) {
                $this->session->set_flashdata('msg', 'Institute modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Library/Settings/institute'));
            } else { //echo "Error in institute update";
                $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Settings/institute'));
            }
        }
    }
    public function modifyInstituteImage()
    {
        $id='1';
        if ($_SESSION['userLevel']<2) {
            redirect(base_url('Library/Settings/institute'));
        }
        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        $file_name='';
        if (isset($_POST['institutionIdPK'])) {
            $file_name=$post['institutionIdPK'];
        }
        $config['upload_path']   = './uploads/institute/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 100;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $config['overwrite']     = true;
        $config['file_name']     = $file_name;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('userfile')) {
            $data = $this->upload->data();
            //$image_path=base_url('uploads/institute/'.$data['raw_name'].$data['file_ext']);
            $image_path='uploads/institute/'.$data['raw_name'].$data['file_ext'];
            $post['image_path']=$image_path;
            if ($this->membermodel->modifyInstitute($id, $post)) { //echo "member updated";
                $this->session->set_flashdata('msg', 'Institute Logo modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Library/Settings/institute'));
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Institute Logo, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Settings/institute'));
            }
        } else {
            $imageError = $this->upload->display_errors();
            $institute=$this->membermodel->instituteDetails('*');
            $this->load->view('Library/institute', compact('institute', 'imageError'));
            $this->load->view('Template/footer');
        }
    }
    public function users()
    {
        if ($_SESSION['userLevel']<3) {
            redirect(base_url());
        }
        $userList=$this->loginmodel->userList();
        $this->load->view('Library/users', ['userList'=>$userList]);
        $this->load->view('Template/footer');
    }
    public function profile()
    {
        $id=$this->session->userdata('userIdPK');
        $user=$this->loginmodel->userProfile($id);
        if (empty($_POST)) {
            $this->load->view('Users/profile', ['user'=>$user]);
            $this->load->view('Template/footer');
        }
        if (isset($_POST['userEmail'])) {
            if ($this->form_validation->run('profile_email_rule')==false) {
                $this->load->view('Users/profile', ['user'=>$user]);
                $this->load->view('Template/footer');
            } else {
                $post = $this->input->post();
                $post = $this->security->xss_clean($post);
                if ($this->loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Member modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Library/Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Library/Settings/profile'));
                }
            }
        }
        if (isset($_POST['userName'])) {
            if ($this->form_validation->run('profile_userName_rule')==false) {
                $this->load->view('Users/profile', ['user'=>$user]);
                $this->load->view('Template/footer');
            } else {
                $post=$this->input->post();
                $post = $this->security->xss_clean($post);
                if ($this->loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Member modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Library/Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Library/Settings/profile'));
                }
            }
        }
        if (isset($_POST['others'])) {
            if ($this->form_validation->run('profile_fields_rule')==false) {
                $user=$this->loginmodel->userProfile($id);
                $this->load->view('Users/profile', ['user'=>$user]);
                $this->load->view('Template/footer');
            } else {
                $post=$this->input->post();
                $post = $this->security->xss_clean($post);
                unset($post['others']);
                if ($this->loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Member modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Library/Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify Member, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Library/Settings/profile'));
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
            $this->load->view('Users/profile', ['user'=>$user]);
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
                    redirect(base_url('Library/Settings/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify password, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Library/Settings/profile'));
                }
            } else { //echo 'no match';
                $this->session->set_flashdata('msg', 'Incorrect Old Password !!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Library/Settings/profile'));
            }
        }
    }
}
