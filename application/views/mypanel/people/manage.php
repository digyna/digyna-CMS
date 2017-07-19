<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view("mypanel/includes/header"); ?>


		<!-- COLUMN RIGHT -->
		<div id="col-right" class="col-right ">
			<div class="container-fluid primary-content">
				<!-- PRIMARY CONTENT HEADING -->
				<div class="primary-content-heading clearfix">
					<h2><?php echo $this->lang->line('module_'.$controller_name); ?></h2>
					<?php echo $menu_bread;?>
				</div>
				<!-- END PRIMARY CONTENT HEADING -->
				
				<!-- start code -->
				<?php if($permissions->add){?>
				<div id="title_bar" class="btn-toolbar">
					<a href="<?php echo site_url('mypanel/'.$controller_name."/add"); ?>" class="btn btn-info btn-sm pull-right" role="button"><span class="glyphicon glyphicon-user">&nbsp</span><?php echo $this->lang->line($controller_name. '_new'); ?></a>
				</div>
				<?php } ?>
				<div id="toolbar">
					<div class="pull-left btn-toolbar">
					<?php if($permissions->delete){?>
						<button id="delete" class="btn btn-default btn-sm">
							<span class="fa fa-trash">&nbsp;</span><?php echo $this->lang->line("common_delete");?>
						</button>
					<?php } ?>
					</div>
				</div>

				<div id="table_holder">
					<table id="table" data-show-export="<?php echo ($permissions->export) ? 'true' : 'false'?>" data-page-size="<?php echo $this->config->item('lines_per_page'); ?>"></table>
				</div>
				<!-- end code -->
			</div>
		</div>
		<!-- END COLUMN RIGHT -->
<?php $this->load->view('mypanel/includes/footer'); ?>
<?php $this->load->view('mypanel/includes/footer_js'); ?>
	<!-- start Javascript Generales-->
	<script type="text/javascript" src="../assets/mypanel/js/modules/people.js"></script>
	<!-- end Javascript Generales-->
</body>
</html>