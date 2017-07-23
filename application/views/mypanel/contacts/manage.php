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

				<!-- end code -->
			</div>
		</div>
		<!-- END COLUMN RIGHT -->
<?php $this->load->view('mypanel/includes/footer'); ?>
<?php $this->load->view('mypanel/includes/footer_js'); ?>
	<!-- start Javascript Generales-->
	<script type="text/javascript" src="../assets/mypanel/js/modules/dist/contacts.min.js?rel=b871f8b238"></script>
	<!-- end Javascript Generales-->
</body>
</html>