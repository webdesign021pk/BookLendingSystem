<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters("<div class='text-danger' style='font-size:0.7em'>", '</div>');
        $this->load->view('Template/header');
    }
    function index($id)
    {
        $storeName = $this->Ordermodel->storeName($id);
        $products = $this->Ordermodel->products($id);
        $this->load->view('Store/all', compact('products', 'storeName'));
        $this->load->view('Template/footer');
    }
    /*function view(){
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Catalogue/Products'));
        }
        $id=$this->uri->segment(4); // gets memberID from URL'

        $article=$this->Ordermodel->articleCard($id);
        $this->load->view('Catalogue/productView', compact('article'));
        $this->load->view('Template/footer');
    }*/

    /*Catalogue Details*/
    function newOrder(){
        $id=$this->uri->segment(3);
        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        if ($this->form_validation->run('add_order')) {
            $orderId=$this->Ordermodel->newOrder($post);
        if ($orderId) { //echo "insert successful";
            $orderDetails=$this->Ordermodel->viewOrder($orderId);

            $this->session->set_flashdata('details', $orderDetails);
            redirect(base_url('Catalogue/Products/viewOrder'));

        } else { //echo "sorry";
            $this->session->set_flashdata('msg', 'Failed to add Member, Contact Administrator!!');
            $this->session->set_flashdata('alert', 'danger');
            echo "Unable to process order, Please contact us on our Facebook page to place your order. ";
        }
    } else {
            $article=$this->Ordermodel->productCard($id);
            $this->load->view('Store/newOrder', compact('article'));
            $this->load->view('Template/footer');
    }

    }
    function viewOrder(){
        if (isset($_POST['orderId'])){
            $post=$this->input->post();
            $post = $this->security->xss_clean($post);
            $details=$this->Ordermodel->viewOrder($post['orderId']);
        } else {
            $details=0;
        }
        $this->load->view('Catalogue/viewOrder', compact('details'));
        $this->load->view('Template/footer');
    }
}
