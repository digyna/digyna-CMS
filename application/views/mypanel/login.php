<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <base href="<?php echo base_url();?>" />
  <title>digyna-cms</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/mypanel/ico/favicon.ico">

  <!-- start css template tags -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/mypanel/css/login.css"/>
  <!-- end css template tags -->
</head>

<body>
  <div class="box">
  <div id="header">
 <img class="logo" src="<?php echo base_url();?>/assets/mypanel/images/logo.png"/>CMS
<div align="center" style="color:red"><?php echo validation_errors(); ?></div>
  </div> 
   
   <?php echo form_open('mypanel/login','style="margin-top: 30px;"') ?>
    <div class="group">      
      <input class="inputMaterial" name="username"  type="text" required />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label><?php echo $this->lang->line('login_username')?></label>
    </div>
	    <div class="group">      
      <input class="inputMaterial" name="password"   type="password" required />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label><?php echo $this->lang->line('login_password')?></label>
    </div>
    <button id="loginButton" type="submit"><?php echo $this->lang->line('login_login')?>Login</button>
  </form>
  <div id="footer-box"><p class="footer-text"><span class="sign-up">digyna-cms v.1.0.0</span></p></div>
</div>
    <?php echo form_close(); ?>
  
</body>
</html>
