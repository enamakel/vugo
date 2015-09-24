<?php
class Campaigns extends CI_Controller {

    private $_data = array();


    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('is_login')) {
           return redirect('auth/login');
        }
        $data = array();
        $data['first_name'] = $this->session->userdata('first_name');
     
        $data['activetab'] = 'campaigns';
        $this->_data = $data;
        $this->load->library('form_validation');
        $this->load->model('campaign/campaign','campaign');
    }

    public function index(){
        $this->_data['bradcrumbs'] = array('campaigns'=>'Campaigns');
        $this->_data['campaignList'] = $this->campaign->getCampaignList();
        $this->load->view('campaign/vwList', $this->_data);
    }
    
    public function remove() {
        if($campaignId = $this->uri->segment(3)) {
            if($this->campaign->remove($campaignId)) {
                return redirect('campaigns',array('message'=>array('Campaign removed')));
            } else {
                return redirect('campaigns',array('errors'=>array('Invalid campaign!')));
            }
        }  
    }

    public function campaign(){
        $this->_data['bradcrumbs'] = array('campaigns'=>'Campaigns','Campaign Details');
        if($campaignId = $this->uri->segment(3)) {
            $data = $this->campaign->getCampaign($campaignId);
            if(isset($data['campaign_id'])) {
                $this->_data['campaign']=$data;
            } else {
                return redirect('dashboard/campaigns',array('errors'=>array('Invalid campaign!')));
            }
        }  
        $this->load->view('campaign/vwStepMain', $this->_data);
//      $this->load->view('campaign/vwStepSchedule', $this->_data);
    }
    
    public function upload(){

        $config['upload_path'] = "uploads/".$this->session->userdata('id').'/';
        if(!is_dir( "uploads/".$this->session->userdata('id').'/')) {
            mkdir( "uploads/".$this->session->userdata('id').'/');
        }
        if($_POST['type']=='image') {
            $config['allowed_types'] = "jpg|jpeg|png|gif";
        } else {
            $config['allowed_types'] = "flv|mp4|wmv|avi";
        }
        $config['max_size'] = 1024*100;
        $config['max_width'] = 8000;
        $config['max_height'] = 6000;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file') == false) {
            $data = array('error' => $this->upload->display_errors());
        }else{
            $data = $this->upload->data();
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }
    
    public function save_main() {
        $campaignData = $_POST;
        $this->form_validation->set_rules('name', 'Campaign Name', 'required');
        $this->form_validation->set_rules('landing_url', 'Landing page', 'required');
        $this->form_validation->set_rules('budget', 'Campaign budget', 'required|less_than[50001]|greater_than[1000]');
        $this->form_validation->set_rules('monthly_cap', 'Campaign budget', 'required|less_than[50001]|greater_than[0]');
        $this->form_validation->set_rules('daily_cap', 'Daily spending cap', 'required|less_than[50001]|greater_than[0]');
        if(isset($campaignData['frequency']) && $campaignData['frequency']!='custom') {
            $this->form_validation->set_rules('frequency', 'Frequency cap per trip', 'required|less_than[100]');
        } else {
            $this->form_validation->set_rules('frequency_number', 'Frequency cap per trip', 'required|less_than[100]|greater_than[0]');
            $campaignData['frequency'] = $campaignData['frequency_number'];
        }
        unset($campaignData['frequency_number']);
        if ($this->form_validation->run() != FALSE) {
            $this->_data = $this->campaign->setCampaign($campaignData)->save();
        } else {
            $campaignData['errors'] = $this->form_validation->error_string();
            $campaignData['campaign_error'] = true;
            return $this->load->view('campaign/vwStepMain', array('data'=>$this->_data,'campaign'=>$campaignData,'bradcrumbs'=>array('campaigns'=>'Campaigns','Campaign Details')));
        }
        
        redirect('campaigns/campaign/'.$this->_data['campaign_id']);
       
    }
    
    public function save_schedule() {
        $campaignData = $_POST;
        if(!$campaignData['date_start']) {
            $campaignData['date_start'] = '00/00/0000';
        }
        if(!$campaignData['date_end']) {
            $campaignData['date_end'] = '00/00/0000';
        }
        $this->form_validation->set_rules('date_start', 'Campaign Date Starts', 'required');
        $this->form_validation->set_rules('date_end', 'Campaign Date Ends', 'required');
        $this->form_validation->set_rules('week_days', 'Campaign Week Days', 'required');
        $this->form_validation->set_rules('schedule_from', 'Campaign Schedule From Time', 'required');
        $this->form_validation->set_rules('schedule_until', 'Campaign Schedule Until Time', 'required');
       
        if ($this->form_validation->run() != FALSE) {
            $this->_data = $this->campaign->setSchedule($campaignData)->saveSchedule();
        } else {
            $campaignData = array_merge($this->campaign->getCampaign($campaignData['campaign_id']),$campaignData);
            $campaignData['errors'] = $this->form_validation->error_string();
            $campaignData['schedule_error'] = true;
            return $this->load->view('campaign/vwStepMain', array('data'=>$this->_data,'campaign'=>$campaignData,'bradcrumbs'=>array('campaigns'=>'Campaigns','Campaign Details')));
        }
        
        redirect('campaigns/campaign/'.$this->_data['campaign_id']);
    }
    
    public function save_target() {
        $campaignData = $_POST;
        $campaignData['target'] = array_filter($campaignData['target']);
      
     
        $this->_data = $this->campaign->setTarget($campaignData)->saveTarget();
        redirect('campaigns/campaign/'.$this->_data['campaign_id']);
    }

    public function save_location() {
        $campaignData = $_POST;
       // echo "<pre>"; print_r($campaignData); exit;
        if ($campaignData) {
            $this->_data = $this->campaign->setLocation($campaignData)->saveLocation();
        } else {
            return $this->load->view('campaign/vwStepMain', $campaignData);
        }
           redirect('campaigns/campaign/'.$this->_data['campaign_id']);
    }
 } 