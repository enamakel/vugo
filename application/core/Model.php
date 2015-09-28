<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Model Class
 *
 * @package		Vugo
 * @subpackage          Libraries
 * @category            Libraries
 * @author		Maxim Kabanov
 * @link		https://www.linkedin.com/in/maximkabanov
 */
class CI_Model {
    /* Model table name */
    protected $_table;
    
    /* Model key name */
    protected $_entity_id;
    
    /**
     * Object attributes
     *
     * @var array
     */
    protected $_data = array();

    /**
     * Setter/Getter underscore transformation cache
     *
     * @var array
     */
    protected static $_underscoreCache = array();
    
    /**
    * Constructor
    * @access public
    */
    function __construct()
    {
         log_message('debug', "Model Class Initialized");
    }
    
    /**
     * Converts field names for setters and geters
     *
     * $this->setMyField($value) === $this->setData('my_field', $value)
     * Uses cache to eliminate unneccessary preg_replace
     *
     * @param string $name
     * @return string
     */
    protected function _underscore($name)
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        self::$_underscoreCache[$name] = $result;
        return $result;
    }

    /**
     * __get
     *
     * Allows models to access CI's loaded classes using the same
     * syntax as controllers.
     *
     * @param	string
     * @access private
     */
    function __get($key)
    {
        $CI =& get_instance();
        return $CI->$key;
    }
    
    /**
     * Set/Get attribute wrapper
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method,3));
                $data = $this->getData($key, isset($args[0]) ? $args[0] : null);
                return $data;

            case 'set' :
                $key = $this->_underscore(substr($method,3));
                $result = $this->setData($key, isset($args[0]) ? $args[0] : null);
                return $result;

            case 'uns' :
                $key = $this->_underscore(substr($method,3));
                $result = $this->unsetData($key);
                return $result;

            case 'has' :
                $key = $this->_underscore(substr($method,3));
                return isset($this->_data[$key]);
        }
        $trace = debug_backtrace();
        _exception_handler(E_ERROR,"Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")", $trace[1]['file'], $trace[1]['line']);

    }
    
    /**
     * Retrieves data from the object
     *
     * If $key is empty will return all the data as an array
     * Otherwise it will return value of the attribute specified by $key
     *
     * @param string $key
     * @return mixed
     */
    public function getData($key='') 
    {
        if (''===$key) {
            return $this->_data;
        }
        $default = null;
        $data = $this->_data;
        
        if (is_array($data)) {
            if (!isset($data[$key])) {
                return $default;
            }
            $data = $data[$key];
        } elseif ($data instanceof CI_Model) {
            $data = $data->getData($key);
        } else {
            return $default;
        }
        return $data;
    }
    
    /**
     * Overwrite data in the object.
     *
     * $key can be string or array.
     * If $key is string, the attribute value will be overwritten by $value
     *
     * If $key is an array, it will overwrite all the data in the object.
     *
     * @param string|array $key
     * @param mixed $value
     * @return \CI_Model
     */
    public function setData($key, $value=null)
    {
        if(is_array($key)) {
            $this->_data = $key;
        } else {
            $this->_data[$key] = $value;
         }
        return $this;
    }
    
    /**
     * Add data to the object.
     *
     * Retains previous data in the object.
     *
     * @param array $arr
     * @return Varien_Object
     */
    public function addData(array $arr)
    {
        foreach($arr as $index=>$value) {
            $this->setData($index, $value);
        }
        return $this;
    }
    
    /**
     * Unset data from the object.
     *
     * $key can be a string only. Array will be ignored.
     *
     * @param string $key
     * @return \CI_Model
     */
    public function unsetData($key=null)
    {
        if($key) {
            unset($this->_data[$key]);
        }
        return $this;
    }

    
    /**
     * Load abstract entity by params
     * 
     * @param int $id
     * @param string $field
     * @return \CI_Model
     */
    public function getEntity($id,$field = '') 
    {
        $this->db->from($this->_table);
        if($field) {
            $this->db->where($field,trim($id));
        } else {
            $this->db->where($this->_entity_id,$id);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0 ) {
            $result = $query->row_array();
        } else {
            $arrayKeys = array_flip($this->db->list_fields('ci_referral_codes'));
            $result = array_fill_keys($arrayKeys,'');
        }
        $this->setData($result);
        
        return $this;
    }
    
    /**
     * Save abstract entity
     * 
     * @return \CI_Model
     */
    public function save() 
    {
        $result = false;
        $this->_beforeSave();
        //var_dump((isset($this->_data[$this->_entity_id]) && !$this->_data[$this->_entity_id])); exit;
        if(!isset($this->_data[$this->_entity_id]) || (isset($this->_data[$this->_entity_id]) && !$this->_data[$this->_entity_id])) {
            $this->db->insert($this->_table, $this->_data);
            $this->getEntity($this->db->insert_id());
        } else {
            $result = $this->db->update($this->_table, 
                $this->_data,
                array($this->_entity_id => $this->_data[$this->_entity_id]));
            foreach ($this->_data as $k=>$v) {
                $this->setData($k,$v);
            }
        }
        $this->_afterSave();
        return $this;
    }
    
    /**
     * Before save function
     * 
     * @return \CI_Model
     */
    protected function _beforeSave() {
        return $this;
    }
    
    /**
     * After save function
     * 
     * @return \CI_Model
     */
    protected function _afterSave() {
        return $this;
    }
    
    /**
     * Load entity by id or custom field
     * 
     * @param string $id
     * @param string $field
     * @return \CI_Model
     */
    public function load($id='',$field='') {
        if(!$id) {
            return $this;
        }
        return $this->getEntity($id,$field);
        
    }
}
