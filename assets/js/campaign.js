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
    $('#approval_status_div').hide();
}

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

var addDataToPreview = function(formId,previewId) {
    var html = '';
    switch(formId) {
        case "campaign-location-form":
            $('#'+formId+' span').each(function(){
                if($('#'+$(this).attr('for')).hasClass('fa-check-square-o') && typeof $(this).closest('.form-group').find('b').html() !='undefined') {
                    var value = $(this).html();
                    html = html+"<div class='preview_item'><b>"+$(this).closest('.form-group').find('b').html()+"</b><br> "+value+"</div>";
                    $($(this).closest('div.address-group')).find('input,select').each(function(){
                        if(typeof $(this).closest('.form-group').find('b').html() !='undefined' && $(this).val()) {
                            html = html+"<div class='preview_item'><b>"+$(this).closest('.form-group').find('b').html()+"</b><br> "+$(this).val()+"</div>";
                        }
                    });
                }
            });
            break;
        case "campaign-target-form":
            var htmlList = [];
            var i = 0;
            $('#'+formId+' span').each(function(){
                
                if($('#'+$(this).attr('for')).hasClass('fa-check-square-o') && $(this).html()!="") {
                    htmlList[i] = $(this).html();
                    i++;
                }
            }); 
            html = "<div class='preview_item' style='width:98%'>"+htmlList.join()+"</div>";
            break;
        case "campaign-schedule-form":
            $('#'+formId+' span').each(function(){
                if($('#'+$(this).attr('for')).hasClass('fa-check-square-o') && typeof $(this).closest('.form-group').find('b').html() !='undefined') {
                    var value = $(this).html();
                     if($('#'+$(this).attr('for')).attr('id')=='campaign-start-custom' || $('#'+$(this).attr('for')).attr('id')=='campaign-end-custom') {
                       value = $('.'+$('#'+$(this).attr('for')).attr('id')).val();
                    }
                    html = html+"<div class='preview_item'><b>"+$(this).closest('.form-group').find('b').html()+"</b><br> "+value+"</div>";
                }
            }); 
        default:
            $('#'+formId+' input,#'+formId+' input,#'+formId+' select').not(':input[type=hidden]').each(function(){
                if(typeof $(this).closest('.form-group').find('b').html() !='undefined' && $(this).val()) {
                    html = html+"<div class='preview_item'><b>"+$(this).closest('.form-group').find('b').html()+"</b><br> "+$(this).val()+"</div>";
                }
            });
    }
    $('#'+previewId).append(html);
}

var checkParentBlock = function(id) {
    var checked = 0;
    var total = 0;
    $(".target-childs-"+id+" input[type=checkbox]").each(function(){
        total++;
        if($(this).attr("data")=='1') {
           checked++;
        }
    });
    if(checked==total) {
        $("#"+id).removeClass('fa-square-o').addClass('fa-check-square-o');
    } else {
        $("#"+id).removeClass('fa-check-square-o').addClass('fa-square-o');
    }
}

var checkTarget = function(id,selectAll) {
    var num = parseInt($('#num-'+$("#"+id).attr('data')).html());

    if($('#'+id).hasClass('fa-square-o')) {
        if(typeof selectAll!='undefined' && selectAll==0) {
            return true;
        }
        $("#"+id).removeClass('fa-square-o').addClass('fa-check-square-o');
        $('#num-'+$("#"+id).attr('data')).html(num+1);
        $("#checkbox-"+id).attr("checked", true);
        $("#checkbox-"+id).attr("data",'1');
    } else {
        if(typeof selectAll!='undefined' && selectAll==1) {
            return true;
        }
        num = num-1;
        if(isNaN(num)) {
            num = '0';
        }
        $('#num-'+$("#"+id).attr('data')).html(num);
        $("#"+id).removeClass('fa-check-square-o').addClass('fa-square-o');
        $("#checkbox-"+id).attr("checked", false);
        $("#checkbox-"+id).attr("data",'0');
    }
    checkParentBlock($('#'+id).attr('data'));
}
var checkBlockTargets = function(id) {
    if($(".target-childs-"+id).find('.fa-square-o').size()>0) {
        $("."+id).removeClass('fa-square-o').addClass('fa-check-square-o');
        $('#num-'+id).html($("."+id).size());
        $(".target-childs-"+id+" input").each(function(){
            $(this).attr("checked", true);
        });
        $("#"+id).removeClass('fa-square-o').addClass('fa-check-square-o');
    } else {
        $("."+id).removeClass('fa-check-square-o').addClass('fa-square-o');
        $(".target-childs-"+id+" input").each(function(){
            $(this).attr("checked", false);
        });
        $("#"+id).removeClass('fa-check-square-o').addClass('fa-square-o');
        $('#num-'+id).html(0);
    }
}
$("#campaign-target-form .btn-warning").click(function(){
    var select = 0;
    if($(this).attr('id')=='select_all') {
       select=1;
    }
    $("#campaign-target-form i").each(function(){
        checkTarget($(this).attr('id'),select);
    });
});

// add observers and others after page load
$(document).ready(function() {
    addDataToPreview('campaign-main-form','campaign-main-preview');
    addDataToPreview('campaign-schedule-form','campaign-schedule-preview');
    addDataToPreview('campaign-location-form','campaign-location-preview');
    addDataToPreview('campaign-target-form','campaign-target-preview');
    
    $('.button-edit').click(function(){
        var id = $(this).attr('id');
        var prefix_div = id.replace('button-edit-','');
        if($('#'+prefix_div+'-form').is(":visible")) {
            $('#'+prefix_div+'-preview').show('slow');
            $('#'+prefix_div+'-form').hide('slow');
            $(this).html('Edit');
        } else {
            $('#'+prefix_div+'-preview').hide('slow');
            $('#'+prefix_div+'-form').show('slow');
            $(this).html('Close');
        }
    });
    
    // initialize input widgets first
    $('#time_picker .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });
    $('#time_picker').datepair();
     $('.week_days').click(campaignWeekDays);
    
    campaignStart();
    campaignEnd();
    
    $('button').each(function(){
        $(this).prop("disabled", false);
    });
    
    $('.target-block').click(function(){
       checkBlockTargets($(this).attr('id'));
    });
    $('.target-block-span').click(function(){
       checkBlockTargets($(this).attr('for'));
    });

    $(".target-childs i").click(function(){
       checkTarget($(this).attr('id'));
    });

    $(".target-childs span").click(function(){
       checkTarget($(this).attr('for'));
       checkParentBlock($('#'+$(this).attr('for')).attr('data'));
    });
    
    $('#campaign-main-form').validate({
        ignore: ":disabled, :hidden",
        rules: {
            name: {
                required:true
            },
            landing_url: {
                required:true,
                url: true
            },
            budget: {
                required:true,
                min:1000,
                max:50000
            },
            monthly_cap: {
                required:true,
                min:0.01,
                max:50000
            },
            daily_cap: {
                required:true,
                min:0.01,
                max:50000
            }
        },
        messages: {
            name: {
                required: "Campaign Name is required",    
            },
            landing_url: {
                required: "Landing Page Url is required",    
                url: "Please enter a valid URL"
            },
            budget: {
                required: "Budget for Campaign is required",
                min: "Min Budget for Campaign is $1,000.00",
                max: "Budget for Campaign should not exceed $50,000.00"
            },
            monthly_cap: {
                required: "Monthly spending cap is required",
                min: "Monthly spending cap should be positive number",
                max: "Monthly spending cap should not exceed $50,000.00"
            },
            daily_cap: {
                required: "Daily spending cap is required",
                min: "Daily spending cap should be positive number",
                max: "Daily spending cap should not exceed $50,000.00"
            }
        }
    });
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
});