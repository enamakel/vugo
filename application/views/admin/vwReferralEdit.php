<?php
$this->load->view('admin/vwHeader');
$this->load->helper('referral');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Referral Codes <small>Edit code</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/referral"><i class="fa fa-barcode"></i> Referral Codes</a></li>
                <?php if($referral->getReferralId()): ?>
                    <li class="active"><i class="fa fa-edit"></i>Edit Referral Code</li>     
                <?php else: ?>
                    <li class="active"><i class="fa fa-file"></i>Add New Referral Code</li>     
                <?php endif; ?>
            </ol>
        </div>
    </div>
    <?php if(isset($errors)): ?>
    <div class="alert alert-danger ng-scope" style="white-space: nobr;">
        <i class="fa fa-warning" style="float:left;"></i>
        <ul>
            <?php echo $errors; ?>
        </ul>
    </div>
    <?php endif;?>
    <div class="form-group col-lg-5">
        <form method="post" action="<?php echo base_url(); ?>admin/referral/save">
            <input type="hidden" name="referral_id" value="<?php echo $referral->getReferralId()?>"/>
            <input type="hidden" name="author" value="<?php echo $this->session->userdata['id']?>"/>
        <div class="form-group">
            <label for="code">Referral Code</label>
            <input type="text" class="form-control" value="<?php echo $referral->getCode(); ?>" name="code" id="code" />
        </div>
        <div class="row">
            <div class="col-lg-6 margin-bottom-10">
                <label for="code">Price Per Click</label>
                <input type="text" class="form-control" placeholder="Price Per Click" value="<?php echo $referral->getPricePerClick(); ?>" name="price_per_click" id="price_per_click" />
            </div>
            <div class="col-lg-6 margin-bottom-10">
                <label for="code">Price Per View</label>
                <input type="text" class="form-control" placeholder="Price Per View" value="<?php echo $referral->getPricePerView(); ?>" name="price_per_view" id="price_per_view" />
            </div>
        </div>
        <div class="form-group">
            <label for="status">Status Code</label>
            <select class="form-control" value="" name="status" id="status">
                <?php foreach (referral_status_list() as $key=>$val):?>
                <option <?php echo ($referral->getStatus()==$key?'selected':'')?> value="<?php echo $key?>"><?php echo $val;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group text-right">
            <input type="submit" class="btn  btn-primary" value="Submit">    
        </div>
        </form>
    </div>      
     <div class="form-group col-lg-5"></div>      
</div>
<?php
$this->load->view('admin/vwFooter');
?>