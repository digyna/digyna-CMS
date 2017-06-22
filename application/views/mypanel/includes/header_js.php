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

	

</script>
