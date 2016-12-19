$('.show-register-form').on('click', function(){
	if( ! $(this).hasClass('active') ) {
		$('.show-login-form').removeClass('active');
		$(this).addClass('active');
		$('.login-form').fadeOut('fast', function(){
			$('.register-form').fadeIn('fast');
		});
	}
});
$('.show-login-form').on('click', function(){
	if( ! $(this).hasClass('active') ) {
		$('.show-register-form').removeClass('active');
		$(this).addClass('active');
		$('.register-form').fadeOut('fast', function(){
			$('.login-form').fadeIn('fast');
		});
		}
});

var registerStep = 0;

$('.register-submit').on('click', function(event){
	if (registerStep == 0) {
		$('.step-0').fadeOut('fast', function(){
			$('.step-1').fadeIn('fast');
		});
	}
	if (registerStep == 1) {
		$('.step-1').fadeOut('fast', function(){
			$('.step-2').fadeIn('fast');
		});
	}
	if (registerStep == 2) {
		$(".fos_user_registration_register").submit();
	}
	registerStep++;
});
