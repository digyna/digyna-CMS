<?php if ($this->input->cookie('debug') == 'true') : ?>
		<!-- bower:js -->
		<script src="../bower_components/jquery/dist/jquery.js"></script>
		<script src="../bower_components/jquery-form/jquery.form.js"></script>
		<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
		<script src="../bower_components/jquery-ui/jquery-ui.js"></script>
		<script src="../bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
		<script src="../bower_components/bootstrap-table/src/bootstrap-table.js"></script>
		<script src="../bower_components/bootstrap-table/dist/extensions/export/bootstrap-table-export.js"></script>
		<script src="../bower_components/bootstrap-table/dist/extensions/mobile/bootstrap-table-mobile.js"></script>
		<script src="../bower_components/file-saver.js/FileSaver.js"></script>
		<script src="../bower_components/html2canvas/build/html2canvas.js"></script>
		<script src="../bower_components/jspdf/dist/jspdf.min.js"></script>
		<script src="../bower_components/jspdf-autotable/dist/jspdf.plugin.autotable.js"></script>
		<script src="../bower_components/tableExport.jquery.plugin/tableExport.min.js"></script>
		<script src="../bower_components/remarkable-bootstrap-notify/bootstrap-notify.js"></script>
		<script src="../bower_components/js-cookie/src/js.cookie.js"></script>
		<script src="../bower_components/blockUI/jquery.blockUI.js"></script>
		<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
		<script src="../bower_components/twitter-bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
		<script src="../bower_components/formvalidation.io/dist/js/formValidation.min.js"></script>
		<script src="../bower_components/formvalidation.io/dist/js/framework/bootstrap.min.js"></script>
		<script src="../bower_components/sweetalert/dist/sweetalert.min.js"></script>
		<!-- endbower -->
		<!-- start js template tags -->
		<script type="text/javascript" src="../assets/mypanel/js/app.js?rel=f4d5964607"></script>
		<script type="text/javascript" src="../assets/mypanel/js/bootstrap-tables-locale.js"></script>
		<script type="text/javascript" src="../assets/mypanel/js/manage_tables.js"></script>
		<script type="text/javascript" src="../assets/mypanel/js/nominatim.autocomplete.js"></script>
		<!-- end js template tags -->
	<?php else : ?>
	<!-- start minjs template tags -->
	<script type="text/javascript" src="../assets/mypanel/js/digyna-cms.min.js?rel=f0f562811c"></script>
	<!-- end minjs template tags -->
<?php endif; ?>