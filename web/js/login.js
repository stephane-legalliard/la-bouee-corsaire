jQuery(document).ready(function() {
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
});
