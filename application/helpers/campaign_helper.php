<?php
if ( ! function_exists('campaign_status'))
{
    function campaign_status($statusId){
        if ($statusId instanceof stdClass) {
            $statusId = $statusId->status;
        }
        $statuses = array(1=>'Awaiting approval',2=>'Approved',3=>'Disapproved');
        if(isset($statuses[$statusId])) {
            return $statuses[$statusId];
        }
        return "Unknown";
    }
}

if ( ! function_exists('renderer_owner'))
{
    function renderer_owner($row){
        return $row->first_name .' '. $row->last_name;
    }
}