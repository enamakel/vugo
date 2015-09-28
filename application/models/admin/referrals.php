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
      //  echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0 ) {
            return $query->result_array();
        }
        return false;
    }
    
    public function countTableRows() {
        return $this->db->count_all('ci_referral_codes');
    }
    
    
}