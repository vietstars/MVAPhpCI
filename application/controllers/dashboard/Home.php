<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$this->load->_ci_title='Home';
		$data['tl_attributes'] = array('id' => 'intro-form');
		$data['tl_action'] = _URL.'dashboard/top_intro';
		$this->db->cache_off();
		$data['top_left'] = $this->db->select(array('name','appointment','image','title','content'))->get_where('main_content',array('id'=>1,'ctl<>'=>2))->row_object();

		$data['timeline_action'] = _URL.'dashboard/timeline';
		$this->db->cache_off();
		$data['timeline'] = $this->db->select(array('id','title','content','DATE_FORMAT(created,"%Y-%m-%d")`created`'))->order_by('created DESC, id DESC')->get_where('main_content',array('position'=>'timeline','ctl<>'=>2))->result_object();

		$data['il_attributes'] = array('id' => 'img-link');
		$data['il_action'] = _URL.'dashboard/img_link';
		$this->db->cache_off();
		$data['img_links'] = $this->db->select(array('id','image','title','position'))->where_in('id',array(2,3,4))->where(array('ctl<>'=>2))->get('main_content')->result_object();

		$data['bc_attributes'] = array('id' => 'content-form');
		$data['bc_action'] = _URL.'dashboard/bot_content';
		$this->db->cache_off();
		$data['bot_content'] = $this->db->select(array('name','appointment','image','title','content'))->get_where('main_content',array('id'=>5,'ctl<>'=>2))->row_object();

		$data['al_attributes'] = array('id' => 'association-link');
		$data['al_action'] = _URL.'dashboard/association_link';
		$this->db->cache_off();
		$data['al_links'] = $this->db->select(array('id','image','title','position'))->where_in('id',array(6,7,8))->where(array('ctl<>'=>2))->get('main_content')->result_object();

		$this->_render('dashboard/home',$data);
	}
	public function top_intro()
	{
		$this->form_validation->set_rules('name','Name', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('appointment', 'Appointment','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('title', 'Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('content', 'Content','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
        {
			$img=$this->load->module('image')
				->file($_FILES['person-img'])
				->folder('people')
				->type('gif|jpg|png')
				->crCrop()
				->crThumb()
				->upImage();			
			if(isset($img->name))$_POST['image']=$img->name;
            $this->db->set($_POST)
            ->where(array('id'=>1))
			->update('main_content');
			$this->session->set_flashdata('error', "You have been updated top left introduce successfully!");
			redirect(_URL.'dashboard/home');	
		}		
		$this->index();
	}
	public function bot_content()
	{
		$this->form_validation->set_rules('name','Name', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('appointment', 'Appointment','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('title', 'Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('content', 'Content','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
        {
			$img=$this->load->module('image')
				->file($_FILES['person-img'])
				->folder('people')
				->type('gif|jpg|png')
				->crCrop()
				->crThumb()
				->upImage();			
			if(isset($img->name))$_POST['image']=$img->name;
            $this->db->set($_POST)
            ->where(array('id'=>5))
			->update('main_content');
			$this->session->set_flashdata('error', "You have been updated bottom introduce successfully!");
			redirect(_URL.'dashboard/home');	
		}		
		$this->index();
	}
	public function img_link()
	{
		$this->form_validation->set_rules('2[title]', 'Event Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('2[position]', 'Event URL','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('3[title]', 'Executive Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('3[position]', 'Executive URL','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('4[title]', 'Member Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('4[position]', 'Member URL','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
		{
			foreach ($_POST as $id=>$post) {
				if(empty($_FILES['img-'.$id]['error'])){
					$img=$this->load->module('image')
					->file($_FILES['img-'.$id])
					->folder('system')
					->type('gif|jpg|png')
					->crCrop()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/home');
					}elseif(isset($img->name))$post['image']=$img->name;
				}				
				$this->db->set($post)
	            ->where(array('id'=>$id))
				->update('main_content');
			}
			$this->session->set_flashdata('error', "You have been updated image link options successfully!");
			redirect(_URL.'dashboard/home');
		}
		$this->index();
	}
	public function association_link()
	{
		$this->form_validation->set_rules('6[title]', 'Association left Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('6[position]', 'Association left URL','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('7[title]', 'Association middle Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('7[position]', 'Association middle URL','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('8[title]', 'Association right Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('8[position]', 'Association right URL','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
		{
			foreach ($_POST as $id=>$post) {
				if(empty($_FILES['img-'.$id]['error'])){
					$img=$this->load->module('image')
					->file($_FILES['img-'.$id])
					->folder('system')
					->type('gif|jpg|png')
					->crCrop()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/home');
					}elseif(isset($img->name))$post['image']=$img->name;
				}				
				$this->db->set($post)
	            ->where(array('id'=>$id))
				->update('main_content');
			}
			$this->session->set_flashdata('error', "You have been updated image link options successfully!");
			redirect(_URL.'dashboard/home');
		}
		$this->index();
	}
	public function delTimeline()
	{
		$this->form_validation->set_rules('id', 'Timeline','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
		{
			echo json_encode($this->db->set('ctl',2)
	            ->where(array('id'=>$_POST['id']))
				->update('main_content'));
			exit;
		}
		$this->index();
	}
	public function timeline()
	{
		$this->form_validation->set_rules('id','Timeline', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('title', 'Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('content', 'Content','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']);        	
        	(empty($_POST['created'])||$_POST['created']=='0000-00-00  00:00:00')?$_POST['created']=_DATE:$_POST['created'].=' 00:00:00';
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('main_content');
			$this->session->set_flashdata('error', "You have been updated timeline successfully!");
			redirect(_URL.'dashboard/home');	
		}		
		$this->index();
	}
	public function newTimeline()
	{
		$this->form_validation->set_rules('id','Timeline', 'trim|required',array('required' => 'You must provide a %s.'));
		if ($this->form_validation->run())
        {		
        	if($_POST['id']=='new'){
	        	$_post=array(
	        		'title'=>'Please key your title',
	        		'content'=>'Please key your content',
	        		'position'=>'timeline',
	        		'created'=>_DATE,
	        	);
				$this->session->set_flashdata('error', "You have been updated timeline successfully!");
	            echo json_encode($this->db->insert('main_content',$_post));
			}
			redirect(_URL.'dashboard/home');	
		}		
		$this->index();
	}
}
