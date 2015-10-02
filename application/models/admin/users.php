<?php
class Users extends CI_Model 
{
    protected $_table       = 'ci_users';
    protected $_entity_id   = 'user_id';
            
    function __construct() {
        parent::__construct();
    }
    
    protected function _beforeSave() {
        if(!$this->getId()) {
            $this->setData('registered_date',date('Y-m-d H:i:s'));
            $checkUser = new Users();
            $checkUser->load($this->getUsername(),'username');
            if($checkUser->getId()) {
                $this->setUsername('');
                $this->session->addMessage('User with same Username already exists');
                throw new Exception();
            }
        }
        return $this;
    }

    public function getUserList($limit=10,$offset=0) {
        $this->db->from($this->_table);
        $this->db->join('ci_referral_codes', 'ci_referral_codes.referral_id = ci_users.referral_code','left');
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