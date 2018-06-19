<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$user['data']=789;
		$this->load->view('dashboard/app',$user,1);
	}
}
