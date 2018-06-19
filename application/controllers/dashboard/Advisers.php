<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advisers extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['advisers_action'] = _URL.'dashboard/editAdvisers';
		$this->db->cache_off();
		$data['advisers'] = $this->db->select(array('id','name','appointment','image','telno','description','sorted'))->order_by('sorted ASC, name ASC')->get_where('profile',array('position'=>'advisers','ctl<>'=>2))->result_object();

		$this->_render('dashboard/advisers',$data);
	}
	public function delAdvisers()
	{
		$this->form_validation->set_rules('id', 'Advisers','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
		{
			echo json_encode($this->db->set('ctl',2)
	            ->where(array('id'=>$_POST['id']))
				->update('profile'));
			exit;
		}
		$this->index();
	}
	public function editAdvisers()
	{
		$this->form_validation->set_rules('id','Advisers', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('appointment', 'Appointment','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('telno', 'Phone','trim');
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		$this->form_validation->set_rules('description', 'Description','trim');
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']);  
        	if(empty($_FILES['img-'.$id]['error'])){
				$img=$this->load->module('image')
				->file($_FILES['img-'.$id])
				->folder('people')
				->type('gif|jpg|png')
				->crCrop()
				->crThumb()
				->upImage();
				if(isset($img->error)){
					$this->session->set_flashdata('error',$img->error);
					redirect(_URL.'dashboard/advisers');
				}elseif(isset($img->name))$_POST['image']=$img->name;
			}	      	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('profile');
			$this->session->set_flashdata('error', "You have been updated advisers's profile successfully!");
			redirect(_URL.'dashboard/advisers');	
		}		
		$this->index();
	}
	public function newAdvisers()
	{
		$this->form_validation->set_rules('id','Advisers', 'trim|required',array('required' => 'You must provide a %s.'));
		if ($this->form_validation->run())
        {		
        	if($_POST['id']=='new'){
	        	$_post=array(
	        		'name'=>'Please key your name',
	        		'appointment'=>'Please key your appointment',
	        		'created'=>_DATE,
	        		'position'=>'advisers'
	        	);
				$this->session->set_flashdata('error', "You have been updated timeline successfully!");
	            echo json_encode($this->db->insert('profile',$_post));
			}
			redirect(_URL.'dashboard/advisers');	
		}		
		$this->index();
	}
}
