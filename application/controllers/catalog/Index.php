<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
	}
	public function index()
	{
		$this->load->_ci_title='MV Agusta Motorcycle Art – Official Website';
		$data['banner']=_IMG."system/mva-home-page_hero-1_1.jpg";
		$data['bg_class']="index-page";
		$data['bg_content']='<div class="container">'.
	      	'<div class="banner-text">'.
	        	'<h1>MOTORCYCLE ART</h1>'.
	        	'<span>On the shores of Lake Varese, in the same hangars where seaplanes were once built and launched, MV Agusta Motor continues in the tradition of handcrafting the most advanced motorcycles in the world.</span>'.
	      	'</div>'.
	    '</div>';
		$this->_render('template/default/index',$data);
	}
}
