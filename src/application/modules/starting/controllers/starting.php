<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Starting extends MX_Controller 
{
    
    public function __construct() {
        $this->load->module('layout');
        parent::__construct();
    }

    public function index () 
    {
        $this->layout->load()->render();
    }
       
    public function two_columns_left () 
    {
        $this->layout->load()->render();
    }

    public function two_columns_right () 
    {
        $this->layout->load()->render();
    }

}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
