<?php
class Register extends CI_Model 
{
    private $_countries = array(
        'US' => 'United States'
    ); 
    
    private $_phoneCodes = array(
        'US' => '+1',
    );
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountryCodes() {
        return $this->_countries;
    } 
    
    public function getRelationCountryPhoneCodes() {
        return json_encode($this->_phoneCodes);
    }
    
    public function getUser($username,$field=false) {
        $this->db->from('ci_users');
        $this->db->where('username', $username );
        $query = $this->db->get();
        if ($query->num_rows() > 0 ) {
            $row = $query->row_array();
            return $row;
        }
        return false;
    }
    
    public function checkUsername($username) {
        return $this->getUser($username)?"null":"true";
    }
    
    public function registerNewUser($data) {
        if(!$this->checkUsername($data['username'])) return 'User with the same username already exists';
    
        foreach ($data as $key=>$value) {
            $data[$key] = htmlspecialchars(strip_tags($value));
        }
        $data['phone_number'] = $data['phoneCountry'].$data['phone_number'];
        unset($data['phoneCountry']);
        $data['password'] = md5($data['password']);
        $result = $this->db->insert('ci_users', $data);
        if($result) {
            $this->sendSuccessEmail($data);
        }
        return $this->getUser($data['username']);
    }
    
    public function sendSuccessEmail($data) {
        $this->load->helper('email');
        if(valid_email($data['email'])) {
            send_email($data['email'],"Registration Suuccess","Your Username <b>".$data['username']."</b>, Password <b>".$data['password']."</b>");
        }
    }
    
    public function loginUser($username,$password) {
        $enc_pass  = md5($password);
        $this->db->from('ci_users');
        $this->db->where('username', $username );
        $this->db->where('password', $enc_pass );
        $query = $this->db->get();
        if ($query->num_rows() > 0 ) {
            $row = $query->row_array();
            return $row;
        }
        return false;
    }
    
    public function forgotPass($username,$email) {
        $user = $this->getUser($username);
        if(!$user || $user['email']!=$email) {
            return "User not exists. Try again";
        }
        $this->load->helper('email');
        $newPass = $this->_generateNewPass();
        $passHash = md5($newPass);
        $this->db->update('ci_users', array('password'=>$passHash), array('user_id' => $user['user_id']));
        send_email($email,'Reset Password','Your password was reset. Temporary Pass is <b>'.$newPass.'</b>. You can change it in your <a href="'.HTTP_BASE_SECURE_URL.'dashboard/'.'">account area</a>');
        return 'Password reset. Please check email with instructions';
        
    }
    
    private function _generateNewPass( $length = 8, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ) {
        return substr( str_shuffle( $chars ), 0, $length );
    }
}