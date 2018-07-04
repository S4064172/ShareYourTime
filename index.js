$("#xxx").click(function() {
	$('html, body').animate({
		scrollTop: parseInt($("#DettagliSito").offset().top)
	}, 1000);
});
