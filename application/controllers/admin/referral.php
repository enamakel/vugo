<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Referral extends CI_Controller {
    
    private $_pagerConfig = array();
    private $_data = array('page'=>'referral');
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            return redirect('admin/home');
        }
        $this->load->model('admin/referrals','referral');
    }
    
    private function _initPager() {
        $this->load->library('pagination');
        
        //pagination settings
        $config['base_url'] = site_url('admin/referral/page');
        $config['total_rows'] = $this->referral->countTableRows();
        $config['per_page'] = 10;
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['use_page_numbers'] = true;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $this->_pagerConfig = $config;
    
        $this->_data['page'] = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
        $this->_data['pagination'] = $this->pagination->create_links();
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
        $this->_data['referral'] = $this->referral->getEntity(false);
        $this->load->view('admin/vwReferralEdit',$this->_data);
    }
    
    public function edit($id=false) 
    {
        if(!$id){
            return redirect('admin/referral');
        }
        $this->_data['referral'] = $this->referral->getEntity($id);
        $this->load->view('admin/vwReferralEdit',$this->_data);
    }
   
    public function save() 
    {
        $this->_data = $this->input->post();
        $this->form_validation->set_rules('code', 'Referral Code', 'required');
        if ($this->form_validation->run() != FALSE) {
            $this->_data = $this->referral->setData($this->_data)->save();
            return redirect('admin/referral');
        } else {
            $errors = $this->form_validation->error_string();
            $referral = $this->referral->getEntity($this->_data['referral_id']);
            $this->_data['page']='referral';
            return $this->load->view('admin/vwReferralEdit', array('data'=>$this->_data,'referral'=>$referral,'errors'=>$errors));
        }
    }
    
    public function details() {
        $id = $this->uri->segment(4);
        if(!$id){
            return redirect('admin/referral');
        }
        $this->_data['referral'] = $this->referral->getEntity($id);
        $this->load->view('admin/vwReferralDetails',$this->_data);
    }
}