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
				<div class="widget">
					<div class="widget-header clearfix">
						&nbsp;
					</div>
					<?php
					$person_id='';
					if($person_info->person_id != '')
					{
						$person_id=$this->encryption->encrypt_url($person_info->person_id);
					}
					?>
					<div class="widget-content">
						<?php echo form_open('mypanel/' . $controller_name . '/save/'. $person_id, array('id'=>'customer-form', 'class'=>'form-customers form-horizontal','data-ved'=>$this->encryption->encrypt_url($person_info->person_id))); ?>
						<fieldset id="customer_basic_info">
							<div id="required_fields_message" class="alert alert-info fade in">
								<i class="icon ion-information-circled"></i> <?php echo $this->lang->line('common_fields_required_message'); ?>
							</div>
							
							<?php $this->load->view("mypanel/people/form_basic_info"); ?>

							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('customers_company_name'), 'company_name', array('class' => 'control-label')); ?>
								<?php echo form_input(array(
									'name'=>'company_name',
									'class'=>'form-control input-sm',
									'value'=>$person_info->company_name));
								?>		
							</div>

							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('customers_rfc'), 'rfc', array('class' => 'control-label')); ?>
								<?php echo form_input(array(
									'name'=>'rfc',
									'id'=>'rfc',
									'class'=>'form-control input-sm',
									'value'=>$person_info->rfc));
									?>
							</div>

							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('customers_discount'), 'discount_percent', array('class' => 'control-label')); ?>
								<div class="input-group input-group-sm">
									<?php echo form_input(array(
										'name'=>'discount_percent',
										'id'=>'discount_percent',
										'class'=>'form-control input-sm',
										'value'=>$person_info->discount_percent));
									?>
									<span class="input-group-addon input-sm"><b>%</b></span>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<?php echo form_label(form_checkbox(
									'taxable', '1', $person_info->taxable == '' ? TRUE : (boolean)$person_info->taxable).'<span>'.$this->lang->line('customers_taxable').'</span>', '', array('class' => 'control-label fancy-checkbox',));
								?>
							</div>

							<div class="form-group form-group-sm">
								<?php echo form_input(array(
									'type'=>'submit',
									'class'=>'btn btn-primary btn-lg pull-right',
									'value'=>$this->lang->line('common_submit')));
								?>
							</div>
						</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
				<!-- end code -->
			</div>
		</div>
		<!-- END COLUMN RIGHT -->
<?php $this->load->view('mypanel/includes/footer'); ?>
<?php $this->load->view('mypanel/includes/footer_js'); ?>
	<!-- start Javascript Generales-->
	<script type="text/javascript" src="../assets/mypanel/js/modules/dist/customers.min.js?rel=b71370ff21"></script>
	<!-- end Javascript Generales-->
</body>
</html>