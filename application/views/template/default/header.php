<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=!empty($title)?$title:null;?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if($css){foreach ($css as $link){echo link_tag($link);}}?>
  <?php if($js){foreach ($js as $link){echo ($link);}}?>
  <link rel="shortcut icon" href="<?=_IMG?>favicon.ico">
  <link rel="icon" type="image/png" href="<?=_IMG?>favicon32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?=_IMG?>favicon64x64.png" sizes="64x64">
</head>
<head>
<body>
	<section class="header <?=$bg_class?>" style="background:url('<?=$banner?>');">
		<div id="header-nav"></div>
		<div class="content">
			<?=$bg_content?>
		</div>
	</section>