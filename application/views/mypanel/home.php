<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view("mypanel/includes/header"); ?>


		<!-- COLUMN RIGHT -->
		<div id="col-right" class="col-right ">
			<div class="container-fluid primary-content">
				<!-- PRIMARY CONTENT HEADING -->
				<div class="primary-content-heading clearfix">
					<h2>Escritorio</h2>
					<ul class="breadcrumb pull-left">
						<li><i class="icon ion-home"></i><a href="#">Inicio</a></li>
						<li class="active">Escritorio</li>
					</ul>
				</div>
				<!-- END PRIMARY CONTENT HEADING -->				
				<div class="row">
					<div class="col-md-6">
						<!-- INBOX WIDGET -->
						<div class="widget widget-inbox">
							<div class="widget-header clearfix">
								<h3><i class="icon ion-ios-email"></i> <span><?php echo $this->lang->line('contacts_inbox');?></span></h3>
								<div class="btn-group widget-header-toolbar">
									<a href="#" title="Refresh" class="btn btn-link"><i class="icon ion-ios-refresh-empty"></i></a>
									<a href="#" title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="icon ion-ios-arrow-up"></i></a>
									<a href="#" title="Remove" class="btn btn-link btn-remove"><i class="icon ion-ios-close-empty"></i></a>
								</div>
								<div class="widget-header-toolbar">
									<span class="badge"><?php echo $this->contact_lib->all_total_contact();?></span>
								</div>
							</div>
							<div class="widget-content">
								<ul class="list-unstyled widget-inbox-list">
								<?php
								foreach ($contact_info as $key) {
									if($key->read){
								?>
									<li>
										<div class="sender"><?php echo $key->first_name.' '.$key->last_name;?></div>
										<h4 class="title"><a href="#"><?php echo $key->title;?></a></h4>
										<div class="brief"><?php echo cortar_palabras($key->comments,16);?></div>
										<div class="text-muted timestamp"><?php echo dateDiff($key->contact_time);?></div>
									</li>

								<?php

									}else{
								?>
									<li class="unread">
										<div class="sender"><?php echo $key->first_name.' '.$key->last_name;?></div>
										<h4 class="title"><a href="#"><?php echo $key->title;?></a></h4>
										<div class="brief"><?php echo cortar_palabras($key->comments,16);?></div>
										<div class="text-muted timestamp"><?php echo dateDiff($key->contact_time);?></div>
									</li>
									<?php
								}
								}
								?>
								</ul>
								<a href="#" class="btn btn-primary btn-sm btn-block"><i class="icon ion-android-inbox"></i><?php echo $this->lang->line('contacts_open_inbox');?></a>
							</div>
						</div>
						<!-- END INBOX WIDGET -->
					</div>
					
				</div>



			</div>
		</div>
		<!-- END COLUMN RIGHT -->
<?php $this->load->view('mypanel/includes/footer'); ?>
<?php $this->load->view('mypanel/includes/footer_js'); ?>
	<!-- start Javascript Generales-->
	<script type="text/javascript" src="assets/mypanel/js/modules/home.js"></script>
	<!-- end Javascript Generales-->
</body>
</html>