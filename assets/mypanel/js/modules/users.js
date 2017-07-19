$(document).ready(function(){
/*------------------------------------------------*/
/*  users/add
/*------------------------------------------------*/
/* function formValidation */
$('#form-login').formValidation({
	framework: 'bootstrap',
	trigger: 'blur',
	verbose: false,
	icon: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh glyphicon-spin'
	},
	fields: {
		username: {
			validators: {
				notEmpty: {
					message: lang.line('validation_required').replace('{0}', lang.line("users_nickname"))
				},
				stringLength: {
					min: 6,
					max: 15,
					message: lang.line('validation_between_length').replace('{0}', lang.line("users_nickname")).replace('{1}', 6).replace('{2}', 15)
				},
				regexp: {
					regexp: /^[a-z0-9\.]+$/,
					message: lang.line('validation_alpha_numeric_point')
				},
				remote: {
					async: true,
					url: base_url('users/InputValidator'),
					type: 'POST',
					data: csrf_form_base()
				}
			}
		},
		password: {
			enabled: false,
			validators: {
				notEmpty: {
					message: lang.line('validation_required2').replace('{0}', lang.line("users_password"))
				},
				stringLength: {
					min: 8,
					message: lang.line('validation_min_length').replace('{0}', lang.line("users_password")).replace('{1}', 8)
				}
			}
		},
		confirm_password: {
			enabled: false,
			validators: {
				notEmpty: {
					message: lang.line('validation_required2').replace('{0}', lang.line("users_confirmation_password"))
				},
				identical: {
					field: 'password',
					message: lang.line('validation_password_identical')
				}
			}
		},
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
			enabled: false,
			validators: {
				emailAddress: {
					message: lang.line('validation_email_match')
				},
				stringLength: {
					max: 512,
					message: lang.line('validation_max_length').replace('{0}', lang.line('common_email')).replace('{1}', 512)
				},
				remote: {
					async: true,
					url: base_url('users/InputValidator'),
					type: 'POST',
					data: csrf_form_base()
				}
			}
		},
        'grants[]': {
        	validators: {
        		callback: {
        			message: lang.line('validation_subpermission_required'),
        			callback: function (value, validator, $field) {
        			var result = $("#permission_list input").is(":checked");
					$(".module").each(function(index, element) {
						var parent = $(element).parent();
						var checked =  $(element).is(":checked");
						if ($("ul", parent).length > 0 && result) {
							result &= !checked || (checked && $("ul > li > input:checked", parent).length > 0);
						}
					});
					if(result===0) {
						result=false;
					}

					return result;

					}
				}
			}
        }
    }
}).on('err.validator.fv', function(e, data) {

	if (data.field === 'username' && data.validator === 'remote') {
		var suggestions = data.result.suggestions;
		// Update the message
		suggestions? data.fv.updateMessage('username', 'remote', lang.line('validation_in_use').replace('{0}', lang.line("users_nickname"))+'<br/>'+lang.line('validation_availables') + suggestions.join(', ')): data.fv.updateMessage('username', 'remote', lang.line('validation_not_available').replace('{0}', lang.line("users_nickname")));
	}

	if (data.field === 'email' && data.validator === 'remote') {
		var not_valid = data.result.not_valid;
		// Update the message
		not_valid? data.fv.updateMessage('email', 'remote', lang.line('validation_not_valid').replace('{0}', lang.line("common_email"))): data.fv.updateMessage('email', 'remote', lang.line('validation_in_use').replace('{0}', lang.line("common_email")));
	}
}).on('keyup', '[name="password"]', function() {
	var isEmpty = $(this).val() == '';
	$('#form-login').formValidation('enableFieldValidators', 'password', !isEmpty).formValidation('enableFieldValidators', 'confirm_password', !isEmpty);
	 
	 var isEnable = $("#password-label").hasClass('required');
	 $('#form-login').formValidation('enableFieldValidators', 'password', isEnable);

	 if ($(this).val().length >= 1) {
	 	$('#form-login').formValidation('enableFieldValidators', 'password', true);
	 }

	var value = $(this).val(), score = 0, $bar = $('#passwordMeter').find('.progress-bar');
                                
    // Check the password strength
    score += ((value.length >= 8) ? 1 : -1);

    // The password contains uppercase character
    if (/[A-Z]/.test(value)) {
        score += 1;
    }

    // The password contains uppercase character
    if (/[a-z]/.test(value)) {
        score += 1;
    }

    // The password contains number
    if (/[0-9]/.test(value)) {
        score += 1;
    }

    // The password contains special characters
    if (/[!#$%&^~*_]/.test(value)) {
        score += 1;
    }

    // Check the password strength
    ((value.length < 8) ? score=-1 : score += 0);

    if (value === '') {
    	score=null;
    }
                                
    switch (true) {
        case (score === null):
            $bar.html('').css('width', '0%').removeClass().addClass('progress-bar');
            break;
        case (score <= 0):
            $bar.html(lang.line('validation_password_very_weak')).css('width', '25%').removeClass().addClass('progress-bar progress-bar-danger');
            break;
        case (score > 0 && score <= 2):
            $bar.html(lang.line('validation_password_weak')).css('width', '50%').removeClass().addClass('progress-bar progress-bar-warning');
            break;
        case (score > 2 && score <= 4):
            $bar.html(lang.line('validation_password_medium')).css('width', '75%').removeClass().addClass('progress-bar progress-bar-info');
            break;
        case (score > 4):
            $bar.html(lang.line('validation_password_strong')).css('width', '100%').removeClass().addClass('progress-bar progress-bar-success');
            break;
        default:
            break;
    }
}).on('change', '[name="email"]', function() {
	var isEmpty = $(this).val() == '';
	$('#form-login').formValidation('enableFieldValidators', 'email', !isEmpty)
}).bootstrapWizard({
	'tabClass': 'nav nav-pills',
	onTabClick: function() {
		return false;
	},
	onNext: function(tab, navigation, index) {
		var total = navigation.find('li').length;
		var current = index+1;
		//var parsleyForm = $('#form-circle-wizard'+index).parsley();
		var isValidTab = validateTab(index - 1);

		if (!isValidTab) {
			return false;
		}

		// if not last tab
		if(current <= total) {
			tab.addClass('done');
		}
	},
	onTabShow: function(tab, navigation, index) {
		var total = navigation.find('li').length;
		var current = index+1;
		// if last button
		if(current >= total ) {
			$('#form-login').find('.pager .next').hide();
			$('#form-login').find('.pager .last').show().removeClass('disabled');

			// show confirmation info
			$('#outputNickname').text($('#username').val());
			$('#outputName').text($('#first_name').val()+' '+$('#last_name').val());
					
			if($('#email').val()===''){
				$('#outputEmail').hide();
				$('#outputlabel').hide();
			}else{
				$('#outputEmail').show();
				$('#outputlabel').show();
				$('#outputEmail').text($('#email').val());
			}
			
		} else {
			$('#form-login').find('.pager .next').show();
			$('#form-login').find('.pager .last').hide();
		}

		tab.removeClass('done');
	},
	onLast: function(tab, navigation, index) {
		$('#form-login').ajaxSubmit({
				success: function(response) {
					if(response.success){
						$(location).attr('href',base_url('users'));
					}else{
						$.notify(response.message, 'danger');
					}
				},
				dataType:'json'
			});
	}
});

var isEnable = $("#password-label").hasClass('required');
$('#form-login').formValidation('enableFieldValidators', 'password', isEnable);

function validateTab(index) {
	var fv= $('#form-login').data('formValidation'),

	// The current tab
	$tab = $('#form-login').find('.tab-pane').eq(index);

	// Validate the container
	fv.validateContainer($tab);

	var isValidStep = fv.isValidContainer($tab);
	if (isValidStep === false || isValidStep === null) {
	// Do not jump to the target tab
		return false;
	}

	return true;
}

/*checkbox permissions*/

$("ul#permission_list > li > input[name='grants[]']").each(function() {
	var $this = $(this);
	$("ul > li > input", $this.parent()).each(function() {
		var $that = $(this);
		var updateCheckboxes = function (checked) {
			$that.prop("disabled", !checked);
			!checked && $that.prop("checked", false);
		}
		$this.change(function() {
			updateCheckboxes($this.is(":checked"));
		});
		updateCheckboxes($this.is(":checked"));
	});
});

});//end