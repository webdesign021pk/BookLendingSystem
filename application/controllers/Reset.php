<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset extends CI_Controller {
    public function index($code)
    {
        if($code=='5fmjDRS6mF'){
            $this->load->model('Reset_demo');
            echo $this->Reset_demo->reset();
        } else {
            echo "code wrong";
        }
    }
}