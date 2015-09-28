<?php
if ( ! function_exists('referral_status'))
{
    function referral_status($statusId){
        $statuses = array(
            0=>'<span style="color:gray">Inactive</span>',
            1=>'<span style="color:green">Active</span>',
            2=>'<span style="color:red">Locked</span>');
        if(isset($statuses[$statusId])) {
            return $statuses[$statusId];
        }
        return "Unknown";
    }
    
    function referral_status_list(){
        return  array(
            0=>'Inactive',
            1=>'Active',
            2=>'Locked'
        );
    }
}