<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <title>Vugo Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_CSS_PATH:HTTP_CSS_SECURE_PATH); ?>bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <!-- Add custom CSS here -->
    <link href="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_CSS_PATH:HTTP_CSS_SECURE_PATH); ?>arkadmin.css" rel="stylesheet">
    <link href="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_CSS_PATH:HTTP_CSS_SECURE_PATH); ?>tooltipster.css" rel="stylesheet">
      <!-- JavaScript -->
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery-1.11.3.min.js"></script>
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>tablesorter/jquery.tablesorter.min.js"></script>
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>bootstrap.min.js"></script>
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>bootbox.min.js"></script>
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery.tooltipster.min.js"></script>
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery.validate.js"></script>
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>additional-methods.min.js"></script>
    <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery.maskedinput.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>html5shiv.js"></script>
      <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.fa-info-circle').tooltipster();
        });
    </script>
  </head>
 <body>
    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>admin">Vugo Admin Panel</a>
        </div>
 <?php 
// Define a default Page
  $pg = isset($controller) && $controller != '' ?  $controller :'dash'  ;    
?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li <?php echo  $pg =='dash' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li <?php echo  $pg =='referral' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/referral"><i class="fa fa-barcode"></i>Refferral Codes</a></li>
            <li <?php echo  $pg =='user' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/user"><i class="fa fa-users"></i>Users</a></li>
            <li <?php echo  $pg =='compaign' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/compaign"><i class="fa fa-dollar"></i>User Compaigns</a></li>
            
        
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 New Messages</li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
              </ul>
            </li>
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username') ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>admin/home/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <div class="message page-wrapper">
      <?php echo $this->session->getMessages(); $this->session->clearMessages() ?>
    </div>