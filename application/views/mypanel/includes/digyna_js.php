<script type="text/javascript">

	var post = $.post;
	
	var csrf_token = function() {
		return Cookies.get('<?php echo $this->config->item('csrf_cookie_name'); ?>');
	};

	var csrf_form_base = function() {
		return { <?php echo $this->security->get_csrf_token_name(); ?> : function () { return csrf_token();  } };
	};

	$.post = function() {
		arguments[1] = $.extend(arguments[1], csrf_form_base());
		post.apply(this, arguments);
	};

	var setup_csrf_token = function() {
		$('input[name="<?php echo $this->security->get_csrf_token_name(); ?>"]').val(csrf_token());
	};

	setup_csrf_token();

	$.ajaxSetup({
		dataFilter: function(data) {
			setup_csrf_token();
			return data;
		}
	});

	var submit = $.fn.submit;

	$.fn.submit = function() {
		setup_csrf_token();
		submit.apply(this, arguments);
	};

	session_sha1 = '<?php echo $this->session->userdata('session_sha1'); ?>';

	
	(function(lang, $) {

    var lines = {
        'common_submit' : "<?php echo $this->lang->line('common_submit') ?>",
        'common_cancel' : "<?php echo $this->lang->line('common_cancel') ?>"
    };

    $.extend(lang, {
        line: function(key) {
            return lines[key];
        }
    });


})(window.lang = window.lang || {}, jQuery);

    //activa el li del menu
    <?php
    if(isset($controller_name))
    {
    ?>
    $('#<?php echo $controller_name;?>').addClass("active");
   <?php
   }else{
   	?>
   	$('#home').addClass("active");
    <?php
    }
    if(isset($submodule))
    {
    ?>
    $('#<?php echo $submodule;?>').addClass("active");
   <?php
   }
   ?>
</script>
