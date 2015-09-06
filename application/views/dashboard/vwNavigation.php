<nav vw-controller="menuCtrl" class="navbar navbar-default navbar-fixed-top vw-scope">
    <div class="container">
        <div class="navbar-header text-center">
            <div style="paddivw-top:0px;float:none" class="navbar-brand">
                <div>
                    <img style="height: 22px;" src="<?php echo HTTP_IMAGES_PATH ?>logo-icon.png">&nbsp;
                    <span style="color:#F16234">Views</span>
                    <span style="color:#189FAA">wagen</span>
                </div>
                <div style="font-size:8pt;color:#777">[ADVERTISER ZONE]</div>
            </div>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <!-- vwRepeat: item in menu --><!-- vwIf: !item.items -->
                <li class="vw-scope active">
                    <a  href="<?php echo HTTP_BASE_URL.'campaigns/'?>">
                        <!-- vwIf: item.image -->
                        <span class="vw-scope vw-isolate-scope">
                            <i class="fa fa-home vw-scope"></i>
                        </span>
                        <!-- end vwIf: item.image --> 
                        <span class="vw-scope">Campaigns</span>
                    </a>
                </li>
                <!-- end vwIf: !item.items --><!-- vwIf: item.items --><!-- end vwRepeat: item in menu -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle">
                        <span class="">
                            <i class="fa fa-user"></i>&nbsp;
                            <span class="vw-bindivw"><?php echo $first_name ?></span>
                        </span> 
                        <span class="vw-hide">Login</span> &nbsp;<span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <!-- vwRepeat: item in userMenu -->
                        <li class="vw-scope">
                            <!-- vwIf: !item.exhref -->
                            <a style="cursor: pointer" href="<?php echo HTTP_BASE_URL.'auth/logout'?>" class="vw-scope">
                                <span translate="Logout" class="vw-scope">Logout</span>
                            </a><!-- end vwIf: !item.exhref --> <!-- vwIf: item.exhref -->
                        </li>
                        <!-- end vwRepeat: item in userMenu -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript">
    $('.dropdown-toggle').click(function(){
        if($('.dropdown-menu').is(":visible")) {
            $('.dropdown-menu').hide();
        } else {
            $('.dropdown-menu').show();
        }
    })
    $(document).mouseup(function (e)
{
    var container = $(".navbar-right");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $('.dropdown-menu').hide();
    }
});
</script>