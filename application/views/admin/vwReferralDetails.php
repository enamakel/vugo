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
                <li class="active"><i class="fa fa-edit"></i>Referral Code "<?php echo $referral->getCode();?>"</li>     
                <li class="active"><i class="fa fa-bars"></i>Details</li>     
             
            </ol>
        </div>
    </div>
    <div class="form-group col-lg-5">
        <div class="form-group">
            <label for="code">Referral Code</label>
            <input type="text" class="form-control" value="<?php echo $referral->getCode(); ?>" name="code" id="code" />
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
            <button onclick="history.back()" class="btn  btn-primary"><i class="fa fa-backward"></i>Back to grid</button>    
        </div>
        </form>
    </div>      
     <div class="form-group col-lg-5"></div>      
</div>
<?php
$this->load->view('admin/vwFooter');
?>