<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campaign extends CI_Controller {
protected $_data = array('controller'=>'campaign');
    
    public function __construct() 
    {
     parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            return redirect('admin/home');
        }
        $this->load->model('admin/campaigns','campaign');
    }
    
    protected function _initPager() {
        $this->_pagerConfig['per_page'] = 25;
        $this->_pagerConfig['base_url'] = site_url('admin/campaign/page');               
        $this->_pagerConfig['total_rows'] = $this->campaign->countTableRows();            
        parent::_initPager();
    }
    
    private function _prepareData() 
    {
    }
    
    public function index() 
    {
        $this->_initPager();
        $this->_data['campaigns'] = $this->campaign->getCampaignList($this->_pagerConfig['per_page']);     
        return $this->load->view('admin/vwCampaignGrid',$this->_data);
    }
    
    public function page() 
    {    
        $this->_initPager();
        $offset = $this->_data['page']*$this->_pagerConfig['per_page']-$this->_pagerConfig['per_page'];
        if($offset<0) $offset = 0;
        $this->_data['users'] = $this->campaign->getReferralList($this->_pagerConfig['per_page'],$offset);     
        return $this->load->view('admin/vwCampaignGrid',$this->_data);
    }

    public function add() 
    {
        $this->_data['user'] = $this->campaign->load(false);
        $this->load->view('admin/vwCampaignEdit',$this->_data);
    }
    
    public function edit($id=false) 
    {
        if(!$id){
            return redirect('admin/campaign');
        }
        $this->_data['user'] = $this->campaign->load($id);
        $this->load->view('admin/vwCampaignEdit',$this->_data);
    }
    
    public function delete($id=false) {
         if(!$id){
            $this->addError('User id is undefined');
            return redirect('admin/campaign');
        }
        try {
            $this->campaign->load($id)->delete();
            $this->addSuccess('User successfully deleted');
        } catch (Exception $e) {
            $this->addError($e->getMessage());
        }   
        return redirect('admin/campaign');
    }

    public function save() 
    {
        $this->_data = $this->input->post(null,true);
        $this->_prepareData();
        
//        $this->form_validation->set_rules('username', 'Username', 'required');
//        $this->form_validation->set_rules('first_name', 'First Name', 'required');
//        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
//        $this->form_validation->set_rules('country', 'Country', 'required');
//        $this->form_validation->set_rules('phone_number', 'Phone Name', 'required');
//        $this->form_validation->set_rules('email', 'Email', 'required');
//        $this->form_validation->set_rules('username', 'Username', 'required');
        if ($this->form_validation->run() != FALSE) {
            unset($this->_data['form_id']);
            try {
                $this->_data = $this->campaign->setData($this->_data)->save();
                $this->addSuccess('Campaign successfully saved');
            } catch (Exception $e) {
                $this->addError($e->getMessage());
            }   
            return redirect('admin/campaign');
        } else {
            $this->form_validation->set_error_delimiters('','|');
            $errors = $this->form_validation->error_string();
            foreach (explode('|', $errors) as $error) {
                $this->addError($error);
            }
            $user = $this->user->load($this->_data['campaign_id']);
            $this->_data['page']='campaign';
            return $this->load->view('admin/vwCampaignEdit', array('data'=>$this->_data,'user'=>$user));
        }
    }
}