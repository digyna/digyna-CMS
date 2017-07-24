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
				<?php
					$person_id='';
					if($person_info->person_id != '')
					{
						$person_id=$this->encryption->encrypt_url($person_info->person_id);
					}
				?>
				<?php echo form_open('mypanel/' . $controller_name . '/save/' . $person_id, array('id'=>'form-login','class'=>'wizard-user','data-ved'=>$this->encryption->encrypt_url($person_info->person_id))); ?>
					<ul>
						<li><a href="#tab1" data-toggle="tab">1</a><span><?php echo $this->lang->line('users_login');?></span></li>
						<li><a href="#tab2" data-toggle="tab">2</a><span><?php echo $this->lang->line('users_info');?></span></li>
						<li><a href="#tab3" data-toggle="tab">3</a><span><?php echo $this->lang->line('users_perm');?></span></li>
						<li><a href="#tab4" data-toggle="tab">4</a><span><?php echo $this->lang->line('users_ok');?></span></li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane" id="tab1">
								<fieldset>
									<legend><?php echo $this->lang->line('users_info_account');?></legend>
									<div id="required_fields_message" class="alert alert-info fade in">
										<i class="icon ion-information-circled"></i> <?php echo $this->lang->line('common_fields_required_message'); ?>
									</div>
									
									<div class="form-group clearfix">
										<?php echo form_label($this->lang->line('users_nickname'), 'username', array('class'=>'required control-label')); ?>
										<div class="input-group">
											<span class="input-group-addon input-sm">
												<span class="glyphicon glyphicon-user"></span>
											</span>
											<?php echo form_input(array(
												'name'=>'username',
												'id'=>'username',
												'class'=>'form-control input-sm',
												'value'=>$person_info->username));
											?>
										</div>
									</div>

									<div class="form-group">
										<?php echo form_label($this->lang->line('users_password'), 'password', ($person_info->person_id === '')?array('id'=>'password-label','class'=>'required control-label') : array('id'=>'password-label','class'=>'control-label')); ?>
										<div class="input-group">
											<span class="input-group-addon input-sm">
												<span class="glyphicon glyphicon-lock"></span>
											</span>
											<span>
											<?php echo form_password(array(
												'name'=>'password',
												'id'=>'password',
												'class'=>'form-control input-sm'));
											?>
											</span>
										</div>
										<div class="progress password-meter" id="passwordMeter">
										<div class="progress-bar"></div>
									</div>
									</div>
								
									<div class="form-group">
										<?php echo form_label($this->lang->line('users_confirm_password'), 'confirm_password',array('class'=>'control-label')); ?>
										<div class="input-group">
											<span class="input-group-addon input-sm">
												<span class="glyphicon glyphicon-lock"></span>
											</span>
											<?php echo form_password(array(
												'name'=>'confirm_password',
												'id'=>'confirm_password',
												'class'=>'form-control input-sm'));
											?>
										</div>
									</div>
								</fieldset>
						</div>
						<div class="tab-pane" id="tab2">
							<fieldset>
								<legend><?php echo $this->lang->line('users_info_basic');?></legend>
								<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
								<?php $this->load->view("mypanel/people/form_basic_info"); ?>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab3">
							<fieldset>
								<legend><?php echo $this->lang->line('users_perm_info');?></legend>
								<p><?php echo $this->lang->line("users_permission_desc"); ?></p>
								<div class="form-group">
									<?php echo $permissions;?>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab4">
							<h4><?php echo $this->lang->line('common_confirmation');?></h4>
							<p><?php echo $this->lang->line('common_confirmation_desc');?></p>
							<dl class="dl-horizontal">
							<dt><?php echo $this->lang->line('users_nickname');?>:</dt>
								<dd><span id="outputNickname"></span></dd>
							<dt><?php echo $this->lang->line('common_first_name');?>:</dt><dd><span id="outputName"></span></dd>
								<dt id="outputlabel"><?php echo $this->lang->line('common_email');?>:</dt>
								<dd><span id="outputEmail"></span></dd>
							</dl>
						</div>

						<ul class="pager wizard">
							<li class="previous"><a><?php echo $this->lang->line('common_previous');?></a></li>
							<li class="next last"><a><?php echo ($person_info->person_id === '')? $this->lang->line('common_create_account'):$this->lang->line('common_update_account');?></a></li>
							<li class="next"><a><?php echo $this->lang->line('common_next');?></a></li>
						</ul>
					</div>
				<?php echo form_close(); ?>
				<!-- end code -->
			</div>
		</div>
		<!-- END COLUMN RIGHT -->
<?php $this->load->view('mypanel/includes/footer'); ?>
<?php $this->load->view('mypanel/includes/footer_js'); ?>
	<!-- start Javascript Generales-->
	<script type="text/javascript" src="../assets/mypanel/js/modules/dist/users.min.js?rel=7f2ed9b475"></script>
	<!-- end Javascript Generales-->
</body>
</html>