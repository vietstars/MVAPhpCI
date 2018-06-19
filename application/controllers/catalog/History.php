<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class history extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
	}
	public function index()
	{
		$this->load->_ci_title='A great story';
		$data['banner']=_IMG."system/mva-history-podium-wide.jpg";
		$data['bg_class']="crc-page";
		$data['bg_content']='<div class="gradient-bg">'.
			'<div class="container">'.
				'<div class="banner-text">'.
					'<h1>A GREAT STORY</h1>'.
					'<span>Passion, racing, victories. From aeronautics to motorcycles. A history made of people, joys and drama.</span>'.
				'</div>'.
			'</div>'.
		'</div>';
		$this->_render('template/default/history',$data);
	}
}
