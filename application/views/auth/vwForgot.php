<?php
$this->load->view('vwHeader_vw');
?>
<div>
    <?php if(isset($messages)): ?>
    <?php foreach ($messages as $message): ?>
    <div class="error"><?php echo $message ?></div>
    <?php endforeach; ?>
    <?php endif; ?>
    <div class="text-center">
        <div class="hidden-xs"></div>

        <div class="col-md-4 col-md-offset-4 text-center">
            <div class="panel panel-default ng-scope">
                <div class="panel-body">
                    <div class="text-center form-group">
                        <img src="<?php echo HTTP_IMAGES_PATH ?>logo-icon.png">
                    </div>
                    <h4 class="block-center">Forgot password</h4>
                    <form id="forgot-user-vw" method="post" action="<?php echo HTTP_BASE_URL ?>/auth/forgot">
                        <div class="text-left">
                            <p class="text-muted">After you request password reset, we will send you email with temporarely link which will allow you to reset your password.</p>
                        </div>
                        <div class="form-group">
                            <input type="text" required="" placeholder="Enter your username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" required="" placeholder="Enter your email" name="email" class="form-control">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary btn-block" value="Request password reset">
                        </div>
                        <div style="padding-top:30px;margin-bottom:0;" class="list-group text-left">
                            <div class="text-center">- or -</div>
                            <a class="list-group-item" href="<?php echo HTTP_BASE_SECURE_URL.'auth/login' ?>">Try login again<span style="line-height:inherit;" class="fa fa-chevron-right pull-right text-muted"></span></a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#forgot-user-vw').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    threshold: 6,
                    notEmpty: {
                        message: 'The name is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The name must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'The name can only consist of alphabetical, number and underscore'
                    },
                }
            },
        }
    });
</script>
<?php
$this->load->view('vwFooter_vw');
?>