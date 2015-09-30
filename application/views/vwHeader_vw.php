<!DOCTYPE html>

<html>
<head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_IMAGES_PATH:HTTP_IMAGES_SECURE_PATH); ?>favicon.png">
    <title>Vugo official site</title>
    <link rel="stylesheet" href='<?php echo ((empty($_SERVER['HTTPS']))?HTTP_CSS_PATH:HTTP_CSS_SECURE_PATH); ?>lib.min.css' />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href='<?php echo ((empty($_SERVER['HTTPS']))?HTTP_CSS_PATH:HTTP_CSS_SECURE_PATH); ?>style.min.css' />
    <link rel="stylesheet" href='<?php echo ((empty($_SERVER['HTTPS']))?HTTP_CSS_PATH:HTTP_CSS_SECURE_PATH); ?>tooltipster.css' />
        <!-- Bootstrap core CSS -->
    <link href="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_CSS_PATH:HTTP_CSS_SECURE_PATH); ?>mainstyle.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>html5shiv.js"></script>
      <script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>respond.min.js"></script>
    <![endif]-->
	<script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery-1.11.3.min.js"></script>
	<script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>bootstrap.min.js"></script>
	<script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery.tooltipster.min.js"></script>
	<script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery.validate.js"></script>
	<script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>additional-methods.min.js"></script>
	<script src="<?php echo ((empty($_SERVER['HTTPS']))?HTTP_JS_PATH:HTTP_JS_SECURE_PATH); ?>jquery.maskedinput.min.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fa-info-circle').tooltipster();
        });
     
        </script>
</head>
<body class="bg">
<div class="dashboard">
    <div style="padding-top:70px" class="ng-scope">
        <?php $this->load->view('dashboard/vwNavigation',array('first_name'=>isset($first_name)?$first_name:'')); ?>
        <!-- uiView:  -->
        <div class="container ng-scope">
            <?php $this->load->view('dashboard/vwBreadcrumbs',array('bradcrumbs'=>isset($bradcrumbs)?$bradcrumbs:array())); ?>