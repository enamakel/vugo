<?php $this->load->view('vwHeader_vw',array('bradcrumbs'=>$bradcrumbs)); 
$this->load->helper('campaign');
$this->load->helper('url');
?>
<link href="<?php echo HTTP_CSS_PATH; ?>jquery.fileupload.css" rel="stylesheet">
<script src="<?php echo HTTP_JS_PATH; ?>jquery.form.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>campaign.js"></script>
<link href="<?php echo HTTP_CSS_PATH; ?>jquery.timepicker.css" rel="stylesheet">
<link href="<?php echo HTTP_CSS_PATH; ?>jquery-ui.min.css" rel="stylesheet">

<script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.ui.widget.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.iframe-transport.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.fileupload.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.timepicker.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>datepair.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.datepair.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCW5VsEDH465TQ30juUufywDJ9Sk0zEx4Y&libraries=places"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.geocomplete.min.js"></script>
<div ui-view="" class="ng-scope">
    <div class="panel panel-default ng-scope">
        <?php if(isset($campaign['campaign_id'])):?>
            <div style="background-color:#000;max-height:300px;color:#fff" class="text-center">
                <?php if($campaign['type']=='image'): ?>
                <div class="">
                    <?php  if(isset($campaign['real_path']) && file_exists($campaign['real_path'])): ?>
                        <img src="<?php echo $campaign['absolute_url']?>" style="max-height: 300px">
                    <?php else:?>
                         <div class="panel-body text-center">
                            <i class="fa fa-ban"></i>&nbsp;Image for preview wasn't specified yet.
                        </div>
                    <?php endif;?>
                </div>
                <?php else: ?>
                <div class="">
                    <div class="panel-body text-center">
                        <i class="fa fa-ban"></i>&nbsp;Video for preview wasn't specified yet.
                    </div>
                </div>
                <?php endif;?>
            </div>
              <?php else: ?>
            <div class="panel-body text-center">Note: it's possible that preview won't work if campaign is not approved yet.</div>
        <?php endif;?>
    </div>

    <div class="alert alert-warning ng-scope">
        <i class="fa fa-warning"></i>
        &nbsp;Right now Vugo is in the Pilot mode, and any change to campaign will be processed with delay..
    </div>
        <?php if(isset($campaign['errors']) && $campaign['errors']): ?>
        <div class="alert alert-danger ng-scope" style="white-space: nobr;">
            <i class="fa fa-warning" style="float:left;"></i>
            <ul>
                <?php echo str_replace('p>','li>',$campaign['errors']); ?>
            </ul>
        </div>
    <?php endif;?>
    <div class="panel panel-default ng-scope">
        <div class="panel-heading">
            <button id="button-edit-campaign-main" class="pull-right btn btn-default button-edit <?php echo (isset($campaign['campaign_id'])?'':'ng-hide') ?>">Edit</button>
            <h4 class="panel-title"><i class="fa fa-cog"></i>&nbsp;Configuration</h4>
            <div class="small text-muted">
                Please configure parameters of your campaign.
            </div>
        </div>
        <div id="campaign-main-preview" class="campaign_preview <?php echo (isset($campaign['campaign_id'])?'':'ng-hide') ?>"></div>
        <form id="campaign-main-form" class="form <?php echo (!isset($campaign['campaign_error']) && isset($campaign['campaign_id'])?'ng-hide':'') ?>" action="<?php echo HTTP_BASE_URL."campaigns/save_main"?>" method="post" enctype="ultipart/form-data">
            <input type="hidden" name="campaign_id" value="<?php echo (!isset($campaign['campaign_error']) && isset($campaign['campaign_id'])?$campaign['campaign_id']:'') ?>"
            <div class="slide-animation">
                <div ng-form="configurationForm" class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>Campaign Name</b>
                                <div class="slide-animation">
                                    <input type="text" placeholder="Campaign name" name="name" value="<?php echo (isset($campaign['name'])?$campaign['name']:'') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <b>Landing Page</b>
                                <div class="slide-animation">
                                    <input type="text" placeholder="Campaign Landing Page Url" name="landing_url" value="<?php echo (isset($campaign['landing_url'])?$campaign['landing_url']:'') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <b>Advertisement Type</b>
                                <div  class="slide-animation">
                                    <p class="small text-muted">Please choose if you want to create image or video campaign.</p>
                                    <div style="cursor:pointer" class="ng-scope">
                                        <i id="file-format-image" class="check-file-format fa fa-check-square-o"></i>&nbsp;<span translate="" class="check-file-format ng-scope" for="file-format-image">Image</span>
                                    </div>
                                    <div style="cursor:pointer" class="ng-scope">
                                        <i id="file-format-video" class="check-file-format fa fa-square-o"></i>&nbsp;<span translate="" class="check-file-format ng-scope" for="file-format-video">Video</span>
                                    </div>
                                </div>
                                <input type="hidden" id="file-format-input" name="type" value="<?php echo (isset($campaign['type'])?$campaign['type']:'image') ?>" />
                            </div>

                            <div id="file-format-div" class="form-group" <?php if(isset($campaign['campaign_id']) && $campaign['campaign_id']): ?>style="display: none;"<?php endif;?>>
                                <div class="alert alert-warning small">
                                    Please select file that you would want to advertise for the campaign.
                                    <br>Note: we will pre-process the file before we will start advertise it.
                                    <div class="file-format-image-div upload-form">
                                        <br>One penny per impression
                                    </div>
                                    <div class="file-format-video-div upload-form" style="display: none;">
                                        <br>Videos are charged per second. 1 minute cost is 50 cents.
                                    </div>
                                </div>
                                <div class="file-format-image-div upload-form">
                                    <div class="clearfix">
                                        <div class="row ng-scope">
                                            <div class="col-sm-4">
                                                <div id="imageuploader">
                                                    <span class="ng-scope" translate="">Upload Image File</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="file-format-video-div upload-form" style="display: none;">
                                    <div  class="clearfix ng-isolate-scope">
                                        <div class="row ng-scope">
                                            <div class="col-sm-4">
                                                <div id="videouploader">
                                                    <span class="ng-scope" translate="">Upload Video File</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Select file</span>
                                        <!-- The file input field used as target for the file upload widget -->
                                        <input id="fileupload" type="file" name="file" multiple>
                                    </span>
                                <div class="progress" id="progress">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <input type="hidden" value="" name="file_data" id="file-data"/>
                            </div>
                            <?php if(isset($campaign['campaign_id']) && $campaign['campaign_id']): ?>
                            <div class="form-group" id="approval_status_div">
                                <b>Approval Status</b>
                                <div class="">
                                 <?php echo (isset($campaign['status'])?campaign_status($campaign['status']):'Awaiting approval') ?>
                                    <div class="alert alert-warning">
                                        <i class="fa fa-warning"></i>
                                        &nbsp;If you would change campaign's image/video or landing page url, campaign will be send for pre-approval process again.
                                    </div>
                                    <button onclick="showFileUpload();" type="button" class="btn btn-primary">Edit Anyway</button>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>Campaign budget</b>
                                <div  class="slide-animation">
                                    <input value="<?php echo (isset($campaign['budget'])?$campaign['budget']:'') ?>" type="text" class="form-control" max="50000" min="1000" placeholder="$0.00" name="budget">
                                </div>
                            </div>
                            <div class="form-group">
                                <b>Monthly spending cap</b>
                                <div class="slide-animation">
                                    <input type="text" class="form-control" max="500000" min="0"  placeholder="$0.00" name="monthly_cap" value="<?php echo (isset($campaign['monthly_cap'])?$campaign['monthly_cap']:'') ?>">
                                </div>
                                <div class="form-group">
                                    <b>Daily spending cap</b>
                                    <div class="slide-animation">
                                        <input type="text" class="form-control" max="500000" min="0" placeholder="$0.00" name="daily_cap" value="<?php echo (isset($campaign['daily_cap'])?$campaign['daily_cap']:'') ?>">
                                    </div>
                                    <div>
                                        <b>Frequency cap per trip</b>
                                        <div class="slide-animation">
                                            <div class="form-group">
                                                <select name="frequency" id="frequency-select" class="form-control">
                                                    <option value="0" class="">Unlimited</option>
                                                    <option value="1" label="1">1</option>
                                                    <option value="2" label="2">2</option>
                                                    <option value="3" selected="selected" label="3">3</option>
                                                    <option value="5" label="5">5</option>
                                                    <option value="10" label="10">10</option>
                                                    <option value="custom" label="Custom">Custom</option>
                                                </select>
                                            </div>
                                            <div id="frequency-number-div" class="slide-animation" style="display: none;">
                                                <div class="form-group">
                                                    <input type="number" max="100" min="1" class="form-control" placeholder="Enter number" id="frequency-number" name="frequency_number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="reset" class="btn btn-default">Cancel</button>&nbsp; 
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $this->load->view('campaign/vwStepSchedule',array('campaign'=>isset($campaign)?$campaign:array())); ?>
<script type="text/javascript">
    $('#fileupload').fileupload({
        url: '<?php echo site_url('campaigns/upload');?>',
        dataType: 'json',
        start: function(e,data) {
            $('#file-info').remove();
            $('#upload-error').remove();
//            $('.btn-success').hide();
            $('#progress').show();
            $('.progress .progress-bar').css('width', '0%'); 
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
           
            $('.progress .progress-bar').css('width', progress + '%'); 
        },
        done: function (e, data) {
            var seen = [];
            if(data.result.error != undefined){
                $('#file-format-div').append("<div class='error' id='upload-error'></div>");
                $('#upload-error').html(data.result.error); // add error
                $('#upload-error').fadeIn('slow');
            } else{
                $('#upload-error').hide(); // hide error
                $('.fileinput-button span').html('Select other');
                $('#file-format-div').append("<div class='file-info' id=file-info><span class='file_name'>File name: "+data.result.orig_name+"</span></div>");
                $('#file-data').val(JSON.stringify(data,function(key, val) {
                        if (val != null && typeof val == "object") {
                            if (seen.indexOf(val) >= 0) {
                                return;
                            }
                            seen.push(val);
                        }
                        return val;
                    })
                );
                if(data.result.image_width) {
                    $('#file-info').append("("+data.result.image_width+"x"+data.result.image_height+")");
                }
            }
            $('#progress').hide();
        }
    });

    var checkFileType = function(event) {
        if(!$('#file-format-div').is(":visible")) {
            return;
        }
        $('i.check-file-format').each(function(){
            $(this).removeClass('fa-check-square-o');
            $(this).removeClass('fa-square-o');
            $(this).addClass('fa-square-o');
        })
        var el = $(event.currentTarget);
        if(!$(event.currentTarget).is('i')) {
            el = $("#"+el.attr('for'));
        }
       
        el.removeClass('fa-square-o');
        el.addClass('fa-check-square-o');
        $('.upload-form').hide();
        $('.'+el.attr('id')+'-div').show();
        $('#file-format-input').val(el.attr('id').split('-').pop());
    };
    $(document).ready(function() {
        $('.check-file-format').click(checkFileType);
        
        $('#frequency-select').change(function(){
            showFrequency(false);
        });
         <?php if(isset($campaign['frequency'])):?>
            var campaign_freq = '<?php echo (isset($campaign['frequency'])?$campaign['frequency']:'0') ?>';
            showFrequency(campaign_freq);
        <?php else:?>
            showFrequency(false);
        <?php endif;?>
        
    }); 
 
</script>
<a href="#" id="tmpLink"></a>
<?php $this->load->view('vwFooter_vw'); ?>