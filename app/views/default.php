<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{TITLE}}</title>
	{% for style in STYLES %}
	<link rel="stylesheet" href="/public/css/{{style}}">
	{% endfor %}
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,600">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<!-- develJS -->
	<link href="/public/css/devstyle.css" rel="stylesheet">
	<div id="content-dev"></div>


	{% include CONTENT %}


	<script src="/public/js/js.js"></script>
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

</body>
</html>
