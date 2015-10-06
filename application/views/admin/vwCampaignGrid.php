<?php
    $this->load->view('admin/vwHeader');
    $this->load->helper('campaign');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>User management <small>Overview</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-users"></i> User Campaigns</a></li>
                <li class="active"><i class="fa fa-table"></i> Grid</li>        
                <button onclick="location.href='<?php echo base_url(); ?>admin/user/add'" class="btn btn-success" type="button" style="float:right;">Add New Campaign</button>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <?php echo $pagination; ?>
        </div>
    </div> 
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr>
                    <th><i class="fa fa-sort"></i>Campaign #</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Title</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Landing Url</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Advertisement Type</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Budget</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Owner</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Status</th>
                    <th width="140px" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($campaigns as $_campaign):?>
                    <tr>
                        <td><?php echo $_campaign->campaign_id; ?></td>
                        <td><?php echo $_campaign->name; ?></td>
                        <td><?php echo $_campaign->landing_url; ?></td>
                        <td><?php echo $_campaign->type; ?></td>
                        <td><?php echo $_campaign->budget; ?></td>
                        <td><?php echo renderer_owner($_campaign); ?></td>
                        <td><?php echo campaign_status($_campaign->status); ?></td>
                        <td><a href="<?php echo base_url(); ?>admin/user/edit/<?php echo $_campaign->user_id; ?>" class="btn btn-primary btn-s">Edit</a>
                            <a href="#" data-user="<?php echo $_campaign->user_id; ?>" class="user-delete btn btn-danger btn-s">Delete</a></td>
                    </tr>
                 <?php endforeach;?>
            </tbody>
        </table>
    </div> 
    <div class="row">
        <div class="col-md-12 text-right">
            <?php echo $pagination; ?>
        </div>
    </div> 
</div>
<script type="text/javascript">
    var deleteUserConfirm = function() {
        var user_id = $(this).attr('data-user');
        bootbox.confirm("Are you sure delete this user?", function(result) {
            if(result===true) {
                location.href= "<?php echo base_url(); ?>admin/user/delete/"+user_id;
            }
        }); 
    }
    $('.user-delete').click(deleteUserConfirm);
</script>
<?php
    $this->load->view('admin/vwFooter');
?>