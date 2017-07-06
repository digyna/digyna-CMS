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
					<table id="table"></table>
				</div>
				<!-- end code -->
			</div>
		</div>
		<!-- END COLUMN RIGHT -->
<?php $this->load->view('mypanel/includes/footer'); ?>
<?php $this->load->view('mypanel/includes/footer_js'); ?>
	<!-- start Javascript Generales-->
<script type="text/javascript">
$(document).ready(function()
{
	<?php $this->load->view('mypanel/includes/bootstrap_tables_locale'); ?>

	table_support.init({
		resource: '<?php echo site_url('mypanel/'.$controller_name);?>',
		headers: <?php echo $table_headers; ?>,
		pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
		uniqueId: 'people.person_id',
		showExport: <?php echo ($permissions->export) ? 'true' : 'false'?>
	});

});

</script>
	<!-- end Javascript Generales-->
</body>
</html>