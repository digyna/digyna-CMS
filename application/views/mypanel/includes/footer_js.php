<?php if ($this->input->get('debug') == 'true') : ?>
		<!-- bower:js -->
		<script src="bower_components/jquery/dist/jquery.js"></script>
		<script src="bower_components/jquery-form/jquery.form.js"></script>
		<script src="bower_components/jquery-validate/dist/jquery.validate.js"></script>
		<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
		<script src="bower_components/jquery-ui/jquery-ui.js"></script>
		<script src="bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
		<script src="bower_components/bootstrap-table/src/bootstrap-table.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/export/bootstrap-table-export.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/mobile/bootstrap-table-mobile.js"></script>
		<script src="bower_components/file-saver.js/FileSaver.js"></script>
		<script src="bower_components/html2canvas/build/html2canvas.js"></script>
		<script src="bower_components/jspdf/dist/jspdf.min.js"></script>
		<script src="bower_components/jspdf-autotable/dist/jspdf.plugin.autotable.js"></script>
		<script src="bower_components/tableExport.jquery.plugin/tableExport.min.js"></script>
		<script src="bower_components/remarkable-bootstrap-notify/bootstrap-notify.js"></script>
		<script src="bower_components/js-cookie/src/js.cookie.js"></script>
		<script src="bower_components/blockUI/jquery.blockUI.js"></script>
		<script src="bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
		<script src="bower_components/twitter-bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
		<!-- endbower -->
		<!-- start js template tags -->
		<script type="text/javascript" src="assets/mypanel/js/app.js"></script>
		<script type="text/javascript" src="assets/mypanel/js/manage_tables.js"></script>
		<script type="text/javascript" src="assets/mypanel/js/nominatim.autocomplete.js"></script>
		<!-- end js template tags -->
	<?php else : ?>
	<!-- start minjs template tags -->
	<script type="text/javascript" src="assets/mypanel/js/digyna-cms.min.js?rel=05844a85a7"></script>
	<!-- end minjs template tags -->
<?php endif; ?>
<?php $this->load->view('mypanel/includes/app_js'); ?>