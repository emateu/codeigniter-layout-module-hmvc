<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * By Emiliano Mateu - mateuemiliano@gmail.com
 * 
 * TODO:
 *  - get_skin_url() [helper]
 *  - better <title> management => prefix, suffix
 *  - nested blocks via xml?
 *  - javascript and css unification (1 request)
 *  - write more doc if people like the project
 *  - better code doc
 *  - what else?
 */

class Layout extends MX_Controller {
    
    private $skin;
    private $layout;
    private $page_title;
    private $body_class;
    private $js_files;
    private $css_files;
    private $block;

    function __construct () {
        $this->load->helper('url');
        $this->skin = 'default';
        $this->js_files = array();
        $this->css_files = array();
        $this->body_class = array();
        $this->block = array();
        parent::__construct();
    }
    
    /*
     * Set skin
     */
    public function skin ($name) {
        $this->skin = $name;
        return $this;
    }
    
    /*
     * Get skin
     */
    public function get_skin () {
        return $this->skin;
    }
    
    /*
     * Set title
     */
    public function title ($title) {
        $this->page_title = $title;
        return $this;
    }
    
    /*
     * Load title
     */
    private function load_title () {
        //return ($this->page_title) ? $this->page_title." - ".$this->conf['title'] : $this->conf['title'];
        return $this->page_title;
    }
    
    /*
     * Add javascript file to queue
     */
    public function js ($file, $remove = false) {
        if ($remove) {
            if (is_array($file)) {
                foreach ($file as $k=>$v) {
                    unset($this->js_files[$v]);
                }
            } else {
                unset($this->js_files[$file]);
            }
        } else {
            if (is_array($file)) {
                foreach ($file as $k=>$v) {
                    $this->js_files = array_merge($this->js_files, array($v => $v));
                }
            } else {
                $this->js_files = array_merge($this->js_files, array($file => $file));
            }
        }
        return $this;
    } 
    
    /*
     * Generate html code from javascript queue
     */
    private function load_js () {
        $buffer = '';
        if (count($this->js_files)) {
            foreach ($this->js_files as $file) {
                $file = explode('/', $file);
                // TODO: use $this->config->item('modules_locations') for modules path
                $file = 'application/modules/'.$file[0].'/views/'.$this->get_skin().'/skin/'.implode('/',array_slice($file, 1));
                $buffer .= "\n".'<script src="'.base_url($file).'"></script>';
            }
            return $buffer."\n";
        } else {
            return "\n";
        }
    }    
    
    /*
     * Add css file to queue
     */
    public function css ($file, $remove = false) {
        if ($remove) {
            if (is_array($file)) {
                foreach ($file as $k=>$v) {
                    unset($this->css_files[$v]);
                }
            } else {
                unset($this->css_files[$file]);
            }
        } else {
            if (is_array($file)) {
                foreach ($file as $k=>$v) {
                    $this->css_files = array_merge($this->css_files, array($v => $v));
                }
            } else {
                $this->css_files = array_merge($this->css_files, array($file => $file));
            }
        }
        return $this;
    }    
    
    /*
     * Generate html code from css queue
     */
    private function load_css () {
        $buffer = '';
        if (count($this->css_files)) {
            foreach ($this->css_files as $file) {
                $file = explode('/', $file);
                // TODO: use $this->config->item('modules_locations') for modules path
                $file = 'application/modules/'.$file[0].'/views/'.$this->get_skin().'/skin/'.implode('/',array_slice($file, 1));
                $buffer .= "\n".'<link rel="stylesheet" href="'.base_url($file).'">';
            }
            return $buffer."\n";
        } else {
            return "\n";
        }
    }
    
    /*
     * Add css class to body class queue
     */
    public function body_class ($class) {
        if (is_array($class)) {
            foreach ($class as $k=>$v) {
                $this->body_class = array_merge($this->body_class, array($v => $v));
            }
        } else {
            $this->body_class = array_merge($this->body_class, array($class => $class));   
        }
        return $this;
    }
    
    /*
     * Generate css class string from the body class queue
     */
    private function load_body_class () {
        $buffer = "";
        $segments = $this->uri->segment_array();
        $segments_qty = count($segments);
        
        if ($segments_qty > 0) {
        
            for ($i = 1; $i <= $segments_qty; $i++ ) {
                for ($k = 1; $k <= $i; $k++) {
                    $buffer .= $segments[$k].'-';
                }
                $buffer = substr($buffer, 0, -1).' ';
            }
            $buffer = substr($buffer, 0, -1);
        
        } else {
            $buffer = explode('/', $this->router->routes['default_controller']);
            $buffer = 'home '.$buffer[0];
        }
        
        if (count($this->body_class)) {
            foreach ($this->body_class as $class) {
                $buffer .= " $class";
            }
        }
        
        return $buffer;
    }
    
    /*
     * Load Block
     */
    public function block ($path, $block_data = '') {
        return $this->load->view( $this->template_path($path), $block_data, true);
    }
    
    /*
     * Generate de template path
     */
    private function template_path ($path) {
        $path = explode('/', $path);
        $path[0] .= '/'.$this->get_skin().'/design';
        return implode('/',$path);
    }
    
    /*
     * Set blocks
     */
    public function set ($key, $path, $block_data = '') {
        $this->block[$key][$path] = $this->block($path, $block_data);
        return $this;
    }
    
    /*
     * Remove blocks
     */
    public function remove ($key, $path) {
        unset($this->block[$key][$path]);
        return $this;
    }
    
    /*
     * Get blocks
     */
    public function get ($key) {
        if (isset($this->block[$key])) {
            foreach ($this->block[$key] as $block) {
                echo $block;
            }
        }
        return $this;
    }
    
    /*
     * Set page layout
     */
    public function layout ($path) {
        $this->layout = $path;
        return $this;
    }
    
    /*
     * Load layout config
     */
    public function load ($module = null, $filename = null) {
        
        if ($module === null) {
            $module = $this->uri->segment(1);
            if ($module === false) {
                $module = explode('/', $this->router->routes['default_controller']);
                $module = $module[0];
            }
        }
        
        $layout = array(
            // TODO: use $this->config->item('modules_locations') for modules path
            simplexml_load_file(APPPATH.'modules/layout/views/'.$this->get_skin().'/layout/default.xml'),
            simplexml_load_file(APPPATH.'modules/'.$module.'/views/'.$this->get_skin().'/layout/default.xml')
        );
        
        if ($filename === null) {
            $filename = $this->router->fetch_class();
        }
        $layout[] = simplexml_load_file(APPPATH.'modules/'.$module.'/views/'.$this->get_skin().'/layout/'.$filename.'.xml');

        foreach ($layout as $xml) {
            
            foreach ($xml->children() as $k=>$xml) {
                
                if ( (string)$k === 'default' || (string)$k === $this->router->fetch_method() ) {
                    if ($xml['template'] != '') {
                        $this->layout($xml['template']);
                    }

                    if (isset($xml->head->css)) {
                        foreach ($xml->head->css as $node) {
                            if ((string)$node['action'] === 'unset') {
                                $this->css((string)$node, true);
                            } else {
                                $this->css((string)$node);
                            }
                        }
                    }
                    if (isset($xml->head->js)) {
                        foreach ($xml->head->js as $node) {
                            if ((string)$node['action'] === 'unset') {
                                $this->js((string)$node, true);
                            } else {
                                $this->js((string)$node);
                            }
                        }
                    }
                    if (isset($xml->head->title)) {
                        foreach ($xml->head->title as $node) {
                            $this->title((string)$node);
                        }
                    }

                    if (isset($xml->body)) {
                        $body_class = (string)$xml->body['class'];
                        if ($body_class !== '') {
                            $this->body_class($body_class);
                        }
                        foreach ($xml->body->children() as $key=>$value) {
                            foreach ($value as $blockKey=>$blockValue) {
                                if ((string)$blockKey === 'remove') {
                                    $this->remove((string)$key, (string) $blockValue['template']);   
                                } else {
                                    $this->set((string)$key, (string) $blockValue['template']);   
                                }
                            }
                        }
                    }
                }
            }
        }        
        return $this;
    }

    /*
     * Render page layout
     */
    public function render () {      
        $this->load->view( $this->template_path($this->layout) , array(
            'page_title' => $this->load_title(),
            'js_files' => $this->load_js(),
            'css_files' => $this->load_css(),
            'body_class' => $this->load_body_class()
        ));
        return $this;
    }
    
    /*
     * No accessible via HTTP
     */
    public function _remap () {
        show_404();
    }
    
}