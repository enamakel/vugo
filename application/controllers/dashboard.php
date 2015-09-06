<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('is_login')) {
           return redirect('auth/login');
        } 
        $this->load->library('form_validation');
        $this->load->model('campaign/campaign');
    }

    public function index(){
        $data = array();
        $data['first_name'] = $this->session->userdata('first_name');
        $data['bradcrumbs'] = array('campaigns'=>'Maim page');
        $data['campaignList'] = $this->campaign->getCampaignList();
        $this->load->view('campaign/vwList', $data);
    }
 } 