<?php
$this->load->view('vwHeader_vw');
?>
<div>
    <?php if(isset($messages)): ?>
    <?php foreach ($messages as $message): ?>
    <div class="error"><?php echo $message ?></div>
    <?php endforeach; ?>
    <?php endif; ?>
    <div style="height: 20%"></div>
    <div class="text-center">
        <div class="hidden-xs"></div>
        <div class="col-md-4 col-md-offset-4 text-center">
            <div class="panel panel-default ng-scope">
                <div class="panel-body">
                    <h4 class="block-center">Vugo Advertiser Portal</h4>
                    <div class="text-center form-group">
                        <img src="<?php echo HTTP_IMAGES_PATH ?>logo-icon.png">
                    </div>
                    <h4 class="block-center">Login</h4>
                    <form action="<?php echo HTTP_BASE_SECURE_URL ?>auth/login/" method="post"/>                    
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Enter your username" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required />
                    </div>
                   <?php /* <div class="clearfix text-left" style="margin-top:-10px;margin-bottom:10px;">
                        <div class="checkbox">
                            <label>
                                <input id="Forgot" name="Forgot" type="checkbox" value="true" /><input name="Forgot" type="hidden" value="false" />
                                Public computer<br />
                                <span class="small text">* login will be required next time when you get back to this site
                            </label>
                        </div>
                    </div> */ ?>
                    <div>
                        <input type="submit" value="Login" class="btn btn-primary btn-block" />
                    </div>
                    <div class="list-group text-left" style="padding-top:30px;margin-bottom:0;">
                        <div class="text-center">- or -</div>
                        <a href="<?php echo HTTP_BASE_SECURE_URL ?>auth/register" class="list-group-item" style="background-color:#ffdcd0">Register your account<span class="fa fa-chevron-right pull-right text-muted" style="line-height:inherit;"></span></a>
                        <a href="<?php echo HTTP_BASE_URL ?>auth/forgot" class="list-group-item">Request password reset<span class="fa fa-chevron-right pull-right text-muted" style="line-height:inherit;"></span></a>
                    </div>
                    </form>             
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
    $this->load->view('vwFooter_vw');
    ?>