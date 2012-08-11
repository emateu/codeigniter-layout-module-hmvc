<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Doc extends MX_Controller 
{
    
    public function __construct() {
        $this->load->module('layout');
        parent::__construct();
    }
    
    public function index () 
    {
        $this->layout->load()->render();
    }
    
    public function filesystem () 
    {
        $this->layout->load()->render();
    }
    
    public function methods () 
    {
        $this->layout->load()->render();
    }

    public function load_method_xml_files () 
    {
       $this->layout->load()->render();
    }
    
    public function features () 
    {
        $this->layout->load()->render();
    }

}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
