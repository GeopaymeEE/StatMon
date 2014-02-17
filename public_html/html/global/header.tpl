<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{$pagetitle}</title>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/style.css">
<script src="/js/jquery-2.1.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">StatMon</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/?view=addserver">Add server</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	{if isset($message_ok) && count($message_ok)}
	<div class="container">
		<div class="row">
			{foreach $message_ok as $text}<div class="alert alert-success">{$text}</div>{/foreach}
		</div>
	</div>
	{/if}
	
	{if isset($message_error) && count($message_error)}
	<div class="container">
		<div class="row">
			{foreach $message_error as $text}<div class="alert alert-danger">{$text}</div>{/foreach}
		</div>
	</div>
	{/if}