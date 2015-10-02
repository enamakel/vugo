<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Referral extends CI_Controller {
    
    protected $_data = array('controller'=>'referral');
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            return redirect('admin/home');
        }
        $this->load->model('admin/referrals','referral');
    }
    
    protected function _initPager() {
        $this->_pagerConfig['per_page'] = 25;
        $this->_pagerConfig['base_url'] = site_url('admin/referral/page');               
        $this->_pagerConfig['total_rows'] = $this->referral->countTableRows();            
        parent::_initPager();
    }

    public function index() 
    {
        $this->_initPager();
        $this->_data['referrals'] = $this->referral->getReferralList($this->_pagerConfig['per_page']);     
        return $this->load->view('admin/vwReferralGrid',$this->_data);
    }
    
    public function page() 
    {    
        $this->_initPager();
        $offset = $this->_data['page']*$this->_pagerConfig['per_page']-$this->_pagerConfig['per_page'];
        if($offset<0) $offset = 0;
        $this->_data['referrals'] = $this->referral->getReferralList($this->_pagerConfig['per_page'],$offset);     
        return $this->load->view('admin/vwReferralGrid',$this->_data);
    }

    public function add() 
    {
        $this->_data['referral'] = $this->referral->load(false);
        $this->load->view('admin/vwReferralEdit',$this->_data);
    }
    
    public function edit($id=false) 
    {
        if(!$id){
            return redirect('admin/referral');
        }
        $this->_data['referral'] = $this->referral->load($id);
        $this->load->view('admin/vwReferralEdit',$this->_data);
    }
   
    public function save() 
    {
        $this->_data = $this->input->post();
        $this->form_validation->set_rules('code', 'Referral Code', 'required');
        if ($this->form_validation->run() != FALSE) {
            $this->_data = $this->referral->setData($this->_data)->save();
            $this->addSuccess('Code was successfully saved');
            return redirect('admin/referral');
        } else {
            $errors = $this->form_validation->error_string();
            $referral = $this->referral->load($this->_data['referral_id']);
            $this->_data['page']='referral';
            return $this->load->view('admin/vwReferralEdit', array('data'=>$this->_data,'referral'=>$referral,'errors'=>$errors));
        }
    }
    
    public function delete($id=false) 
    {
         if(!$id){
            $this->addError('Code id is undefined');
            return redirect('admin/referral');
        }
        try {
            $this->referral->load($id)->delete();
            $this->addSuccess('Referral code successfully deleted');
        } catch (Exception $e) {
            $this->addError($e->getMessage());
        }   
        return redirect('admin/referral');
    }
    
    public function details() {
        $id = $this->uri->segment(4);
        if(!$id){
            return redirect('admin/referral');
        }
        $this->_data['referral'] = $this->referral->load($id);
        $this->load->view('admin/vwReferralDetails',$this->_data);
    }
}