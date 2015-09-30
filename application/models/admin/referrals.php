<?php
class Referrals extends CI_Model 
{
    protected $_table       = 'ci_referral_codes';
    protected $_entity_id   = 'referral_id';
            
    function __construct() {
        parent::__construct();
    }
    
    public function getReferralList($limit=10,$offset=0) {
        $this->db->from('ci_referral_codes');
        $this->db->join('tbl_admin_users', 'ci_referral_codes.author = tbl_admin_users.id','inner');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0 ) {
            return $query->result_array();
        }
        return false;
    }
    
    protected function _afterLoad() 
    {
        $this->db->from('ci_users');
        $this->db->where('referral_code', $this->getId());
        $query = $this->db->get();
        $this->setUserList($query->result());
        return $this;
    }
    
    protected function _beforeSave() 
    {
        $added = '';
        $updated = date('Y-h-m H:i:s');
        if($this->getId()) {
            $added = $updated;
        }
        $this->setData('added',$added);
        $this->setData('updated',$updated);
        return $this;
    }
}