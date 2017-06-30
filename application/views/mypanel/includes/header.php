<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="es" class="no-js">
<!--<![endif]-->
<head>
	<title>digyna-cms</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/mypanel/ico/favicon.ico">
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url('mypanel');?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="digyna">

	<?php if ($this->input->get('debug') == 'true') : ?>
		<!-- bower:css -->
		<link rel='stylesheet' href='bower_components/bootstrap/dist/css/bootstrap.css' />
		<link rel='stylesheet' href='bower_components/jquery-ui/themes/base/jquery-ui.css' />
		<link rel='stylesheet' href='bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css' />
		<link rel='stylesheet' href='bower_components/bootstrap-table/src/bootstrap-table.css' />
		<link rel='stylesheet' href='bower_components/font-awesome/css/font-awesome.css' />
		<link rel='stylesheet' href='bower_components/Ionicons/css/ionicons.css' />
		<!-- endbower -->
		<!-- start css template tags -->
		<link rel="stylesheet" type="text/css" href="assets/mypanel/css/main.css?rel=9d5f99fddb"/>
		<link rel="stylesheet" type="text/css" href="assets/mypanel/css/modal.css?rel=a3ef7476eb"/>
		<!-- end css template tags -->
	<?php else : ?>
		<!-- start mincss template tags -->
		<link rel="stylesheet" type="text/css" href="assets/mypanel/css/digyna-cms.min.css?rel=9cf65f41cb"/>
		<!-- end mincss template tags -->
	<?php endif; ?>

	
	<!-- start Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,700' rel='stylesheet' type='text/css'>
	<!-- end Google Fonts -->
			
</head>

<body class="fixed-top-active dashboard">
	<!-- WRAPPER -->
	<div class="wrapper">
		<!-- TOP NAV BAR -->
		<nav class="top-bar navbar-fixed-top" role="navigation">
			<div class="logo-area">
				<a href="#" id="btn-nav-sidebar-minified" class="btn btn-link btn-nav-sidebar-minified pull-left"><i class="icon ion-arrow-swap"></i></a>
				<a class="btn btn-link btn-off-canvas pull-left"><i class="fa fa-bars"></i></a>
				<div class="logo pull-left">
					<a href="<?php echo base_url('mypanel');?>">
						<img src="<?php echo base_url('assets/mypanel/img/digyna.png');?>" alt="Digyna Logo">
					</a>
				</div>

			</div>
			<div class="top-bar-right pull-right">
				<div class="action-group logged-user">
					<div class="btn-group">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user-circle" ></i>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url('mypanel/profile');?>">
									<i class="icon ion-ios-gear"></i>
									<span class="text"><?php echo $this->lang->line('common_profile'); ?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('mypanel/home/logout');?>">
									<i class="icon ion-power"></i>
									<span class="text"><?php echo $this->lang->line('common_logout'); ?></span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<!-- END TOP NAV BAR -->
	<?php $this->load->view('mypanel/includes/menu'); ?>