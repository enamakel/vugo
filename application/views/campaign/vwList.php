<?php $this->load->view('vwHeader_vw'); 
$this->load->helper('campaign');
?>
<div class="slide-animation vw-scope" style="">
    <div class="form-group ng-scope">
        <a class="btn btn-primary" href="<?php echo HTTP_BASE_URL?>campaigns/campaign">
            <i class="fa fa-plus"></i>&nbsp;Add Campaign
        </a>
    </div>
    <?php if(!isset($campaignList) || count($campaignList)<1 || !is_array($campaignList)): ?>
       <div class="form-group">You don't have any campaigns yet..</div>
    <?php else:?>
        <div class="panel-content panel panel-default">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th class="col-sm-6">Name</th>
                        <th class="col-sm-2">Approval</th>
                        <th class="col-sm-2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($campaignList as $_item): ?>
                    <tr>
                        <td><?php echo $_item['name'] ?></td>
                        <td><?php echo campaign_status($_item['status']) ?></td>
                        <td>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a style="width:100%" class="btn btn-primary btn-sm" href="<?php echo HTTP_BASE_URL?>campaigns/campaign/<?php echo $_item['campaign_id']?>">View</a>
                                </div>
                                <div class="col-sm-6">
                                    <a style="width:100%" onclick="campaignRemove(<?php echo $_item['campaign_id']?>)" class="btn btn-default btn-sm">
                                        <span class="">Remove</span>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif;?>
</div>
<script type="text/javascript">
var campaignRemove = function(item_id) {
    if (confirm('Are you sure that you want to remove campaign? This aciton cannot be undone!')) {
        return location.href= "<?php echo HTTP_BASE_URL?>campaigns/remove/"+item_id;
    }
}
</script>
    <?php $this->load->view('vwFooter_vw'); 
?>