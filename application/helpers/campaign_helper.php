<?php
if ( ! function_exists('campaign_status'))
{
    function campaign_status($statusId){
        $statuses = array(1=>'Awaiting approval',2=>'Approved',3=>'Disapproved');
        if(isset($statuses[$statusId])) {
            return $statuses[$statusId];
        }
        return "Unknown";
    }
}