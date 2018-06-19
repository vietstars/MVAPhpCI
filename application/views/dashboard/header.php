<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>DASHBOARD || SMCTA <?=!empty($title)?ucfirst($title):null;?></title>
	<?php if($css){foreach ($css as $link){echo link_tag($link);}}?>
	<?php if($js){foreach ($js as $link){echo ($link);}}?>
  <link rel="icon" type="image/png" href="<?=_IMG.'bot_logo.png'?>">
</head>
<body>
<?php $error=$this->session->flashdata('error');if(!empty($error)){echo '<div class="alert alert-danger notify container" role="alert" style="display:block">'.$error.'</div>';}
  $error=validation_errors();if(!empty($error)){ echo '<div class="alert alert-danger notify container" role="alert" style="display:block">'.$error.'</div>';}
  $_smcta=array('home','advisers','executive','event','member','message');
  $_bikemart=array('newbikes','usedbikes','accessories','auction','insurance','merchants','articles');
  $_account=array('user','customer');
?>
<section class='header <?= (in_array($this->router->class,$_smcta)||in_array($this->router->class,$_bikemart))?"home-ctl":"";?>'>
	<nav class="navbar fixed-top navbar-expand-lg">
	  	<a class="navbar-brand" href="<?=_URL?>" target='_blank'>
	  		<img src="<?=_IMG.'bot_logo.png'?>" height="96px" alt="">
	  	</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded=	"false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
	  	</button>
	  	<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
	    	<div class="navbar-nav">
	      		<a class="nav-item nav-link disabled" href="#"><span class="avatar-group"><img src="<?=$this->module('image')->getAvatar($this->_user_id)?>" class="img-avatar" alt="user avatar"><span class='icon-drop text-center'><i class="la la-chevron-circle-down"></i></span></span>Hello, <span class='user-name'><?=ucfirst($this->_user_name)?></span></a>
	      		<a class="nav-item nav-link" href="<?=_URL.'logout'?>"><i class="la la-sign-out"></i> Logout</a>
	    	</div>
	  	</div>
	</nav>
  <?php if(in_array($this->router->class,$_smcta)):?>
    <div class="home-menu">
      <div class="row">
        <div class="col-1 left-padding"></div>
        <div class="col-11 right-menu">
   				<a href="<?=_URL.'dashboard/home'?>" class="tab-title <?=strtolower($this->router->class)=='home'?'active':null;?>">Home</a>
   				<a href="<?=_URL.'dashboard/advisers'?>" class="tab-title <?=strtolower($this->router->class)=='advisers'?'active':null;?>">Advisers & consultant</a>
   				<a href="<?=_URL.'dashboard/executive'?>" class="tab-title <?=strtolower($this->router->class)=='executive'?'active':null;?>">Executive committee</a>
   				<a href="<?=_URL.'dashboard/event'?>" class="tab-title <?=strtolower($this->router->class)=='event'?'active':null;?>">Event activities</a>
   				<a href="<?=_URL.'dashboard/member'?>" class="tab-title <?=strtolower($this->router->class)=='member'?'active':null;?>">members listing</a>
   				<a href="<?=_URL.'dashboard/message'?>" class="tab-title <?=strtolower($this->router->class)=='message'?'active':null;?>">Messages</a>
    </div></div></div>
  <?php elseif(in_array($this->router->class,$_bikemart)):?>
    <div class="home-menu">
      <div class="row">
        <div class="col-1 left-padding"></div>
        <div class="col-11 right-menu">
          <a href="<?=_URL.'dashboard/newbikes'?>" class="tab-title <?=strtolower($this->router->class)=='newbikes'?'active':null;?>">Newbikes</a>
          <a href="<?=_URL.'dashboard/usedbikes'?>" class="tab-title <?=strtolower($this->router->class)=='usedbikes'?'active':null;?>">Usedbikes</a>
          <a href="<?=_URL.'dashboard/accessories'?>" class="tab-title <?=strtolower($this->router->class)=='accessories'?'active':null;?>">Accessories</a>
          <a href="<?=_URL.'dashboard/auction'?>" class="tab-title <?=strtolower($this->router->class)=='auction'?'active':null;?>">Auction</a>
          <a href="<?=_URL.'dashboard/insurance'?>" class="tab-title <?=strtolower($this->router->class)=='insurance'?'active':null;?>">Insurance</a>
          <a href="<?=_URL.'dashboard/merchants'?>" class="tab-title <?=strtolower($this->router->class)=='merchants'?'active':null;?>">Directory</a>
          <a href="<?=_URL.'dashboard/articles'?>" class="tab-title <?=strtolower($this->router->class)=='articles'?'active':null;?>">Articles</a>
    </div></div></div>
  <?php endif;?>
</section>
<section class='body row'>
    <div class="col-1 left-menu">
   		<ul class="menu">
   			<li <?= ($this->router->class=='headerFooter')?'class="active"':null;?>><a href="<?=_URL.'dashboard/headerFooter'?>"><i class="la la-edit la-2x"></i>Header & Footer</a></li>
   			<li <?= in_array($this->router->class,$_smcta)?'class="active"':null;?>><a href="<?=_URL.'dashboard/home'?>"><i class="la la-home la-2x"></i>Smcta</a></li>
   			<li <?= in_array($this->router->class,$_bikemart)?'class="active"':null;?>><a href="<?=_URL.'dashboard/newbikes'?>"><i class="la la-motorcycle la-2x"></i>Bikemart</a></li>
   			<li class='sub-menu <?= in_array($this->router->class,$_account)?'active':null;?>'>
   				<a class='sub-menu'><i class="la la-user la-2x"></i>Account</a>
   				<ul class="sub-menu">
   					<li><a href="<?=_URL.'dashboard/user'?>" <?=strtolower($this->router->class)=='user'?'class="active"':null;?>>Admin</a></li>
            <li><a href="<?=_URL.'dashboard/customer'?>" <?=strtolower($this->router->class)=='customer'?'class="active"':null;?>>Customer</a></li>
   				</ul>
   			</li>
   			<li <?=strtolower($this->router->class)=='contact'?'class="active"':null;?>><a href="<?=_URL.'dashboard/contact'?>"><i class="la la-map-marker la-2x"></i>Contact</a></li>
   		</ul>
    </div>
