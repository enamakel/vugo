<?php 
$file = APPPATH . "data/campaign_categories.xml";
    if (file_exists($file)) {
        $xml = simplexml_load_file($file);
    }
?>
<div class="panel panel-default ng-scope">
    <div class="panel-heading">
        <button id="button-edit-campaign-target" class="pull-right btn button-edit btn-default <?php echo (isset($campaign['target_id'])?'':'ng-hide') ?>">Edit</button>
        <h4 class="panel-title"><i class="fa fa-dot-circle-o"></i>&nbsp;Target Audience</h4>
        <div ng-show="targetAudience.status & gt; 0" class="small text-muted">
            Please specify target categories for your advertisement
        </div>
    </div>
    
    <?php if(isset($campaign['location_id']) && $campaign['location_id']):?>
    <div id="campaign-target-preview" class="campaign_preview <?php echo (isset($campaign['target_id'])?'':'ng-hide') ?>"></div>
    <form id="campaign-target-form" class='<?php echo (isset($campaign['target_id'])?'ng-hide':'') ?>' action="<?php echo HTTP_BASE_URL."campaigns/save_target"?>" method="POST">
        <div class='panel-body'>
        <input type="hidden" name="campaign_id" value="<?php echo (isset($campaign['campaign_id'])?$campaign['campaign_id']:'') ?>"
        <div class="slide-animation">
        
        <p class="small text-muted ng-hide">
            We will use destination address in order to determine which advertisement would be more interesting for the viewer.<br>
            Please choose for which categories your advertisement would be more interesting - you can always choose all options, but then you possibly will not be able to focus your advertisement on desired audience.<br>
            It doesn't neccessary mean that your advertisement won't show up for unchecked categories - in some cases we will use different ways to determine if advertisement might be interesting (e.g. address near destination)
        </p>

        <div>
            <div class="form-group">
                <div id='select_all' class="btn btn-sm btn-warning">
                <i class="fa fa-check-square-o"></i>&nbsp;Select All
                </div>
                &nbsp;
                <div id='unselect_all' class="btn btn-sm btn-warning">
                    <i class="fa fa-square-o"></i>&nbsp;Clear Selection
                </div>
            </div>
            <?php foreach ($xml as $mainCategory): 
                $blockCode = md5(rand(1, 99999999999999999));
                $childsNum = count($mainCategory->childs->category);
                ?>
            <div  class="form-group ng-scope">
                <div style="cursor:pointer">
                    <i id='<?php echo $blockCode?>' class="target-block fa fa-square-o"></i>&nbsp; 
                    <span for='<?php echo $blockCode?>' translate="<?php echo $mainCategory->title;?>" class="target-block-span ng-scope">
                        <?php echo $mainCategory->title;?>
                    </span>&nbsp;
                    <span class="ng-binding">(<span class='selected-target-block' id='num-<?php echo $blockCode?>'>0</span>/<?php echo $childsNum?>)</span>
                </div> 
                <?php if($childsNum>0):?>
                <div style="padding-left:20px" class="row target-childs small target-childs-<?php echo $blockCode?>">
                    <?php foreach($mainCategory->childs->category as $child): ?>
                    <div style="cursor:pointer" class="col-sm-3 ng-scope">
                        <i id='<?php echo $child->code;?>' data='<?php echo $blockCode?>' class=" <?php echo $blockCode?> fa fa-square-o"></i>&nbsp;
                        <input type='checkbox' class='ng-hide' id='checkbox-<?php echo $child->code;?>' name='target[]' value='<?php echo $child->code;?>' />
                        <span for='<?php echo $child->code;?>' translate="<?php echo $child->title;?>" class="target-childs-span ng-scope">
                            <?php echo $child->title;?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif;?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center" style="margin-top:20px;">
            <button type="reset" class="btn btn-default">Cancel</button>&nbsp; 
            <button type="submit" class="btn btn-primary">Continue</button>
        </div>
    </div>
    </form>
    <script type='text/javascript'>
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

        function checkParentBlock(id) {
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
        
        function checkTarget(id,selectAll) {
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
        function checkBlockTargets(id) {
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
        <?php if(isset($campaign['target'])): 
            foreach ($campaign['target'] as $targetId): ?>
            checkTarget('<?php echo $targetId?>');
        <?php 
            endforeach; 
        endif;?>
    </script>
    <?php endif; ?>
</div>