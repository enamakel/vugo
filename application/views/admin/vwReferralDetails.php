<?php
$this->load->view('admin/vwHeader');
$this->load->helper('referral');
//echo "<pre>"; print_r($referral); exit;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Referral Codes <small>View code details</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/referral'); ?>"><i class="fa fa-barcode"></i> Referral Codes</a></li>
                <li><a href="<?php echo site_url('admin/referral/edit/'.$referral->getId()); ?>"><i class="fa fa-edit"></i>Referral Code "<?php echo $referral->getCode();?>"</a></li>     
                <li class="active"><i class="fa fa-bars"></i>Details</li>     
             
            </ol>
        </div>
    </div>
    <div class="form-group col-lg-6">
        <div class="form-group">
            <label for="code">Referral Code</label>
            <input disabled="" type="text" class="form-control" value="<?php echo $referral->getCode(); ?>" name="code" id="code" />
        </div>
        <div class="form-group">
            <label for="status">Status Code</label>
            <select disabled="" class="form-control" value="" name="status" id="status">
                <?php foreach (referral_status_list() as $key=>$val):?>
                <option <?php echo ($referral->getStatus()==$key?'selected':'')?> value="<?php echo $key?>"><?php echo $val;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-users"></i>
                Users list
                <i class="fa fa-info-circle" title="Who used this code"></i>
            </h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
                <?php if(count($referral->getUserList())): ?>
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th class="text-nowrap"><i class="fa fa-sort"></i>User #</th>
                        <th class="text-nowrap"><i class="fa fa-sort"></i>First Name</th>
                        <th class="text-nowrap"><i class="fa fa-sort"></i>Last Name</th>
                        <th class="text-nowrap"><i class="fa fa-sort"></i>Registered Date</th>
                        <th class="text-nowrap"><i class="fa fa-bars"></i>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($referral->getUserList() as $_user): ?>
                        <tr>
                            <td><?php echo $_user->user_id ?></td>
                            <td><?php echo $_user->first_name ?></td>
                            <td><?php echo $_user->last_name ?></td>
                            <td class="text-nowrap"><?php echo $_user->registered_date ?></td>
                            <td><a href="<?php echo site_url("admin/users/edit/".$_user->user_id); ?>" class="btn btn-primary btn-xs" style="width: 100%">View User</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <div class="text-center text-uppercase">No users</div>
                <?php endif; ?>
                
            </div>
          </div>
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