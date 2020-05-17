<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters("<div class='text-danger' style='font-size:0.7em'>", '</div>');
    }
    function myProducts()
    {
        $products = $this->Ordermodel->products($_SESSION['storeId']);
        $this->load->view('Store/Products', compact('products'));
        $this->load->view('Template/footer');
    }
    function addProduct()
    {
        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        $file_name='';
        if (isset($_POST['articleIdPK'])) {
            $file_name=$post['articleIdPK'];
        }
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 170;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $config['overwrite']     = true;
        $config['file_name']     = $file_name;
        $this->load->library('upload', $config);
        if ($this->form_validation->run('add_article') && $this->upload->do_upload('userfile')) {
            $data = $this->upload->data();
            //$image_path=base_url('uploads/'.$data['raw_name'].$data['file_ext']);
            $image_path='uploads/'.$data['raw_name'].$data['file_ext'];
            $post['image_path']=$image_path;
            if ($this->Ordermodel->addProduct($post)) { //echo "insert successful";
                $this->session->set_flashdata('msg', 'Product added successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Seller/myProducts'));
            } else { //echo "sorry";
                $this->session->set_flashdata('msg', 'Failed to add Product, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Seller/myProducts'));
            }
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('Store/addProduct', $error);
            $this->load->view('Template/footer');
        }
    }
    function modifyImage($id)
    {
        $post=$this->input->post();
        $file_name='';
        if (isset($_POST['articleIdPK'])) {
            $file_name=$post['articleIdPK'];
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
            if ($this->Ordermodel->modifyArticle($id, $post)) {
                //echo "Product updated";
                $this->session->set_flashdata('msg', 'Image modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Seller/card/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Image, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Seller/myProducts'));
            }
        } else {
            $error = $this->upload->display_errors();
            $article=$this->Ordermodel->articleCard($id);
            $this->load->view('Seller/card', compact('article', 'error'));
            $this->load->view('Template/footer');
        }
    }
    function card()
    {
        if ((($this->uri->segment(3))=='') || !ctype_digit($this->uri->segment(3))) {
            redirect(base_url('Seller/myProducts'));
        }
        $id=$this->uri->segment(3); // gets ProductID from URL'
        if ($this->form_validation->run('add_article')==false) {
            $product=$this->Ordermodel->productCard($id);
            $this->load->view('Store/card', compact('product'));
            $this->load->view('Template/footer');
        } else {
            $post=$this->input->post();
            $post = $this->security->xss_clean($post);
            if ($this->Ordermodel->modifyProduct($id, $post)) { //echo "Product updated";
                $this->session->set_flashdata('msg', 'Product modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Seller/card/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Product, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Seller/myProducts'));
            }
        }
    }
    function orders()
    {
        $pendingOrder=$this->Ordermodel->orderPending();
        $this->load->view('Store/orders', compact('pendingOrder'));
        $this->load->view('Template/footer');
    }
    function viewOrder(){
        if ((($this->uri->segment(3))=='') || !ctype_digit($this->uri->segment(3))) {
            redirect(base_url('Seller/orders'));
        }
        $id=$this->uri->segment(3); // gets ProductID from URL'

        $details=$this->Ordermodel->viewOrder($id);
        $this->load->view('Store/viewOrder', compact('details'));
        $this->load->view('Template/footer');
    }
}
