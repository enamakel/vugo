<?php
$this->load->view('admin/vwHeader');
$this->load->helper('user');
//echo "<pre>"; print_r($this->session); exit;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Users <small>User Management</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/user"><i class="fa fa-users"></i>User Management</a></li>
                <?php if($user->getUserId()): ?>
                    <li class="active"><i class="fa fa-user"></i>Edit User "<?php echo $user->getName() ?>"</li>     
                <?php else: ?>
                    <li class="active"><i class="fa fa-user"></i>Add New User</li>     
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
        <form method="post" action="<?php echo base_url(); ?>admin/user/save">
            <input type="hidden" name="user_id" value="<?php echo $user->getId();?>"/>
            <input type="hidden" name="form_id" value="<?php echo $user->getPassword();?>"/>
        <div class="row">
            <div class="col-lg-6 margin-bottom-10">
                <label for="code">First Name</label>
                <input type="text" class="form-control" placeholder="First Name" value="<?php echo $user->getFirstName(); ?>" name="first_name" id="first_name" />
            </div>
            <div class="col-lg-6 margin-bottom-10">
                <label for="code">Last Name</label>
                <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $user->getLastName(); ?>" name="last_name" id="last_name" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-bottom-10">
                <label for="code">Company Name</label>
                <input type="text" class="form-control" placeholder="Company" value="<?php echo $user->getCompanyName(); ?>" name="company_name" id="company_name" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-bottom-10">
                <label for="code">Email</label>
                <input type="text" class="form-control" placeholder="Email" value="<?php echo $user->getEmail(); ?>" name="email" id="email" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 margin-bottom-10">
                <label for="code">Country</label>
                <select class="form-control" placeholder="Country" value="<?php echo $user->getCountry(); ?>" name="country" id="country">
                    <?php foreach (userAvailableCountry() as $key=>$_country):?>
                    <option value="<?php echo $key?>" <?php echo $key==$user->getCountry()?'selected':''?>><?php echo $_country['label']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-6 margin-bottom-10">
                <div class="col-xs-12"><label for="code">Phone number</label></div>
                <div class="col-xs-3"><input type="text" class="form-control" readonly name="phone_code" id="phone_code" value=""/></div>
                <div class="col-xs-9 text-right" style="padding-right: 0px"><input type="text" class="form-control" placeholder="Enter phone number" value="<?php echo clearPhoneNumber($user); ?>" name="phone_number" id="phone_number" /></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 margin-bottom-10">
                <label for="code">User Name</label>
                <input type="text" class="form-control" placeholder="User name" value="<?php echo $user->getUsername(); ?>" name="username" id="username" />
            </div>
            <div class="col-lg-6 margin-bottom-10">
                <label for="code">Password <i class="fa fa-info-circle" title="Enter new password if want change"></i></label>
                <input type="password" class="form-control" placeholder="Enter new password" value="" name="password" id="password" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center ">
            <input type="submit" class="btn  btn-primary" value="Submit">    
        </div>
        </form>
    </div>      
     <div class="form-group col-lg-5"></div>      
</div>
<script type="text/javascript">
    $('#phone_number').mask("(999) 999-9999");
    var phoneCode = function(){
        var codeList = jQuery.parseJSON('<?php echo phoneCodeJSON()?>');
        var curentCountry = $('#country').val();
        for (i in codeList) {
            if(i==curentCountry) {
                $('#phone_code').val(codeList[i]);
                return ;
            }
        }
    };
    $('#country').change(phoneCode);
    phoneCode();
    
</script>
<?php
$this->load->view('admin/vwFooter');
?>