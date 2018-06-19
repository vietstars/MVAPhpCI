<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['executive_id'] = array('id'=>'new-executive');
		$data['executive_action'] = _URL.'dashboard/newMember';
		$this->_render('dashboard/member',$data);
	}
	public function memberList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="ctl ASC,sorted ASC, created";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='company';elseif($_POST['order'][0]['column']==1)$option['order']='name';elseif($_POST['order'][0]['column']==2)$option['order']='appointment';elseif($_POST['order'][0]['column']==3)$option['order']='telno';elseif($_POST['order'][0]['column']==4)$option['order']='sorted';elseif($_POST['order'][0]['column']==5)$option['order']='created';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(company LIKE \'%'.$_POST['search']['value'].'%\' OR appointment LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results = $this->db->select(array('id','company','name','appointment','telno','fax','DATE_FORMAT(created,"%Y-%m-%d")`created`','sorted','ctl'))->where($option['search'])->order_by($option['order']." ".$option['dir'])->get_where('profile',array('position'=>'member','ctl<>'=>2))->result_object();
			}else{
				$this->db->cache_off();
				$results = $this->db->select(array('id','company','name','appointment','telno','fax','DATE_FORMAT(created,"%Y-%m-%d")`created`','sorted','ctl'))->order_by($option['order']." ".$option['dir'])->get_where('profile',array('position'=>'member','ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('profile',array('position'=>'member','ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $member) {
					$data=array(
						"text-company"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$member->id."'><label></label></div><a href='javascript:;' class='event-event' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this event'>".strtoupper($member->company)."</strong></a>",	
						"text-address"=>"<strong>".$member->name."</strong>",
						"text-telno"=>"<strong>".$member->telno."</strong><br><small>".$member->fax."</small>",
						"text-email"=>"<strong>".$member->appointment."</strong>",
						"id"=>$member->id,			
						"company"=>$member->company,		
						"address"=>$member->name,					
						"email"=>$member->appointment,			
						"telno"=>$member->telno,		
						"fax"=>$member->fax,
						"sorted"=>$member->sorted,
						"created"=>$member->created,
						"ctl"=>$member->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-company"=>"",	
					"text-address"=>"",
					"text-telno"=>"",
					"text-email"=>"",
					"id"=>"",			
					"company"=>"",		
					"address"=>"",			
					"email"=>"",			
					"telno"=>"",			
					"fax"=>"",
					"sorted"=>"",
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
	public function editMember()
	{
		$this->form_validation->set_rules('id','Member', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('company', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('name', 'Address','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('appointment', 'Email','trim',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('telno', 'telno','trim',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']);  	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('profile');
			$this->session->set_flashdata('error', "You have been updated member successfully!");
			redirect(_URL.'dashboard/member');	
		}		
		$this->index();
	}
	public function newMember()
	{
		$this->form_validation->set_rules('company', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('name', 'Address','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('appointment', 'Email','trim',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('telno', 'telno','trim',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		 	      	
            $_POST['created']=_DATE;
    		$_POST['position']='member';
    		if(empty($_POST['sorted'])){
    			$sorted=$this->db->select('sorted')->order_by('sorted DESC')->get_where('profile',array('position'=>'member','ctl<>'=>2))->row_object();
    			$_POST['sorted']=$sorted->sorted+1;
    		}
			$this->db->insert('profile',$_POST);
			$this->session->set_flashdata('error', "You have been added member successfully!");
			redirect(_URL.'dashboard/member');	
		}		
		$this->index();
	}
	public function lockMember()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('profile'));	
		}			  
	}
	public function unlockMember()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('profile'));	
		}
	}
	public function delMember()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('profile'));	
		}
	}
}
