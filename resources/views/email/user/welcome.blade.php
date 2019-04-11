<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>
	Hi {{ $name }},<br/>
	Welcome to {{ config('app.name') }}
	<br/><br/>

	Thanks,<br/>
	{{ config('app.name') }}
</body>
</html>