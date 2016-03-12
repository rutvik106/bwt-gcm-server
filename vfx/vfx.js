function vfxAnimInit(){

	

	$('#root')
	.velocity('transition.swoopIn',{

		options: { duration: 200}


	});

	vfxAnimLabels();

}

function vfxAnimLabels(){

	(function($){
		
		$('.label')
		.velocity('transition.slideLeftIn',{

			delay: 500,
			duration: 500,
			opacity:1
		});

	})(jQuery);

	(function($){
		
		$('#type')
		.velocity('transition.slideLeftIn',{

			delay: 500,
			duration: 500,
			opacity:1
		});

	})(jQuery);

	vfxAnimComponents();

}

function vfxAnimComponents(){

	(function($){
		
		$('.component')
		.velocity('transition.perspectiveDownIn',{

			delay: 500,
			duration: 800,
			opacity:1
		});

	})(jQuery);

	vfxAnimPushButton()

}

function vfxAnimPushButton(){

	(function($){
		
		$('.my-button')
		.velocity('transition.perspectiveDownIn',{

			delay: 700,
			duration: 700,
			opacity:1
		});

	})(jQuery);

}


function vfxAnimLoginError(){

	(function($){
		
		$('#login-error')
		.velocity('stop', true)
		.velocity('transition.fadeIn',{
			duration: 100
		})
		.velocity('callout.tada',{
			duration: 700
		})
		.velocity('transition.fadeOut',{
			delay: 2000,
			duration: 400
		});

	})(jQuery);

}

function vfxAnimRootShrinkIn(){

	(function($){
		
		$('#root')
		.velocity('transition.shrinkIn',{
			duration: 500
		});

	})(jQuery);

}