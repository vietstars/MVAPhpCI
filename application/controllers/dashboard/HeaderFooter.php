<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HeaderFooter extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['scroller_action'] = _URL.'dashboard/editScroller';
		$this->db->cache_off();
		$data['scroller'] = $this->db->select(array('id','image','description','sorted'))->order_by('sorted ASC, id ASC')->get_where('profile',array('position'=>'banner','ctl<>'=>2))->result_object();
		$this->_render('dashboard/headerFooter',$data);
	}
	public function delScroller()
	{
		$this->form_validation->set_rules('id', 'Message','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
		{
			echo json_encode($this->db->set('ctl',2)
	            ->where(array('id'=>$_POST['id']))
				->update('profile'));
			exit;
		}
		$this->index();
	}
	public function editScroller()
	{
		$this->form_validation->set_rules('id','Scroller baner', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('sorted', 'Sort number','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('description', 'Description','trim');
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']);  
        	if(empty($_FILES['img-'.$id]['error'])){
				$img=$this->load->module('image')
				->file($_FILES['img-'.$id])
				->folder('banner')
				->type('gif|jpg|png')
				->crCrop(0,1903,335)
				->crThumb()
				->upImage();
				if(isset($img->error)){
					$this->session->set_flashdata('error',$img->error);
					redirect(_URL.'dashboard/headerFooter');
				}elseif(isset($img->name))$_POST['image']=$img->name;
			}	      	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('profile');
			$this->session->set_flashdata('error', "You have been updated scroller banner successfully!");
			redirect(_URL.'dashboard/headerFooter');	
		}		
		$this->index();
	}
	public function newScroller()
	{
		$this->form_validation->set_rules('id','Message', 'trim|required',array('required' => 'You must provide a %s.'));
		if ($this->form_validation->run())
        {		
        	if($_POST['id']=='new'){
	        	$_post=array(
	        		'description'=>'Please key your description',
	        		'created'=>_DATE,
	        		'position'=>'banner'
	        	);
				$this->session->set_flashdata('error', "You have been added scroller banner successfully!");
	            echo json_encode($this->db->insert('profile',$_post));
			}
			redirect(_URL.'dashboard/headerFooter');	
		}		
		$this->index();
	}
}
