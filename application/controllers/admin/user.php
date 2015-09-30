<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
protected $_data = array('controller'=>'user');
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            return redirect('admin/home');
        }
        $this->load->model('admin/users','user');
    }
    
    protected function _initPager() {
        $this->_pagerConfig['per_page'] = 25;
        $this->_pagerConfig['base_url'] = site_url('admin/user/page');               
        $this->_pagerConfig['total_rows'] = $this->user->countTableRows();            
        parent::_initPager();
    }

    public function index() 
    {
        $this->_initPager();
        $this->_data['users'] = $this->user->getReferralList($this->_pagerConfig['per_page']);     
        return $this->load->view('admin/vwUserGrid',$this->_data);
    }
    
    public function page() 
    {    
        $this->_initPager();
        $offset = $this->_data['page']*$this->_pagerConfig['per_page']-$this->_pagerConfig['per_page'];
        if($offset<0) $offset = 0;
        $this->_data['users'] = $this->user->getReferralList($this->_pagerConfig['per_page'],$offset);     
        return $this->load->view('admin/vwUserGrid',$this->_data);
    }

    public function add() 
    {
        $this->_data['user'] = $this->user->load(false);
        $this->load->view('admin/vwUserEdit',$this->_data);
    }
    
    public function edit($id=false) 
    {
        if(!$id){
            return redirect('admin/user');
        }
        $this->_data['user'] = $this->user->load($id);
        $this->load->view('admin/vwUserEdit',$this->_data);
    }
   
    private function _prepareData() 
    {
        if(!isset($this->_data['password']) || !$this->_data['password']) {
            $this->_data['password'] = $this->_data['form_id'];
        } else {
            $this->_data['password'](md5($this->_data['password']));
        }
        
        $this->_data['phone_number'] = $this->_data['country'].' '.$this->_data['phone_number'];
        unset($this->_data['phone_code']);
        return $this;
    }

    public function save() 
    {
        $this->_data = $this->input->post(null,true);
        $this->_prepareData();
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('phone_number', 'Phone Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() != FALSE) {
            unset($this->_data['form_id']);
            $this->_data = $this->user->setData($this->_data)->save();
            $this->addSuccess('User successfully saved');
            return redirect('admin/user');
        } else {
            $this->form_validation->set_error_delimiters('','|');
            $errors = $this->form_validation->error_string();
            foreach (explode('|', $errors) as $error) {
                $this->addError($error);
            }
            $user = $this->user->load($this->_data['user_id']);
            $this->_data['page']='user';
            return $this->load->view('admin/vwUserEdit', array('data'=>$this->_data,'user'=>$user));
        }
    }
    
    public function details() {
        $id = $this->uri->segment(4);
        if(!$id){
            return redirect('admin/user');
        }
        $this->_data['user'] = $this->user->load($id);
        $this->load->view('admin/vwReferralDetails',$this->_data);
    }
}