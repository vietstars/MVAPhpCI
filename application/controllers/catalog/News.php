<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class news extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
	}
	public function index()
	{
		$this->load->_ci_title='News';
		$data['banner']=_IMG."system/mva-news-wide.jpg";
		$data['bg_class']="crc-page";
		$data['bg_content']='<div class="gradient-bg">'.
			'<div class="container">'.
				'<div class="banner-text">'.
					'<h1>NEWS</h1>'.
					'<span>Don\'t trail behind, keep up with the latest news about the MV world. Find out about exciting releases, presentations and events.</span>'.
				'</div>'.
			'</div>'.
		'</div>';
		$this->_render('template/default/news',$data);
	}
	public function detail($id='')
	{
		if($id){
			$this->load->_ci_title='News detail';
			$data['banner']=_IMG."system/mva_agusta_f3_news_landscape.jpg";
			$data['bg_class']="crc-page";
			$data['bg_content']='<div class="gradient-bg">'.
				'<div class="container">'.
					'<div class="banner-text news-text">'.
						'<h1>MV AGUSTA F3 675 RC & F3 800 RC - MODEL YEAR 2018</h1>'.
						'<span>Throughout MV Agusta\'s history, racing bikes and production models have always been closely entwined. A fact highlighted by extraordinary successes, such as the outstanding results achieved by the Italian manufacturer in recent years in ...</span>'.
					'</div>'.
				'</div>'.
			'</div>';
			$this->_render('template/default/detail',$data);
		}else{
			$this->index();
		}
	}
}
