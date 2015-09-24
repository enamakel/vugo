function addDataToPreview(formId,previewId) {
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
            $('#'+formId+' input,#'+formId+' input,select').not(':input[type=hidden]').each(function(){
                if(typeof $(this).closest('.form-group').find('b').html() !='undefined') {
                    html = html+"<div class='preview_item'><b>"+$(this).closest('.form-group').find('b').html()+"</b><br> "+$(this).val()+"</div>";
                }
            });
    }
    $('#'+previewId).append(html);
     
}
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
});