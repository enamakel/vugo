<?php
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('auth/register','register');
    }

    public function index(){
        if ($this->session->userdata('is_login')) {
           return redirect('dashboard/index');
        } 
        $this->load->view('auth/vwAuth');
    }
    
    public function forgot() {
        if ($this->session->userdata('is_login')) {
           return redirect('dashboard/index');
        } 
        if(!isset($_POST['username'])) {
           return $this->load->view('auth/vwForgot');
        }
        
        $user = htmlspecialchars(strip_tags($_POST['username']));
        $email = htmlspecialchars(strip_tags($_POST['email']));

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $result = false;
        if ($this->form_validation->run() != FALSE) {
            $result = $this->register->forgotPass($user,$email);
        }
        $this->load->view('auth/vwForgot', array('messages'=>array($result)));
    }


    public function register(){
        if(!isset($_POST['username'])) {
            $data = array();
            $data['countries'] = $this->register->getCountryCodes();
            $data['phone_codes'] = $this->register->getRelationCountryPhoneCodes();
            $this->load->view('auth/vwRegister',$data);
        } else {
            $this->_do_register();
        }
    }
    
    public function check_username() {
        $result = $this->register->checkUsername($_POST['username']);
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'valid'=>$result
            )));
    }
    
    private function _do_register() {
        $postData = $_POST;
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('phone_number', 'Phone Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() != FALSE) {
            $result = $this->register->registerNewUser($postData);
            if(is_array($result)) {
                $this->session->set_userdata(array(
                        'id' => $result['user_id'],
                        'username' => $result['username'],
                        'email' => $result['email'],                            
                        'is_login' => true,
                        'first_name' => $result['first_name']
                    )
                );
                return redirect('dashboard/index');
            }
        } 
        $postData['countries'] = $this->register->getCountryCodes();
        $postData['phone_codes'] = $this->register->getRelationCountryPhoneCodes();
        $postData['errors'] = array($result);
        return  $this->load->view('auth/vwRegister',$postData);
    }

    public function login() {

        if ($this->session->userdata('is_login')) {
            redirect('dashboard/index');
        } else {
            if(!isset($_POST['username'])) {
                return $this->load->view('auth/vwAuth');
            }
            $user = htmlspecialchars(strip_tags($_POST['username']));
            $password = htmlspecialchars(strip_tags($_POST['password']));

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/vwAuth');
            } else {
                $result = $this->register->loginUser($user,$password);
                if ($result) {
                        $this->session->set_userdata(array(
                                'id' => $result['user_id'],
                                'username' => $result['username'],
                                'email' => $result['email'],                            
                                'is_login' => true,
                                'first_name' => $result['first_name']
                            )
                        );
                    redirect('dashboard/index');
                } else {
                    $err['messages'] = array('<strong>Access Denied</strong> Invalid Username/Password');
                    $this->load->view('auth/vwAuth', $err);
                }
            }
        }
           }

        
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('is_admin_login');   
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('auth/index', 'refresh');
    }
} 