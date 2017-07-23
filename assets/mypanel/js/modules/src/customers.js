$(document).ready(function(){
/* function formValidation */
$('#customer-form').formValidation({
	framework: 'bootstrap',
	trigger: 'blur',
	verbose: false,
	icon: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh glyphicon-spin'
	},
	fields: {
		first_name: {
			validators: {
				notEmpty: {
					message: lang.line('validation_required').replace('{0}', lang.line("common_first_name"))
				}
			}
		},
		last_name: {
			validators: {
				notEmpty: {
					message: lang.line('validation_required').replace('{0}', lang.line("common_last_name"))
				}
			}
		},
		email:{
			validators: {
				notEmpty: {
					message: lang.line('validation_required').replace('{0}', lang.line("common_email"))
				},
				emailAddress: {
					message: lang.line('validation_email_match')
				},
				stringLength: {
					max: 512,
					message: lang.line('validation_max_length').replace('{0}', lang.line('common_email')).replace('{1}', 512)
				},
				remote: {
					async: true,
					url: base_url($controller_name+'/InputValidator'),
					type: 'POST',
					data: $.extend(csrf_form_base(),
					{
						"person_id" : $('#customer-form').attr('data-ved')
					})
				}
			}
		},
		rfc:{
			enabled: false,
			validators: {
				remote: {
					async: true,
					url: base_url($controller_name+'/InputValidator'),
					type: 'POST',
					data: $.extend(csrf_form_base(),
					{
						"person_id" : $('#customer-form').attr('data-ved')
					})
				}
			}
		}
    }
}).on('err.validator.fv', function(e, data) {

	if (data.field === 'email' && data.validator === 'remote') {
		var not_valid = data.result.not_valid;
		// Update the message
		not_valid? data.fv.updateMessage('email', 'remote', lang.line('validation_not_valid').replace('{0}', lang.line("common_email"))): data.fv.updateMessage('email', 'remote', lang.line('validation_in_use').replace('{0}', lang.line("common_email")));
	}

	if (data.field === 'rfc' && data.validator === 'remote') {
		var not_valid = data.result.not_valid;
		// Update the message
		not_valid? data.fv.updateMessage('rfc', 'remote', lang.line('validation_not_valid').replace('{0}', lang.line($controller_name+"_rfc"))): data.fv.updateMessage('rfc', 'remote', lang.line('validation_in_use').replace('{0}', lang.line($controller_name+"_rfc")));
	}
}).on('success.form.fv', function(e) {

            e.preventDefault();

            var $form = $(e.target);
            $form.ajaxSubmit({
                url: $form.attr('action'),
                dataType: 'json',
                success: function(response) {
                    if(response.success){
						$(location).attr('href',base_url($controller_name));
					}else{
						$.notify(response.message, { type: 'danger' });
					}
                }
            });
        }).on('change', '[name="rfc"]', function() {
            var isEmpty = $(this).val() == '';
            $('#customer-form').formValidation('enableFieldValidators', 'rfc', !isEmpty);
        });
});