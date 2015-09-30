<?php
    $this->load->view('admin/vwHeader');
    $this->load->helper('referral');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Refferal Codes <small>Grid</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/referral"><i class="fa fa-barcode"></i> Referral Codes</a></li>
                <li class="active"><i class="fa fa-table"></i> Grid</li>        
                <button onclick="location.href='<?php echo base_url(); ?>admin/referral/add'" class="btn btn-primary" type="button" style="float:right;">Add New Code</button>
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
                    <th><i class="fa fa-sort"></i>ID</th>
                    <th><i class="fa fa-sort"></i>Code Value</th>
                    <th><i class="fa fa-sort"></i>Author</th>
                    <th><i class="fa fa-sort"></i>Added time</th>
                    <th><i class="fa fa-sort"></i>Updated time</th>
                    <th><i class="fa fa-list"></i>Details</th>
                    <th><i class="fa fa-sort"></i>Status</th>
                    <th width="100px" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($referrals as $key => $val): ?>
                    <tr>
                        <td><?php echo $val['referral_id']; ?></td>
                        <td><?php echo $val['code']; ?></td>
                        <td><?php echo $val['name']; ?> (<a href="mailto:<?php echo $val['email']?>"><?php echo $val['email']?></a>)</td>
                        <td><?php echo $val['added']; ?></td>
                        <td><?php echo $val['updated']; ?></td>
                        <td><a href="<?php echo base_url(); ?>admin/referral/details/<?php echo $val['referral_id']; ?>" class="btn btn-success btn-xs">View assigned refferals</a></td>
                        <td><strong><?php echo referral_status($val['status']); ?></strong></td>
                        <td><a href="<?php echo base_url(); ?>admin/referral/edit/<?php echo $val['referral_id']; ?>" class="btn btn-primary btn-s">Edit</a></td>
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
<?php
    $this->load->view('admin/vwFooter');
?>