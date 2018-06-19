<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['contact_id'] = array('id'=>'edit-contact');
		$data['contact_action'] = _URL.'dashboard/editContact';
		$data['contac_info']=$this->db->select(array('id','sys_key','sys_value'))->order_by('id ASC')->get_where('system',array('`type`'=>'contact'))->result_object();
		$this->_render('dashboard/contact',$data);
	}
	public function contactList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="DESC";
			$option['order']="ctl ASC, id";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==1)$option['order']='email';if($_POST['order'][0]['column']==3)$option['order']='id';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(name LIKE \'%'.$_POST['search']['value'].'%\' OR email LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results = $this->db->select(array('id','name','email','message','DATE_FORMAT(created,"%b, %d %Y")`created`','ctl'))->where($option['search'])->order_by($option['order']." ".$option['dir'])->get_where('contact',array('ctl<>'=>2))->result_object();
			}else{
				$this->db->cache_off();
				$results = $this->db->select(array('id','name','email','message','DATE_FORMAT(created,"%b, %d %Y")`created`','ctl'))->order_by($option['order']." ".$option['dir'])->get_where('contact',array('ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('contact',array('ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $contact) {
					$data=array(
						"text-name"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$contact->id."'><label></label></div><a href='javascript:;'  data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to view message'>".$contact->name."</strong></a>",
						"name"=>$contact->name,
						"email"=>$contact->email,
						"text-message"=>$this->load->module('text')->cut($contact->message,150),
						"message"=>$contact->message,
						"created"=>$contact->created,
						"ctl"=>$contact->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-name"=>"",
					"name"=>"",
					"email"=>"",
					"text-message"=>"",
					"message"=>"",
					"created"=>"",
					"ctl"=>0
				);
			}
			$all['draw']=$_POST['draw'];
			$all['recordsTotal']=$total->total;
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$all['recordsFiltered']=count($results);
			}else{
				$all['recordsFiltered']=$total->total;
			}
			$all['data']=$datas;
		    echo json_encode($all);
		}
	}
	public function editContact()
	{
		$this->form_validation->set_rules('ct_address', 'Address','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('ct_email', 'Email','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('ct_phone', 'Phone','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('ct_fax', 'Fax','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
        {		
        	foreach ($_POST as $k => $v) {
	            $this->db->set(array('sys_value'=>$v))
	            ->where(array('sys_key'=>$k))
				->update('system');
			}
			$this->session->set_flashdata('error', "You have been updated contact information successfully!");
			redirect(_URL.'dashboard/contact');	
		}		
		$this->index();
	}
	public function delContact()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('contact'));	
		}
	}
}
