<?php 
$file = APPPATH . "data/campaign_categories.xml";
    if (file_exists($file)) {
        $xml = simplexml_load_file($file);
    }
?>
<div class="panel panel-default ng-scope">
    <div class="panel-heading">
        <h4 class="panel-title">
        <i class="fa fa-dot-circle-o">
        </i>&nbsp;Target Audience</h4>
        <div ng-show="targetAudience.status & gt; 0" class="small text-muted ng-hide">
            Please specify target categories for your advertisement
        </div>
    </div>
    
    <?php if(isset($campaign['location_id']) && $campaign['location_id']):?>
    <form id="campaign-target-form" action="<?php echo HTTP_BASE_URL."campaigns/save_target"?>" method="POST">
        <div class='panel-body'>
        <input type="hidden" name="campaign_id" value="<?php echo (isset($campaign['campaign_id'])?$campaign['campaign_id']:'') ?>"
        <div class="slide-animation">
            <!-- tag block 
            <b class="form-group">Key Words</b>
            <p class="small text-muted">You could target your audience by any key word in the business name of destination address.<br>e.g. you could use 'Home Depot' or 'Menards', in order to target audience who're on their way to these stores.</p>
            <div class="row ng-pristine ng-invalid ng-invalid-required">
                <div class="col-sm-10 form-group">
                    <input type="text" style="text-transform:lowercase" required="" class="form-control ng-pristine ng-invalid ng-invalid-required" name="tag">
                    <div class="slide-animation text-danger">
                        <i class="fa fa-warning">
                        </i>&nbsp;<span>Tag is required</span>
                    </div>
                </div>
                <div class="col-sm-2 form-group">
                    <button  class="btn btn-default form-control">Add</button>
                </div>
            </div>
            <div class="well">
                <div class="">You didn't specify any tag yet.</div>
            </div>
            
            end tag block -->
            
        <p class="small text-muted ng-hide">
            We will use destination address in order to determine which advertisement would be more interesting for the viewer.<br>
            Please choose for which categories your advertisement would be more interesting - you can always choose all options, but then you possibly will not be able to focus your advertisement on desired audience.<br>
            It doesn't neccessary mean that your advertisement won't show up for unchecked categories - in some cases we will use different ways to determine if advertisement might be interesting (e.g. address near destination)
        </p>

        <div>
            <div class="form-group">
                <div class="btn btn-sm btn-warning">
                <i class="fa fa-check-square-o"></i>&nbsp;Select All
                </div>
                &nbsp;
                <div class="btn btn-sm btn-warning">
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
                    <!-- ngRepeat: category in group.categories -->
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
        });
        
        function checkTarget(id) {
            var num = parseInt($('#num-'+$("#"+id).attr('data')).html());
            if($('#'+id).hasClass('fa-square-o')) {
                $("#"+id).removeClass('fa-square-o').addClass('fa-check-square-o');
                $('#num-'+$("#"+id).attr('data')).html(num+1);
                $("#checkbox-"+id).attr("checked", true);
            } else {
                $("#"+id).removeClass('fa-check-square-o').addClass('fa-square-o');
                num = num-1;
                $("#checkbox-"+id).attr("checked", false);
                if(isNaN(num)) {
                    num = '0';
                }
                $('#num-'+$("#"+id).attr('data')).html(num);
            }
        }
        function checkBlockTargets(id) {
            if($(".target-childs-"+id).find('.fa-square-o').size()>0) {
                $("."+id).removeClass('fa-square-o').addClass('fa-check-square-o');
                $('#num-'+id).html($("."+id).size());
                $(".target-childs-"+id+" input").each(function(){
                    $(this).attr("checked", true)
                });
            } else {
                $("."+id).removeClass('fa-check-square-o').addClass('fa-square-o');
                $(".target-childs-"+id+" input").each(function(){
                    $(this).attr("checked", false)
                });
                $('#num-'+id).html(0);
            }
        }
    
        <?php if(isset($campaign['target'])): 
            foreach ($campaign['target'] as $targetId): ?>
            checkTarget('<?php echo $targetId?>');
        <?php 
            endforeach; 
        endif;?>
    </script>
    <?php endif; ?>
</div>