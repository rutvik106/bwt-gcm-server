$(document).ready(function()
{

	if($(window).width() < 1024)
	{

		$.Velocity.mock = true;

		$(function()
		{

			jQuery.fx.off = true;

		});

	}

});