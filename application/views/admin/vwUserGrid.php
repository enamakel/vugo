<?php
    $this->load->view('admin/vwHeader');
        $this->load->helper('user');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>User Management <small>Overview</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-users"></i> User Management</a></li>
                <li class="active"><i class="fa fa-table"></i> Grid</li>        
                <button onclick="location.href='<?php echo base_url(); ?>admin/user/add'" class="btn btn-success" type="button" style="float:right;">Add New User</button>
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
                    <th><i class="fa fa-sort"></i>User #</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>First Name</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Last Name</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Email</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Company Name</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Country</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Phone number</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Referral code</th>
                    <th class="text-nowrap"><i class=" fa fa-sort"></i>Registered time</th>
                    <th class="text-nowrap"><i class="fa fa-sort"></i>Last login time</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $_user): ?>
                    <tr>
                        <td><?php echo $_user->user_id; ?></td>
                        <td><?php echo $_user->first_name; ?></td>
                        <td><?php echo $_user->last_name; ?></td>
                        <td><?php echo $_user->email; ?></td>
                        <td><?php echo $_user->company_name; ?></td>
                        <td><?php echo renderer_country($_user); ?></td>
                        <td><?php echo renderer_phoneNumber($_user); ?></td>
                        <td><?php echo $_user->code; ?></td>
                        <td><?php echo $_user->registered_date; ?></td>
                        <td><?php echo renderer_lastLogin($_user); ?></td>
                        <td><a href="<?php echo base_url(); ?>admin/user/edit/<?php echo $_user->user_id; ?>" class="btn btn-primary btn-s">Edit</a>
                            <a href="#" data-user="<?php echo $_user->user_id; ?>" class="user-delete btn btn-danger btn-s">Delete</a></td>
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