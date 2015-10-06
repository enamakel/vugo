<?php
class Campaigns extends CI_Model 
{
    protected $_table       = 'ci_campaigns';
    protected $_entity_id   = 'campaign_id';
            
    function __construct() {
        parent::__construct();
    }
    
    public function getCampaignList($limit=10,$offset=0) {
        $this->db->from($this->_table);
        $this->db->join('ci_campaigns_location', 'ci_campaigns.campaign_id = ci_campaigns_location.campaign','left');
        $this->db->join('ci_campaigns_media', 'ci_campaigns.campaign_id = ci_campaigns_media.campaign','left');
        $this->db->join('ci_campaigns_schedule', 'ci_campaigns.campaign_id = ci_campaigns_schedule.campaign','left');
        $this->db->join('ci_campaigns_target', 'ci_campaigns.campaign_id = ci_campaigns_target.campaign','left');
        $this->db->join('ci_users', 'ci_campaigns.owner_id = ci_users.user_id','inner');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0 ) {
            return $query->result();
        }
        return false;
    }
    
    public function getName()
    {
        return $this->getFirstName().' '.$this->getLastName();
    }
}