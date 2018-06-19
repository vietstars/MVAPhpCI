<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class contact extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
	}
	public function index()
	{
		$this->load->_ci_title='Contact MV Agusta';
		$data['banner']=_IMG."system/mva_contact_us_wide.jpg";
		$data['bg_class']="aboutus-page";
		$data['bg_content']='<div class="gradient-bg">'.
			'<div class="container">'.
				'<div class="banner-text contact-text">'.
					'<h1>CONTACT MV AGUSTA SINGAPORE</h1>'.
					'<span>Keep in touch with your passion.</span>'.
				'</div>'.
			'</div>'.
		'</div>';
		$this->_render('template/default/contact',$data);
	}
}
