<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<?php if($css)
	{
		foreach ($css as $link)
		{
			echo link_tag($link);
		}
	}
	?>
	<?php if($js)
	{
		foreach ($js as $link)
		{
			echo ($link);
		}
	}
	?>
</head>
<body>