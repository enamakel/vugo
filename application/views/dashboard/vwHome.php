<?php
$this->load->view('vwHeader_vw');
?>
<div class="dashboard">
    <div style="padding-top:70px" class="ng-scope">
         <?php
            $this->load->view('dashboard/vwNavigation');
        ?>
        <!-- uiView:  -->
        <div class="container ng-scope">
            <div class="form-group ng-scope">
                <a class="btn btn-primary" href="<?php echo HTTP_BASE_URL?>campaigns/campaign">
                    <i class="fa fa-plus"></i>&nbsp;Add Campaign
                </a>
            </div>
            <div cache="false" class="ng-scope ng-isolate-scope">
                <?php
                    $this->load->view('campaign/vwList');
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('vwFooter_vw');
?>