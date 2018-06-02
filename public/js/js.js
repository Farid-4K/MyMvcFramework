$(document).ready(function (){
	var styles = '<link rel="stylesheet" href="/dev/devstyle.css">';
	var extension = ''+
	'<div id="dev-sub-block">' +
	'<div class="-dev-button waves-effect waves-teal btn" id="dev-out">outline</div>' +
	'<div class="-dev-button waves-effect waves-teal btn" id="dev-css">code</div>' +
	'<div class="-dev-button waves-effect waves-teal btn" id="dev-css-min">code 50%</div>' +
	'<div class="-dev-button waves-effect waves-teal btn" id="dev-img">img</div>' +
	'<div class="-dev-button waves-effect waves-teal btn" id="dev-img-min">img 50%</div>' +
	'</div>';

	$("#content-dev").before(styles);
	$("#content-dev").before(extension);

	$("#dev-out").click(function (){
		$("*").toggleClass("-dev-outline");
	});

	$("#dev-sub-block").hover(function(){
		$("#dev-sub-block").animate({
			'right':'0px',
		},500,"swing");
	}, function (){
		$("#dev-sub-block").animate({
			'right':'-137px',
		},300,"swing");
	});

});
