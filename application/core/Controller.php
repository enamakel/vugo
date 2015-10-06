<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Controller {

    private static $instance;
    protected $_pagerConfig = array();
    protected $_data = array('controller'=>'name');
    
    /**
     * Constructor
     */
    public function __construct()
    {
        self::$instance =& $this;
        foreach (is_loaded() as $var => $class) {
            $this->$var =& load_class($class);
        }
        $this->load =& load_class('Loader', 'core');
        $this->load->initialize();
        log_message('debug', "Controller Class Initialized");
    }

    public static function &get_instance()
    {
        return self::$instance;
    }


    protected function _initPager() 
    {
        $this->load->library('pagination');
        
        //pagination settings
        
        //$this->_pagerConfig['base_url'] =  site_url('admin/model/page');                  # NEED DEFINE IN CONTROLLER
        //$this->_pagerConfig['total_rows'] = $this->model->countTableRows();               # NEED DEFINE IN CONTROLLER
        if(!isset($this->_pagerConfig['per_page'])) {
            $this->_pagerConfig['per_page'] = 50;                                           # CAN DEFINE IN CONTROLLER
        }
        if(!isset($this->_pagerConfig["uri_segment"])) {
            $this->_pagerConfig["uri_segment"] = 4;                                         # CAN DEFINE IN CONTROLLER
        }
        $choice = $this->_pagerConfig["total_rows"] / $this->_pagerConfig["per_page"];
        $this->_pagerConfig["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $this->_pagerConfig['full_tag_open'] = '<ul class="pagination">';
        $this->_pagerConfig['full_tag_close'] = '</ul>';
        $this->_pagerConfig['first_link'] = false;
        $this->_pagerConfig['last_link'] = false;
        $this->_pagerConfig['use_page_numbers'] = true;
        $this->_pagerConfig['first_tag_open'] = '<li>';
        $this->_pagerConfig['first_tag_close'] = '</li>';
        $this->_pagerConfig['prev_link'] = '&laquo';
        $this->_pagerConfig['prev_tag_open'] = '<li class="prev">';
        $this->_pagerConfig['prev_tag_close'] = '</li>';
        $this->_pagerConfig['next_link'] = '&raquo';
        $this->_pagerConfig['next_tag_open'] = '<li>';
        $this->_pagerConfig['next_tag_close'] = '</li>';
        $this->_pagerConfig['last_tag_open'] = '<li>';
        $this->_pagerConfig['last_tag_close'] = '</li>';
        $this->_pagerConfig['cur_tag_open'] = '<li class="active"><a href="#">';
        $this->_pagerConfig['cur_tag_close'] = '</a></li>';
        $this->_pagerConfig['num_tag_open'] = '<li>';
        $this->_pagerConfig['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($this->_pagerConfig);
        
        $this->_data['page'] = ($this->uri->segment($this->_pagerConfig["uri_segment"])) ? $this->uri->segment($this->_pagerConfig["uri_segment"]) : 0;
        $this->_data['pagination'] = $this->pagination->create_links();
    }
    
    /**
     * Add global messages for curent user
     * 
     * @param string $message
     * @param string $type
     * @return \CI_Controller
     */
    private function _addMessage($message = '', $type = 'success')
    {
        if(trim($message)=='') {
            return $this;
        }
        $this->session->addMessage($message,$type);
     
        return $this;
    }
    
    /**
     * Add success message
     * 
     * @param string $message
     * @return \CI_Controller
     */
    public function addSuccess($message) 
    {
      
        return self::_addMessage($message, 'success');
    }
    
    /**
     * Add info message
     * 
     * @param string $message
     * @return \CI_Controller
     */
    public function addInfo($message) 
    {
        return $this->_addMessage($message, 'info');
    }
    
    /**
     * Add error message
     * 
     * @param string $message
     * @return \CI_Controller
     */
    public function addError($message) 
    {
        return $this->_addMessage($message, 'danger');
    }
    
    /**
     * Add error message
     * 
     * @param string $message
     * @return \CI_Controller
     */
    public function addWarning($message) 
    {
        return $this->_addMessage($message, 'warning');
    }
    
}