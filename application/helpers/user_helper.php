<?php
if ( ! function_exists('userAvailableCountry'))
{
    function userAvailableCountry($countryCode = ''){
        $_countries = array(
            'US' => array('label'=>'United States','phone_code'=>'+1'),
        ); 
        
        return $countryCode && isset($_countries[$countryCode])?$_countries[$countryCode]:$_countries;
    }
}
    
if ( ! function_exists('renderer_lastLogin'))
{
    function renderer_lastLogin($row){
        return ($row->last_login!=="0000-00-00 00:00:00")?$row->last_login:"Never";
    }
}
if ( ! function_exists('renderer_phoneNumber'))
{
    function renderer_phoneNumber($row){
        if($row instanceof CI_Model) {
            $row->phone_number = $row->getPhoneNumber();
        }
        $countryCode = substr($row->phone_number,0,2);
        $phone = substr($row->phone_number,2, strlen($row->phone_number));
        $country = userAvailableCountry($countryCode);
        $phoneCode = isset($country['phone_code'])?$country['phone_code']:'';
        return $phoneCode.' '.$phone;
    }
}
if ( ! function_exists('clearPhoneNumber'))
{
    function clearPhoneNumber($row){
        if($row instanceof CI_Model) {
            $row->phone_number = $row->getPhoneNumber();
        }
        $countryCode = substr($row->phone_number,0,2);
        $phone = substr($row->phone_number,2, strlen($row->phone_number));
        return $phone;
    }
}
if ( ! function_exists('phoneCodeJSON'))
{
    function phoneCodeJSON(){
        $toJSON = array();
        $country = userAvailableCountry();
        foreach ($country as $key=>$_country) {
            $toJSON[$key] = $_country['phone_code']; 
        }
        
        return json_encode($toJSON);
    }
}

if ( ! function_exists('renderer_country'))
{
    function renderer_country($row){
        $country = userAvailableCountry($row->country);
        return isset($country['label'])?$country['label']:'<span class="label label-danger">Unknown country :0</span>';
    }
}