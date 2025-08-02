<?php
header('HTTP/1.1 503 Service Temporarily Unavailable',true,503);
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 3600');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex,nofollow">
<title>503 - Temporarily Closed For Maintenance</title>
<style type="text/css">
<!--
p {font-family: "Verdana", sans-serif;}
-->
</style>
</head>
<body> 
<h1>Down for maintenance - please try again later</h1>
<p>The site is undergoing a short maintenance. Sorry for the inconvenience.</p>
<p>Normal operation will resume as soon as possible.</p> 
</body>
</html>
