<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
	}
	public function index($id=false)
	{
		if($id){
			$this->load->_ci_title='Models';
			$data['banner']=_IMG."system/brutale_800_rr_hero_landscape_0.jpg";
			$data['bg_class']="index-page";
			$data['bg_content']='<div class="container banner-top">'.
				'<div class="model-spec-text">'.
					'<h5 class="model-title">Brutale 800 RR</h5>'.
					'<h1 class="model-descript">POWER, MORE IS BETTER</h1>'.
					'<ul class="models-list">'.
						'<li>800</li>'.
						'<li class="active">800 RR</li>'.
						'<li>800 RR AMERICA</li>'.
						'<li>800 RR PIRELLI</li>'.
						'<li>800 RC</li>'.
					'</ul>'.
					'<ul class="spec-list row">'.
						'<li class="col-md-2">'.
							'<h3><small>CYLINDERS</small>3</h3>'.
						'</li>'.
						'<li class="col-md-2">'.
							'<h3><small>CYLINDERS CAPACITY (CC)</small>789</h3>'.
						'</li>'.
						'<li class="col-md-2">'.
							'<h3><small>HORSEPOWER (HP)</small>140</h3>'.
						'</li>'.
						'<li class="col-md-2">'.
							'<h3><small>MAXIMUM SPEED (KM/H)</small>244</h3>'.
						'</li>'.
						'<li class="col-md-2">'.
							'<h3><small>DRY WEIGHT (KG)</small>175</h3>'.
						'</li>'.
						'<li class="col-md-2">'.
							'<h3><small>STARTING PRICE (€)</small>15.770*</h3>'.
						'</li>'.
						'<small class="pull-right">* Any country could have a price variation due to local import duties and taxes</small>'.
					'</ul>'.
				'</div>'.
			'</div>';
			$this->_render('template/default/model',$data);
		}else{
			redirect(_URL);
		}
	}
}
