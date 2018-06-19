<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class crc extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
	}
	public function index()
	{
		$this->load->_ci_title='CRC';
		$data['banner']=_IMG."system/mva-crc_hero-wide.jpg";
		$data['bg_class']="crc-page";
		$data['bg_content']='<div class="gradient-bg">'.
			'<div class="container">'.
				'<div class="banner-text">'.
					'<h1>CRC</h1>'.
					'<span>Located in the Republic of San Marino, the Castiglioni Research Centre (CRC) was created in 1993 by Claudio Castiglioni.</span>'.
				'</div>'.
			'</div>'.
		'</div>';
		$this->_render('template/default/crc',$data);
	}
}
