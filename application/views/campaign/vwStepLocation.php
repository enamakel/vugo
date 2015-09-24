<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCW5VsEDH465TQ30juUufywDJ9Sk0zEx4Y&libraries=places"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.geocomplete.min.js"></script>
<div class="panel panel-default ng-scope">
    <a name="location"></a>
    <div class="panel-heading">
        <button id="button-edit-campaign-location" class="pull-right btn button-edit btn-default <?php echo (isset($campaign['location_id'])?'':'ng-hide') ?>">Edit</button>
        <h4 class="panel-title"><i class="fa fa-location-arrow"></i>&nbsp;Location</h4>
        <div class="small text-muted <?php if(!isset($campaign['schedule_id']) || !$campaign['schedule_id']):?>ng-hide<?php endif;?>">Please specify location where you would want to focus your campaign.<br>For multiple locations we advise you to have different campaigns.</div>
    </div>
    <?php if(isset($campaign['schedule_id']) && $campaign['schedule_id']):?>
    <div id="campaign-location-preview" class="campaign_preview <?php echo (isset($campaign['location_id'])?'':'ng-hide') ?>"></div>
    <form id="campaign-location-form" class='<?php echo (isset($campaign['location_id'])?'ng-hide':'') ?>' action="<?php echo HTTP_BASE_URL."campaigns/save_location"?>" method="POST">
        <input type="hidden" name="campaign_id" value="<?php echo (isset($campaign['campaign_id'])?$campaign['campaign_id']:'') ?>"
        <div class="slide-animation ">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="address-group">
                            <div style="cursor:pointer">
                                <i id="location_select_address" class="location_select fa <?php if((isset($campaign['address']) && $campaign['address'])|| !isset($campaign['location_id'])):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="location_select" for="location_select_address">&nbsp;Advertisement specific for the address</span>
                            </div>
                            <div id="location_select_address_div" class="location_select_address_div location_select_div" style="padding-left:15px;padding-right:15px;<?php if((!isset($campaign['address']) || !$campaign['address']) && isset($campaign['location_id'])):?>display: none;<?php endif;?>">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <b>Address</b>
                                            <div>
                                                <div>
                                                    <input value="<?php if(isset($campaign['address']) && $campaign['address']): echo $campaign['address']; endif;?>" id="address_input" type="text" placeholder="Street address, City, Region, Country, ..."  class="form-control" name="address">
                                                </div>
                                            </div>
                                            <div class="small">
                                                <div id="latlang" class="text-muted latlang">
                                                    <input id="location-hidden" type="hidden" name="location" data-geo="location"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <b>Radius (in miles)</b>
                                            <div>
                                                <select class="form-control" id="radius" name="radius">
                                                <option value="" class="">Select</option>
                                                <option value="1" label="1">1</option>
                                                <option value="3" label="3">3</option>
                                                <option value="5" label="5">5</option>
                                                <option value="7" label="7">7</option>
                                                <option value="9" label="9">9</option>
                                                <option value="11" label="11">11</option>
                                                <option value="13" label="13">13</option>
                                                <option value="15" label="15">15</option>
                                                <option value="17" label="17">17</option>
                                                <option value="19" label="19">19</option>
                                                <option value="21" label="21">21</option>
                                                <option value="23" label="23">23</option>
                                                <option value="25" selected="selected" label="25">25</option>
                                                <option value="27" label="27">27</option>
                                                <option value="29" label="29">29</option>
                                                <option value="30" label="30">30</option>
                                                <option value="35" label="35">35</option>
                                                <option value="40" label="40">40</option>
                                                <option value="45" label="45">45</option>
                                                <option value="50" label="50">50</option>
                                                <option value="60" label="60">60</option>
                                                <option value="70" label="70">70</option>
                                                <option value="80" label="80">80</option>
                                                <option value="90" label="90">90</option>
                                                <option value="100" label="100">100</option>
                                                <option value="200" label="200">200</option>
                                                <option value="300" label="300">300</option>
                                                <option value="400" label="400">400</option>
                                                <option value="500" label="500">500</option>
                                                <option value="29" label="500">500</option>
                                                <option value="750" label="750">750</option>
                                                <option value="1000" label="1000">1000</option>
                                                <option value="1250" label="1250">1250</option>
                                                <option value="1500" label="1500">1500</option>
                                                <option value="1750" label="1750">1750</option>
                                                <option value="2000" label="2000">2000</option>
                                                <option value="2250" label="2250">2250</option>
                                                <option value="2500" label="2500">2500</option>
                                                <option value="2750" label="2750">2750</option>
                                                <option value="3000" label="3000">3000</option>
                                                </select>
                                                <script type="text/javascript">
                                                <?php if(isset($campaign['radius']) && $campaign['radius']):?>
                                                    $('#radius').val(<?php echo $campaign['radius']?>);
                                                <?php endif;?>
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="address-group">
                            <div style="cursor:pointer" class="">
                                <i id="location_select_zip" class="location_select fa <?php if(isset($campaign['location_zip']) && $campaign['location_zip']):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="location_select" for="location_select_zip">&nbsp;Show within postal codes</span>
                            </div>
                            <div id="location_select_zip_div" class="location_select_zip_div location_select_div" style="padding-left:15px;padding-right:15px; <?php if(!isset($campaign['location_zip']) || !$campaign['location_zip']):?>display: none;<?php endif;?>" class="">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <b>Postal Codes</b> 
                                            <input type="text" placeholder="Postal_code_1, Postal_code_2, ..." style="text-transform:lowercase" class="form-control ng-pristine ng-valid" id="postalCode">
                                            <input type="hidden" name="location_zip" id="location_zip"/>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary form-control" onclick="addZipCode(); return false;">Add To List</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="address-group">
                            <div style="cursor:pointer">
                                <i id="location_select_state" class="location_select fa <?php if(isset($campaign['state']) && $campaign['state']):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="location_select" for="location_select_state">&nbsp;Show within the state</span>
                            </div>
                            <div id="location_select_state_div" class="location_select_state_div location_select_div" style="padding-left:15px;padding-right:15px; <?php if(!isset($campaign['state']) || !$campaign['state']):?>display: none;<?php endif;?>">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <b>State</b>
                                            <div>
                                                <div>
                                                    <input type="hidden" id="state_input_value"/>
                                                    <select id="state_input" class="form-control" name="state">
                                                    <option value="">Select</option>
                                                    <option value="Alabama">Alabama</option>
                                                    <option value="Alaska">Alaska</option>
                                                    <option value="Arizona">Arizona</option>
                                                    <option value="Arkansas">Arkansas</option>
                                                    <option value="California">California</option>
                                                    <option value="Colorado">Colorado</option>
                                                    <option value="Connecticut">Connecticut</option>
                                                    <option value="Delaware">Delaware</option>
                                                    <option value="Florida">Florida</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Hawaii">Hawaii</option>
                                                    <option value="Idaho">Idaho</option>
                                                    <option value="Illinois">Illinois</option>
                                                    <option value="Indiana">Indiana</option>
                                                    <option value="Iowa">Iowa</option>
                                                    <option value="Kansas">Kansas</option>
                                                    <option value="Kentucky">Kentucky</option>
                                                    <option value="Louisiana">Louisiana</option>
                                                    <option value="Maine">Maine</option>
                                                    <option value="Maryland">Maryland</option>
                                                    <option value="Massachusetts">Massachusetts</option>
                                                    <option value="Michigan">Michigan</option>
                                                    <option value="Minnesota">Minnesota</option>
                                                    <option value="Mississippi">Mississippi</option>
                                                    <option value="Missouri">Missouri</option>
                                                    <option value="Montana">Montana</option>
                                                    <option value="Nebraska">Nebraska</option>
                                                    <option value="Nevada">Nevada</option>
                                                    <option value="New Hampshire">New Hampshire</option>
                                                    <option value="New Jersey">New Jersey</option>
                                                    <option value="New Mexico">New Mexico</option>
                                                    <option value="New York">New York</option>
                                                    <option value="North Carolina">North Carolina</option>
                                                    <option value="North Dakota">North Dakota</option>
                                                    <option value="Ohio">Ohio</option>
                                                    <option value="Oklahoma">Oklahoma</option>
                                                    <option value="Oregon">Oregon</option>
                                                    <option value="Pennsylvania">Pennsylvania</option>
                                                    <option value="Rhode Island">Rhode Island</option>
                                                    <option value="South Carolina">South Carolina</option>
                                                    <option value="South Dakota">South Dakota</option>
                                                    <option value="Tennessee">Tennessee</option>
                                                    <option value="Texas">Texas</option>
                                                    <option value="Utah">Utah</option>
                                                    <option value="Vermont">Vermont</option>
                                                    <option value="Virginia">Virginia</option>
                                                    <option value="Washington">Washington</option>
                                                    <option value="West Virginia">West Virginia</option>
                                                    <option value="Wisconsin">Wisconsin</option>
                                                    <option value="Wyoming">Wyoming</option>
                                                    </select>
                                                    <?php if(isset($campaign['state']) && $campaign['state']):?>
                                                    <script type="text/javascript">
                                                        $("#state_input").val('<?php echo trim($campaign['state'])?>');
                                                    </script>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="address-group">
                            <div style="cursor:pointer">
                                <i id="location_select_country" class="location_select fa <?php if(isset($campaign['country']) && $campaign['country']):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="location_select" for="location_select_country">&nbsp;Show within country</span>
                            </div>
                            <div class="form-group">
                                <b style='display:none'>Country</b>
                                 <div>
                                    <div id="location_select_country_div" class="location_select_country_div location_select_div">
                                        <input type="hidden" name='country' value='Usa' id="country_input"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-sm-6">
                        <div id="campaign-location-map" style="height:300px; background-color:#ccc; <?php if((!isset($campaign['address']) || !$campaign['address']) && isset($campaign['location_id'])):?> display:none; <?php endif;?>" class="location_select_address_div location_select_div form-map"></div>
                        <div id="campaign-location-state" style="height:300px; background-color:#ccc; <?php if(!isset($campaign['state']) || !$campaign['state']):?>display: none;<?php endif;?>" class=" location_select_div location_select_state_div form-map"></div>
                        <div id="campaign-location-country" style="height:300px; background-color:#ccc; <?php if(!isset($campaign['country']) || !$campaign['country']):?>display: none;<?php endif;?>" class="location_select_country_div location_select_div form-map"></div>
                        <div id="campaign-location-zip" style=" <?php if(!isset($campaign['location_zip']) || !$campaign['location_zip']):?>display: none;<?php endif;?>" class="location_select_zip_div location_select_div well"></div>
                    </div>

                <div class="text-center" style="margin-top:20px;">
                    <button type="reset" class="btn btn-default">Cancel</button>&nbsp; 
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </div>
        </div>
    </form>
    <?php endif;?>
</div>
<?php $this->load->view('campaign/vwStepTarget',array('campaign'=>$campaign)); ?>
<?php // echo "<pre>"; print_r($campaign); exit; ?>
<script type="text/javascript">
var rendererMap = function(position) {
    <?php if(isset($campaign['address']) && $campaign['address']): ?>
        var latlng = '<?php echo $campaign['address'];?>';
        $('#location-hidden').val(<?php echo $campaign['location'];?>);
    <?php else:?>
        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        $('#location-hidden').val(latlng.toLocaleString());
    <?php endif;?>
    
    $("#address_input").geocomplete({
        map: "#campaign-location-map",
        details: ".latlang",
        detailsAttribute: "data-geo",
        location: latlng
    });
};
$(function(){
    var options = {
        map: "#campaign-location-state",
        detailsAttribute: "data-geo"
        <?php if(isset($campaign['state']) && $campaign['state']):?>
        , location: '<?php echo $campaign['state']?>'
        <?php endif;?>
    };
    $("#state_input_value").geocomplete(options);
    $("#state_input").change(function(){
        $('#state_input_value').val($(this).val());
        $("#state_input_value").trigger("geocode");
    });
});
<?php if((isset($campaign['address']) && $campaign['address']) || !isset($campaign['location_id'])):?>

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(rendererMap);
} else {
    error('not supported');
}
<?php endif;?>
var removeZip = function(zipId) {
    $('#'+zipId).remove();
    var inputEl = $('#location_zip');
    var zipList = inputEl.val().split(",");
    $.each(zipList,function(key, value){
        if(String(value)===String(zipId) || String(value)==='') {
            delete zipList[key];
        }
    });
    zipList = $.grep(zipList,function(n){ return(n) });
    inputEl.val(zipList.join());
};

var addZipCode = function(zip) {
    if(!zip) {
        zip = $('#postalCode').val();
    }
    if(!zip) return ;
    
    var inputEl = $('#location_zip');
    var zipList = inputEl.val().split(",");
    var newZipList = zip.split(",");
    $.each(newZipList,function(key, value){
        zipList.push(value);
        $('#campaign-location-zip').append('<span id="'+value+'"><div style="margin-right:5px; display:inline-block;" class="label label-info">'+value+' &nbsp;<span style="cursor:pointer" class="fa fa-times" onclick="removeZip('+value+');"></span></div></span>');

    });
    zipList = $.grep(zipList,function(n){ return(n) });
    inputEl.val(zipList.join());
    $('#postalCode').val('');
}
<?php if(isset($campaign['location_zip']) && $campaign['location_zip']):?>
    addZipCode('<?php echo $campaign['location_zip']?>');
<?php endif;?>
var locationSelect = function(event) {
    var el;
    if(event) {
        el = $(event.currentTarget);
        if(!$(event.currentTarget).is('i')) {
            el = $("#"+el.attr('for'));
        }
    } else {
        el = $('#campaign-schedule-form i .fa-check-square-o');
        alert(el.attr('id'));
        $('#'+el.attr('id')+'_div').show();
    }
    $('i.location_select').each(function(){
        $(this).removeClass('fa-check-square-o');
        $(this).removeClass('fa-square-o');
        $(this).addClass('fa-square-o');
    })
   
    el.removeClass('fa-square-o');
    el.addClass('fa-check-square-o');
    
   $('.location_select_div').find('input, select, textarea').each(function() {
        $(this).val('');
    });

    $('.location_select_div').hide();
    $('.'+el.attr('id')+'_div').show();
    if(el.attr('id')=='location_select_country') {
        $('#country_input').val('USA');
        $("#country_input").geocomplete({
          map: "#campaign-location-country",
          location: "USA"
        });
    }
    if(el.attr('id')=='location_select_address') {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(rendererMap);
        } else {
            error('not supported');
        }
    }
};
<?php if(isset($campaign['country']) && $campaign['country']):?>
     $("#country_input").geocomplete({
        map: "#campaign-location-country",
        location: "USA"
      });
<?php endif;?>
$('.location_select').click(locationSelect);
</script>
