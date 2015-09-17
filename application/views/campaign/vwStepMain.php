<?php $this->load->view('vwHeader_vw',array('bradcrumbs'=>$bradcrumbs)); 
$this->load->helper('campaign');
?>
<link href="<?php echo HTTP_CSS_PATH; ?>uploadfile.min.css" rel="stylesheet">
<script src="<?php echo HTTP_JS_PATH; ?>jquery.form.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.uploadfile.min.js"></script>

            <div ui-view="" class="ng-scope">
                <div class="panel panel-default ng-scope">
                    <?php if(isset($campaign['campaign_id'])):?>
                        <div style="background-color:#000;max-height:300px;color:#fff" class="text-center">
                            <?php if($campaign['type']=='image'): ?>
                            <div class="">
                                <?php if(isset($campaign['real_path']) && file_exists($campaign['real_path'])): ?>
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
                    &nbsp;Right now Viewswagen is in the Pilot mode, and any change to campaign will be processed with delay..
                </div>
               
                <?php if(isset($campaign['errors']) && $campaign['errors']): ?>
                    <div class="alert alert-danger ng-scope" style="white-space: nobr;">
                        <i class="fa fa-warning"></i>
                        <?php echo $campaign['errors']; ?>
                    </div>
                <?php endif;?>
                <div class="panel panel-default ng-scope">
                    <div class="panel-heading">
                        <button class="pull-right btn btn-default ng-hide">Edit</button>
                        <h4 class="panel-title"><i class="fa fa-cog"></i>&nbsp;Configuration</h4>
                        <div class="small text-muted">
                            Please configure parameters of your campaign.
                        </div>
                    </div>
                    <form id="campaign-main-form" action="<?php echo HTTP_BASE_URL."campaigns/save_main"?>" method="post" enctype="ultipart/form-data">
                        <input type="hidden" name="campaign_id" value="<?php echo (isset($campaign['campaign_id'])?$campaign['campaign_id']:'') ?>"
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
                                            <input type="hidden" value="" name="file_data" id="file-data"/>
                                        </div>
                                        <?php if(isset($campaign['campaign_id']) && $campaign['campaign_id']): ?>
                                        <div class="form-group">
                                            <b>Approval Status</b>
                                            <div class="">
                                             <?php echo (isset($campaign['status'])?campaign_status($campaign['status']):'Awaiting approval') ?>
                                                <div class="alert alert-warning">
                                                    <i class="fa fa-warning"></i>
                                                    &nbsp;If you would change campaign's image/video or landing page url, campaign will be send for pre-approval process again.
                                                </div>
                                                <button onclick="showFileUpload();" class="btn btn-primary">Edit Anyway</button>
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
    var showFrequency = function(campaign_freq){
        if(campaign_freq) {
            var values = $("#frequency-select>option").map(function() { return $(this).val(); });
            if($.inArray( campaign_freq, values )>=0) {
                $('#frequency-select').val(campaign_freq);
            } else {
                $('#frequency-select').val('custom');
            }
        }
        if($('#frequency-select').val()=="custom") {
            $('#frequency-number-div').show();
            if(campaign_freq) {
                $('#frequency-number').val(campaign_freq);
            }
        } else {
            $('#frequency-number-div').hide();
            $('#frequency-number').val('');
        }
    };
   
    var showFileUpload = function() {
        $('#file-format-div').show('slow');
    }
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
        $('#frequency-select').change(function(){
            showFrequency(false);
        });
         <?php if(isset($campaign['frequency'])):?>
            var campaign_freq = '<?php echo (isset($campaign['frequency'])?$campaign['frequency']:'0') ?>';
            showFrequency(campaign_freq);
        <?php else:?>
            showFrequency(false);
        <?php endif;?>
        $('.check-file-format').click(checkFileType);
        
        $('#campaign-main-form').bootstrapValidator({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled, :hidden',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Campaign Name is required'
                        }
                    }
                },
                landing_url: {
                    validators: {
                        notEmpty: {
                            message: ' Landing Page Url is required'
                        }
                    }
                },
                budget: {
                    validators: {
                        notEmpty: {
                            message: 'Budget for Campaign is required'
                        },
                        lessThan: {
                            value: 50000,
                            message: 'Budget for Campaign should not exceed $50,000.00'
                        },
                        greaterThan: {
                            value: 1000,
                            message: 'Min Budget for Campaign is $1,000.00'
                        }
                    }
                },
                monthly_cap: {
                    validators: {
                        notEmpty: {
                            message: 'Monthly spending cap is required'
                        },
                        lessThan: {
                            value: 50000,
                            message: 'Monthly spending cap should not exceed $50,000.00'
                        },
                        greaterThan: {
                            value: 0.01,
                            message: 'Monthly spending cap should be positive number'
                        }
                    }
                },
                daily_cap: {
                    validators: {
                        notEmpty: {
                            message: 'Daily spending cap is required'
                        },
                        lessThan: {
                            value: 50000,
                            message: 'Daily spending cap should not exceed $50,000.00'
                        },
                        greaterThan: {
                            value: 0.01,
                            message: 'Daily spending cap should be positive number'
                        }
                    }
                }
            }
        }); 
        $("#imageuploader").uploadFile({
            url:"<?php echo HTTP_BASE_URL."campaigns/upload"?>",
            multiple:false,
            autoSubmit:true,
            showDelete: true,
            showAbort: false,
            showDone: false,
            showDownload: true,
            maxFileCount:1,
            onSubmit:function() {
                $('.ajax-upload-dragdrop').hide();
            },
            downloadCallback: function (data, pd) {
                 window.open("<?php echo HTTP_BASE_URL."uploads/".$this->session->userdata('id').'/'?>"+data.data.file_name,'_blank');
            },
            deleteCallback: function() {
                $('.ajax-upload-dragdrop').show();
            },
            onSuccess: function(files,data) {
                var postData = JSON.stringify(data);
                $('#file-data').val(postData);
            }
	});
        $("#videouploader").uploadFile({
            url:"<?php echo HTTP_BASE_URL."campaigns/upload"?>",
            multiple:false,
            autoSubmit:true,
            showDelete: true,
            showDone: false,
            showDownload: true,
            maxFileCount:1,
            onSubmit:function() {
                $('.ajax-upload-dragdrop').hide();
            },
            downloadCallback: function (data, pd) {
                 window.open("<?php echo HTTP_BASE_URL."uploads/"?>"+data.data.file_name,'_blank');
            },
            deleteCallback: function() {
                $('.ajax-upload-dragdrop').show();
            }
	});
        $('.ajax-file-upload-abort').click(function(){
            $('.ajax-upload-dragdrop').show();
        });
    });
</script>
<a href="#" id="tmpLink"></a>
<?php $this->load->view('vwFooter_vw'); ?>