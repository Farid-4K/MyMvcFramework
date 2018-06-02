$(document).ready(function() {
	$('form').submit(function(event) {
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
				$(".loader").removeClass("hidden");
			},
			success: function(result) {
				json = jQuery.parseJSON(result);
				// $(".loader").addClass("hidden");
				if (json.url) {
					window.location.href = '/' + json.url;
				} else {
					// alert(json.status + ' - ' + json.message);
					M.toast({html: json.status+' - '+json.message})
					// $("#notification").html('<div class="notification z-depth-3"><div class="h5">' + json.status + '</div><div class="h4">' + json.message + '</div></div><script>$(".notification").click(function (){$(this).fadeOut(400,"swing");});</script>');
				}
			},
		});
	});
});