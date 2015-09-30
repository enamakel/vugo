<?php
$this->load->view('vwHeader_vw');
?>
<div>
    <?php if(isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
    <div class="error"><?php echo $error ?></div>
    <?php endforeach; ?>
    <?php endif; ?>
<div class="container" style="paddivw-top:10px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-body">
                <div>
                    <div class="text-center">
                        <img src="<?php echo HTTP_IMAGES_SECURE_PATH ?>logo-icon.png">
                        <h4 class="vw-scope" >Register New Account</h4>
                    </div>
                    <form id="new-user-vw" action="<?php echo HTTP_BASE_SECURE_URL.'auth/register' ?>" method="post" enctype="multipart/form-data">
                        <p class="text-muted vw-scope">You just one step before you can start advertising your company thru the Vugo advertisement system.</p>
                        <div class="form-group required">
                            <label for="username">
                                <span class="inline-label vw-scope">Username, e.g. your email</span>
                                &nbsp; <i class="fa fa-info-circle text-muted vw-scope" title="We recommend that you use email address as your username."></i>
                            </label>
                            <input value="<?php echo ((isset($username))?$username:'')?>" class="form-control" placeholder="Username, e.g. your email" name="username" id='user-name' type="text">
                        </div>
                        <div class="form-group required">
                            <label class="inline-label vw-binding" for="email">Email</label>
                            <i class="fa fa-info-circle text-muted vw-scope" title="We need an email address to contact you concerning your account. We will use this email address for all account communication. We will not share your email address with any 3rd parties."></i> 
                            <input value="<?php echo ((isset($email))?$email:'')?>" class="form-control" placeholder="Email" name="email" vw-model="email" mv-must-change="" style="text-transform: lowercase" type="email">
                        </div>
                        <div class="form-group required">
                            <label class="inline-label vw-binding" for="password">Password</label>
                            <input class="form-control" name="password" placeholder="Password" type="password">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="inline-label vw-binding" for="first_name">First Name</label>
                                    <i class="fa fa-info-circle text-muted vw-scope" title="We need a primary contact person to start an account."></i> 
                                    <input value="<?php echo ((isset($first_name))?$first_name:'')?>" class="form-control" placeholder="First Name" name="first_name" type="text">
                                    <div class="slide-animation text-danger vw-scope vw-hide" >
                                        <i class="fa fa-warning"></i>&nbsp;First Name is required
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="inline-label vw-binding" for="last_name">Last Name</label>
                                    <input value="<?php echo ((isset($last_name))?$last_name:'')?>" class="form-control" placeholder="Last Name" title="Last Name" name="last_name" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="inline-label vw-binding" for="company_name">Company Name</label>
                            <i class="fa fa-info-circle text-muted vw-scope" title="Please enter your company name, if an individual please use your full legal name."></i>
                            <input value="<?php echo ((isset($company_name))?$company_name:'')?>" class="form-control" placeholder="Company Name" name="company_name" type="text">
                        </div>
                        <div class="form-group required">
                            <div class="pull-right text-muted vw-scope">/ Phone Extension: +
                            </div>
                            <label class="inline-label vw-scope" for="country">Country</label>
                            <i class="fa fa-info-circle text-muted vw-scope" title="For now, Vugo available only in some countries. "></i>
                            <div style="height:39px;overflow-y:hidden">
                                <div style="" class="form-control vw-hide"><i class="fa fa-spin fa-spinner"></i>&nbsp;<span class="vw-scope">Loading...</span>
                                </div>
                                <select id="country" style="" class="form-control" placeholder="Country" name="country">
                                    <option class="" value=""></option>
                                    <?php foreach($countries as $k=>$v): ?>
                                        <option <?php echo ((isset($country)&&$country==$k)?'selected="selected"':'')?> label="<?php echo $v['label']?>" value="<?php echo $k?>"><?php echo $v['label']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="slide-animation text-danger vw-scope vw-hide">
                                <i class="fa fa-warning"></i>&nbsp;Country is required
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="inline-label vw-scope" for="phoneCountry">Phone Extension</label>
                                    <div style="height:39px;overflow-y:hidden">
                                        <select style="" class="form-control" id="phoneCountry" name="phoneCountry">
                                            <option class="" value="">Phone Extension</option>
                                            <?php foreach(json_decode($phone_codes) as $k=>$v): ?>
                                                <option <?php echo ((isset($country)&&$country==$k)?'selected="selected"':'')?> value="<?php echo $k?>"><?php echo $v?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="inline-label vw-binding" for="phone_number">Phone Number</label>
                                    <i class="fa fa-info-circle text-muted vw-scope" title="We normally plan to communicate with you via email; however, in some cases faster way to notify you might be pretty important. Please don't forget to provide your extension at the same time with your phone number. It enables some SMS notifications from Vugo"></i>
                                    <input value="<?php echo ((isset($phone_number))?$phone_number:'')?>" class="form-control" placeholder="Phone Number" name="phone_number" id="phone-number" maxlength="14" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="inline-label vw-binding" for="referral_code">Referral Code</label>
                            <i class="fa fa-info-circle text-muted vw-scope" title="Case sensitive"></i>
                            <input value="<?php echo ((isset($referral_code))?$referral_code:'')?>" class="form-control" placeholder="Referral Code" name="referral_code" type="text">
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button class="btn btn-primary form-control" type="submit">
                                    <span class="vw-scope" >Lets go!</span> <span class="vw-scope vw-hide" vw-show="spinner.count>0" translate="$loading">Loading...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="list-group text-left" style="paddivw-top:30px;margin-bottom:0">
                    <div class="text-center">- or -</div>
                    <a href="<?php echo HTTP_BASE_SECURE_URL.'auth/login' ?>" class="list-group-item">Login if already have account.<span class="fa fa-chevron-right pull-right text-muted" style="line-height:inherit"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
var country_codes=<?php echo $phone_codes; ?>;
jQuery.validator.addMethod("alphanumericunderscore", function(value, element) {
    return this.optional( element ) || /^[a-zA-Z0-9_]+$/.test( value );
}, 'The password can only consist of alphabetical, number and underscore');

$(document).ready(function() {
    $('#new-user-vw').validate({
        ignore: ":disabled, :hidden",
        rules: {
            username: {
                required:true,
               rangelength: [6,30],
                remote: {
                    url:    '<?php echo ((empty($_SERVER['HTTPS']))?HTTP_BASE_URL:HTTP_BASE_SECURE_URL)."auth/check_username" ?>',
                    type:   'POST',
                    data: {
                        username: function() {
                                    return $('#user-name').val();
                                  }
                    }
                }
            },
            company_name: {
                required:true
            },
            first_name: {
                required:true
            },
            password: {
                required:true,
                rangelength: [6,14],
                alphanumericunderscore: true
            },
            country: {
                required:true
            },
            phone_number: {
                required: true,
                phoneUS: true
            }
        },
        messages: {
            username: {
                required:   "Campaign Name is required",    
                minlength:  "The name must be more than 6 and less than 30 characters long",
                remote:     "The User name is exists"
            },
            company_name: {
                required:   "The company name is required",
            },
            first_name: {
                required:   "The first name is required"
            },
            password: {
                required:   "The password is required",
                rangelength:"The password must be more than 6 and less than 14 characters long"
            },
            country: {
                required:   "Please select your country."
            },
            phone_number: {
                required:   "The Phone Number is required",
            }
        }
    });
});
$('#phone-number').mask("(999) 999-9999");
$('#country').change(function(){
    var countryCode = $(this).val();
    $('#phoneCountry').val(countryCode);
})
</script>
<?php
$this->load->view('vwFooter_vw');
?>