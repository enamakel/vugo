<?php
class Users extends CI_Model 
{
    protected $_table       = 'ci_users';
    protected $_entity_id   = 'user_id';
            
    function __construct() {
        parent::__construct();
    }
    
    
    public function getReferralList($limit=10,$offset=0) {
        $this->db->from($this->_table);
        $this->db->join('ci_referral_codes', 'ci_referral_codes.referral_id = ci_users.referral_code','left');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0 ) {
            return $query->result();
        }
        return false;
    }
    
}