		<!-- COLUMN LEFT -->
		<div id="col-left" class="col-left">
			<div class="main-nav-wrapper">
				<nav id="main-nav" class="main-nav">
					<h3></h3>							
					

					<ul class="main-menu">
					<?php
					foreach($allowed_modules as $module)
					{
						$submodule_exist=submodule_exist($module->module_id,$allowed_submodules);

						if($submodule_exist)
						{
					?>
							<li class="has-submenu" id="<?php echo $module->module_id ?>">
							<a href="#" class="submenu-toggle"><i class="<?php echo $module->module_icon ?>"></i><span class="text"><?php echo $this->lang->line('module_'.$module->module_id);?></span></a>
							<ul class="list-unstyled sub-menu collapse in">
					<?php
						}else{
					?>
							<li id="<?php echo $module->module_id ?>">
							<a href="<?php echo base_url('mypanel/'.$module->module_id) ?>"><i class="<?php echo $module->module_icon ?>"></i><span class="text"><?php echo $this->lang->line('module_'.$module->module_id);?></span>
					<?php
							if($module->module_id=='contacts'){ 
								if($this->contact_lib->unread_total_contact()>0){
					?>
								<span class="badge bg-orange"><?php echo $this->contact_lib->unread_total_contact();?></span>
                    <?php
								}

						    }
				    ?>
							</a>
					<?php

						}
						
						foreach($allowed_submodules as $submodule)
						{
							$exploded_submodule = explode('_', $submodule->submodule_id);
								if($submodule->module_id == $module->module_id)
									{
									

										$lang_key = $module->module_id.'_'.$exploded_submodule[1];
										$lang_line = $this->lang->line($lang_key);
										$lang_line = ($this->lang->line_tbd($lang_key) == $lang_line) ? $exploded_submodule[1] : $lang_line;
											if(!empty($lang_line))
											{
					?>
											
												<li id="<?php echo $exploded_submodule[0].'_'.$exploded_submodule[1] ?>">
												<a href="<?php echo base_url('mypanel/'.$exploded_submodule[0].'/'.$exploded_submodule[1]) ?>"><span class="text"><?php echo $lang_line;?></span>

												</a>
													
												</li>
											
					<?php
											}
									}
						}//end for each submodules
					if($submodule_exist)
					{
					?>			
						</ul>
						<?php
					}
					?>

						</li>
					<?php
					}//end for each modules
					?>
				</ul>
				</nav>
			</div>
		</div>
		<!-- END COLUMN LEFT -->