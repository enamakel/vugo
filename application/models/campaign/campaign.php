<?php
class Campaign extends CI_Model 
{
    protected $_entity_id = 'campaign_id';
    protected $_data = array();
    function __construct() {
        parent::__construct();
    }
    
    public function setData($data) {
        $this->_data = $data;
        return $this;
    }
    
    public function getData($key=false) {
        if($key && isset($this->_data->$key)) {
            return $this->_data->$key;
        }
        return $this->_data;
    }

    public function getCampaignList() {
        $this->db->from('ci_campaigns');
        $this->db->where('owner_id', $this->session->userdata('id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0 ) {
            return $query->result_array();
        }
        return false;
    }
    
    public function remove($campaignId) {
        $this->db->where('campaign_id', $campaignId);
        $this->db->where('owner_id', $this->session->userdata('id'));
        return $this->db->delete('ci_campaigns'); 
    }

    public function getCampaign($campaignId) {
        $this->db->from('ci_campaigns');
//        $this->db->select(array('ci_campaigns.*','ci_campaigns_media.*','ci_campaigns_schedule.*',));
        $this->db->where($this->_entity_id, $campaignId);
        $this->db->where('owner_id', $this->session->userdata('id'));
        $this->db->join('ci_campaigns_media', 'ci_campaigns.campaign_id = ci_campaigns_media.campaign','left');
        $this->db->join('ci_campaigns_schedule', 'ci_campaigns.campaign_id = ci_campaigns_schedule.campaign','left');
        $this->db->join('ci_campaigns_location', 'ci_campaigns.campaign_id = ci_campaigns_location.campaign','left');
        $this->db->join('ci_campaigns_target', 'ci_campaigns.campaign_id = ci_campaigns_target.campaign','left');
        $query = $this->db->get();
      //  echo  $this->db->last_query(); exit;
        if ($query->num_rows() > 0 ) {
            $row = $query->row_array();
          //  echo "<pre>"; print_r($row); exit;
            if($row['date_start']) {
            list($y,$m,$d) = explode("-", $row['date_start']);
                $row['date_start'] = $m."/".$d."/".$y;
            }
            if($row['date_end']) {
                list($y,$m,$d) = explode("-", $row['date_end']);
                $row['date_end'] = $m."/".$d."/".$y;
            }
            if($row['target']) {
                $row['target'] = unserialize($row['target']);
            }
           // echo '<pre>'; print_r($row); exit;
            return $row;
        }
        return false;
    }
    
    public function setCampaign($campaignData) {
        $this->_data=$campaignData;
        return $this;
    }
    
    public function setSchedule($campaignData) {
        $this->_data = $campaignData;
        return $this;
    }
    
    public function setTarget($campaignData) {
        $this->_data = $campaignData;
        return $this;
    }
    
    public function setLocation($campaignData) {
        $this->_data = $campaignData;
        return $this;
    }
    
    public function saveSchedule() {
        $data = $this->_data;
        try {
            $data['campaign'] = $data[$this->_entity_id];
            list($m,$d,$y) = explode('/',$data['date_start']);
            $data['date_start'] = $y."-".$m."-".$d;
            list($m,$d,$y) = explode('/',$data['date_end']);
            $data['date_end'] = $y."-".$m."-".$d;
            if(strpos($data['schedule_until'],'pm')) {
                $data['schedule_until'] = str_replace("pm","",$data['schedule_until']);
                list($h,$m) = explode(':',$data['schedule_until']);
                $h +=12;
                $data['schedule_until'] = $h.":".$m;
            }
            unset($data[$this->_entity_id]);
            $this->db->from('ci_campaigns_schedule');
            $this->db->where('campaign', $data['campaign']);
            $query = $this->db->get();
            
            if($query->num_rows() < 1 ) {
                $this->db->insert('ci_campaigns_schedule', $data);
                $result = $this->getCampaign($data['campaign']);
            } else {
                $this->db->update('ci_campaigns_schedule', 
                        $data,
                        array('campaign' => $data['campaign']));
                
                $result = $this->_data;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    
    public function saveTarget() {
        $data = $this->_data;
        try {
            $data['campaign'] = $data[$this->_entity_id];
            $data['target'] = serialize($data['target']);
           
            unset($data[$this->_entity_id]);
            $this->db->from('ci_campaigns_target');
            $this->db->where('campaign', $data['campaign']);
            $query = $this->db->get();
            
            if($query->num_rows() < 1 ) {
                $this->db->insert('ci_campaigns_target', $data);
                $result = $this->getCampaign($data['campaign']);
            } else {
                $this->db->update('ci_campaigns_target', 
                        $data,
                        array('campaign' => $data['campaign']));
                
                $result = $this->_data;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
     //    echo "<pre>"; print_r($result); exit;
        return $result;
    }
    
    public function saveLocation() {
        $data = $this->_data;
        $data['campaign'] = $data[$this->_entity_id];
        unset($data[$this->_entity_id]);
        try {
            $this->db->from('ci_campaigns_location');
            $this->db->where('campaign', $data['campaign']);
            $query = $this->db->get();
            
            if($query->num_rows() < 1 ) {
                $this->db->insert('ci_campaigns_location', $data);
                $result = $this->getCampaign($data['campaign']);
            } else {
                $this->db->update('ci_campaigns_location', 
                        $data,
                        array('campaign' =>$data['campaign']));
                
                $result = $this->_data;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    public function save() {
        $data = $this->_data;
        $filedata = FALSE;
        $mediaExists = false;
        if(!isset($data[$this->_entity_id])) {
            $data[$this->_entity_id] = '';
        }
        $data['owner_id'] = $this->session->userdata('id');
        $filePost = $data['file_data'];
       
        unset($data['file_data']);
        unset($data['file']);
        if($filePost) {
            $filePost = json_decode($filePost);
            $filedata['real_path']      = $filePost->_response->result->full_path;
            $filedata['absolute_url']   = HTTP_BASE_URL."uploads/".$this->session->userdata('id').'/'.$filePost->_response->result->file_name;
        }
           
        try {
            if(!$data[$this->_entity_id]) {
                $this->db->insert('ci_campaigns', $data);
                $result = $this->getCampaign($this->db->insert_id());
            } else {
                if($filedata) {
                    $this->_data['status'] = 1;
                    $mediaExists = true;
                }
                $this->db->update('ci_campaigns', 
                        $data,
                        array($this->_entity_id => $this->_data[$this->_entity_id]));
                
                $result = $this->_data;
            }
            $filedata['campaign'] = $result[$this->_entity_id];
            if($filedata) {
                if($mediaExists) {
                    $this->db->update('ci_campaigns_media',$filedata,array('campaign'=>$filedata['campaign']));
                } else {
                    $filedata['media_id']= '';
                    $this->db->insert('ci_campaigns_media',$filedata);
                }
            }
    
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
}