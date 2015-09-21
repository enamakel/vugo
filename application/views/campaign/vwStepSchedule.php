<link href="<?php echo HTTP_CSS_PATH; ?>jquery.timepicker.css" rel="stylesheet">
<link href="<?php echo HTTP_CSS_PATH; ?>jquery-ui.min.css" rel="stylesheet">
<script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.timepicker.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>datepair.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.datepair.js"></script>
  
<script type="text/javascript">
    $(function() {
        $( "#datetimepicker6" ).datepicker({
            defaultDate: "",
            changeMonth: true,
            numberOfMonths: 1,
            buttonImageOnly: true,
            showOn: "both",
            buttonImage: "<?php echo HTTP_IMAGES_PATH; ?>calendar.png",
            buttonText: "Select date",
            onClose: function( selectedDate ) {
              $( "#datetimepicker7" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $('#trigger').click(function() {
            $('#dp').datepicker('show');
        });
        $( "#datetimepicker7" ).datepicker({
            defaultDate: "",
            changeMonth: true,
            showOn: "both",
            buttonImageOnly: true,
            buttonImage: "<?php echo HTTP_IMAGES_PATH; ?>calendar.png",
            buttonText: "Select date",
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
              $( "#datetimepicker6" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
</script>
<a name="schedule"></a>
<div class="panel panel-default ng-scope">
    <div class="panel-heading">
        <h5 class="panel-title">
        <i class="fa fa-calendar">
        </i>&nbsp;Schedule</h5>
        <div  class="small text-muted <?php if(!isset($campaign) || !isset($campaign['campaign_id'])):?>ng-hide<?php endif;?>">Please choose schedule for your campaign</div>
    </div>
    <?php if(isset($campaign) && isset($campaign['campaign_id'])):?>
    <div class="slide-animation">
        <form id="campaign-schedule-form" action="<?php echo HTTP_BASE_URL."campaigns/save_schedule"?>" method="POST">
            <input type="hidden" name="campaign_id" value="<?php echo (isset($campaign['campaign_id'])?$campaign['campaign_id']:'') ?>"
            <div  class="panel-body ng-pristine ng-valid ng-valid-required">
                <?php //echo "<pre>"; print_r($campaign); exit; ?>
                <div class="row container">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <b>Campaign starts...</b>
                            <div >
                                <div  style="cursor:pointer">
                                    <i id="campaign-start-now" class="fa campaign-start <?php if(isset($campaign['date_start']) && $campaign['date_start']=="00/00/0000"):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="campaign-start" for="campaign-start-now">&nbsp;as soon as possible (once approved)</span>
                                </div>
                                <div style="cursor:pointer">
                                    <i id="campaign-start-custom" class="fa campaign-start <?php if(isset($campaign['date_start']) && $campaign['date_start']!="00/00/0000"):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="campaign-start" for="campaign-start-custom">&nbsp;on specific date</span>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-5 campaign-start-div' id="campaign-start-custom-div" style="<?php if(isset($campaign['date_start']) && $campaign['date_start']=="00/00/0000"):?>display: none;<?php endif;?>">
                            <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text'  id='datetimepicker6' value='<?php echo (isset($campaign['date_start'])?$campaign['date_start']:"00/00/0000")?>' name="date_start" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <b>Campaign ends...</b>
                            <div>
                                <div  style="cursor:pointer">
                                    <i id="campaign-end-now" class="fa campaign-end <?php if(isset($campaign['date_end']) && $campaign['date_end']=="00/00/0000"):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="campaign-end" for="campaign-end-now">&nbsp;once balace is 0</span>
                                </div>
                                <div style="cursor:pointer">
                                    <i id="campaign-end-custom" class="fa campaign-end <?php if(isset($campaign['date_end']) && $campaign['date_end']!="00/00/0000"):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>"></i><span class="campaign-end" for="campaign-end-custom">&nbsp;on specific date</span>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-5 campaign-end-div' id="campaign-end-custom-div" style="<?php if(isset($campaign['date_end']) && $campaign['date_end']=="00/00/0000"):?>display: none;<?php endif;?>">
                            <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text' id='datetimepicker7' name="date_end" value="<?php echo (isset($campaign['date_end'])?$campaign['date_end']:"00/00/0000")?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row container">
                <div class="col-md-6">
                    <b>Days</b>
                    <div>
                        <p class="small text-muted">Please specify on day range for campaign schedule</p>
                        <div style="cursor:pointer" class="ng-scope">
                            <i id="week_days_all" class="week_days fa <?php if(isset($campaign['week_days']) && $campaign['week_days']=="1"):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>">
                            </i>&nbsp;<span for="week_days_all" class="week_days ng-scope">All Week</span>
                        </div>
                        <div style="cursor:pointer" class="ng-scope">
                            <i id="week_days_week" class="week_days fa <?php if(isset($campaign['week_days']) && $campaign['week_days']=="2"):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>">
                            </i>&nbsp;<span for="week_days_week" class="week_days ng-scope">Week days</span>
                        </div>
                        <div style="cursor:pointer" class="ng-scope">
                            <i id="week_days_weekend" class="week_days fa <?php if(isset($campaign['week_days']) && $campaign['week_days']=="3"):?>fa-check-square-o<?php else:?>fa-square-o<?php endif;?>">
                            </i>&nbsp;<span for="week_days_weekend" class="week_days ng-scope">Weekends</span>
                        </div>
                        <input type="hidden" id="week_days" name="week_days" value="<?php echo (isset($campaign['week_days'])?$campaign['week_days']:"1")?>"/>
                    </div>
                </div>
                <div id="time_picker" class="col-md-6">
                    <b>Time</b>
                    <p class="small text-muted">Please specify on time range for campaign schedule</p>
                    <div class="form-group row">
                        <div class="col-sm-6">From
                            <div class="">
                                <div class="form-group">
                                    <input type="text" name="schedule_from" class="time start form-control" value="<?php echo (isset($campaign['schedule_from'])?$campaign['schedule_from']:"")?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">Until
                            <div class="">
                                <div class="form-group">
                                    <input type="text" name="schedule_until" class="time end form-control" value="<?php echo (isset($campaign['schedule_until'])?$campaign['schedule_until']:"")?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center" style="margin-bottom: 15px">
                <button type="reset" class="btn btn-default">Cancel</button>&nbsp; 
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </form>   
    </div>
    <?php endif;?>
</div>


<?php $this->load->view('campaign/vwStepLocation',array('campaign'=>$campaign)); ?>

<script type="text/javascript">
    var campaignStart = function(event) {
       
        $('i.campaign-start').each(function(){
            $(this).removeClass('fa-check-square-o');
            $(this).removeClass('fa-square-o');
            $(this).addClass('fa-square-o');
        });
        var existDate = '<?php echo isset($campaign['date_start']) && $campaign['date_start']!='00/00/0000'?$campaign['date_start']:""?>';
            
        if(event) {
            var el = $(event.currentTarget);
            if(!$(event.currentTarget).is('i')) {
                el = $("#"+el.attr('for'));
            }
        } else {
            var el = $('#campaign-start-now');
            if(existDate) {
                el = $('#campaign-start-custom');
            }
        }
        el.removeClass('fa-square-o');
        el.addClass('fa-check-square-o');
        $('.campaign-start-div').hide();
        $('#'+el.attr('id')+'-div').show();
        if(el.attr('id')=='campaign-start-now') {
            $('#datetimepicker6').val('00/00/0000');
        }
        if(el.attr('id')=='campaign-start-custom') {
            $('#datetimepicker6').val('<?php echo date('m/d/Y')?>');
            if(existDate!='') {
                $('#datetimepicker6').val(existDate);
            }
        }
    };
    var campaignWeekDays = function(event) {
      
        $('i.week_days').each(function(){
            $(this).removeClass('fa-check-square-o');
            $(this).removeClass('fa-square-o');
            $(this).addClass('fa-square-o');
        });
            var el = $(event.currentTarget);
        if(!$(event.currentTarget).is('i')) {
            el = $("#"+el.attr('for'));
        }
       
        el.removeClass('fa-square-o');
        el.addClass('fa-check-square-o');
        if(el.attr('id')=='week_days_all') {
            $('#week_days').val('1');
        }
        if(el.attr('id')=='week_days_week') {
            $('#week_days').val('2');
        }
        if(el.attr('id')=='week_days_weekend') {
            $('#week_days').val('3');
        }
    };
    var campaignEnd = function(event) {
       
        $('i.campaign-end').each(function(){
            $(this).removeClass('fa-check-square-o');
            $(this).removeClass('fa-square-o');
            $(this).addClass('fa-square-o');
        });
        var existDate = '<?php echo isset($campaign['date_end']) && $campaign['date_end']!='00/00/0000'?$campaign['date_end']:""?>';
           
        if(event) {
            var el = $(event.currentTarget);
            if(!$(event.currentTarget).is('i')) {
                el = $("#"+el.attr('for'));
            }
        } else {
            var el = $('#campaign-end-now');
            if(existDate) {
                el = $('#campaign-end-custom');
            }
        }
       
        el.removeClass('fa-square-o');
        el.addClass('fa-check-square-o');
        $('.campaign-end-div').hide();
        $('#'+el.attr('id')+'-div').show();
        if(el.attr('id')=='campaign-end-now') {
            $('#datetimepicker7').val('00/00/0000');
        }
        if(el.attr('id')=='campaign-end-custom') {
            $('#datetimepicker7').val('<?php echo date('m/d/Y')?>');
             if(existDate!='') {
                $('#datetimepicker7').val(existDate);
            }
        }
    };
    
        // initialize input widgets first
    $('#time_picker .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });
    $('#time_picker').datepair();
    
    $('.campaign-end').click(campaignEnd);
    $('.campaign-start').click(campaignStart);
    $('.week_days').click(campaignWeekDays);
    campaignStart();
    campaignEnd();

    $('#campaign-schedule-form').validate({
        ignore: ":disabled, :hidden",
        rules: {
            date_start: {
                required:true,
                date:'MM/DD/YYYY'
            },
            date_end: {
                required:true,
                date:'MM/DD/YYYY'
            },
            schedule_from: {
                required:true
            },
            schedule_until: {
                required:true
            }
        },
        messages: {
            date_start: {
                required: "Campaign Date Starts is required",
                date: 'The value is not a valid date'
            },
            date_end: {
                required: "Campaign Date Ends is required",    
                date: 'The value is not a valid date'
            },
            schedule_from: {
                required: "Campaign Schedule From Time is required"
            },
            schedule_until: {
                required: "Campaign Schedule Until Time is required"
            }
        }
    });
        $('button').each(function(){
            $(this).prop("disabled", false);
        });
</script>