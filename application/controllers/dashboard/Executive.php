<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class executive extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['executive_id'] = array('id'=>'new-executive');
		$data['executive_action'] = _URL.'dashboard/exNewMember';
		$data['patron_id'] = array('id'=>'new-patron');
		$data['patron_action'] = _URL.'dashboard/exNewPatron';
		$this->_render('dashboard/executive',$data);
	}
	public function memberList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="ctl ASC,company";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='company';elseif($_POST['order'][0]['column']==1)$option['order']='name';elseif($_POST['order'][0]['column']==2)$option['order']='appointment';elseif($_POST['order'][0]['column']==3)$option['order']='telno';elseif($_POST['order'][0]['column']==4)$option['order']='sorted';elseif($_POST['order'][0]['column']==5)$option['order']='created';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(name LIKE \'%'.$_POST['search']['value'].'%\' OR appointment LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results = $this->db->select(array('id','company','name','appointment','telno','sorted','DATE_FORMAT(created,"%b, %d %Y")`created`','ctl'))->where($option['search'])->order_by($option['order']." ".$option['dir'])->get_where('profile',array('position'=>'executive','ctl<>'=>2))->result_object();
			}else{
				$this->db->cache_off();
				$results = $this->db->select(array('id','company','name','appointment','telno','sorted','DATE_FORMAT(created,"%b, %d %Y")`created`','ctl'))->order_by($option['order']." ".$option['dir'])->get_where('profile',array('position'=>'executive','ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('profile',array('position'=>'executive','ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $member) {
					$data=array(
						"text-company"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$member->id."'><label></label></div><a href='javascript:;' class='executive-member' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this executive'>".strtoupper($member->company)."</strong></a>",
						"text-name"=>"<strong>".strtoupper($member->name)."</strong>",	
						"text-appointment"=>ucfirst($member->appointment),		
						"text-telno"=>"<strong>".$member->telno."</strong>",
						"id"=>$member->id,			
						"company"=>$member->company,
						"name"=>$member->name,	
						"appointment"=>$member->appointment,		
						"telno"=>$member->telno,
						"sorted"=>$member->sorted,
						"created"=>$member->created,
						"ctl"=>$member->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-company"=>"",
					"text-name"=>"",	
					"text-appointment"=>"",		
					"text-telno"=>"",
					"id"=>"",			
					"company"=>"",
					"name"=>"",	
					"appointment"=>"",		
					"telno"=>"",
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
	public function pantronList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="ctl ASC,position ASC,name";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='company';elseif($_POST['order'][0]['column']==1)$option['order']='name';elseif($_POST['order'][0]['column']==2)$option['order']='appointment';elseif($_POST['order'][0]['column']==3)$option['order']='telno';elseif($_POST['order'][0]['column']==4)$option['order']='sorted';elseif($_POST['order'][0]['column']==5)$option['order']='created';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(`name` LIKE "%'.$_POST['search']['value'].'%")';
				$this->db->cache_off();
				$results = $this->db->select(array('id','name','appointment','telno','sorted','DATE_FORMAT(created,"%b, %d %Y")`created`','ctl'))->where($option['search'])->group_start()->where('position','patron')->or_where('position','trustees')->group_end()->order_by($option['order']." ".$option['dir'])->get_where('profile',array('ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}else{
				$this->db->cache_off();
				$results = $this->db->select(array('id','name','appointment','telno','sorted','DATE_FORMAT(created,"%b, %d %Y")`created`','ctl'))->where('position','patron')->or_where('position','trustees')->order_by($option['order']." ".$option['dir'])->get_where('profile',array('ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->where('position','patron')->or_where('position','trustees')->get_where('profile',array('ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $member) {
					$data=array(
						"text-name"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$member->id."'><label></label></div><a href='javascript:;' class='patron-member' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this patron'>".strtoupper($member->name)."</strong></a>",	
						"text-appointment"=>ucfirst($member->appointment),		
						"text-telno"=>"<strong>".$member->telno."</strong>",
						"id"=>$member->id,			
						"name"=>$member->name,	
						"appointment"=>$member->appointment,		
						"telno"=>$member->telno,
						"sorted"=>$member->sorted,
						"created"=>$member->created,
						"ctl"=>$member->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-name"=>"",	
					"text-appointment"=>"",		
					"text-telno"=>"",
					"id"=>"",	
					"name"=>"",	
					"appointment"=>"",		
					"telno"=>"",
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
		$this->form_validation->set_rules('id','Executive', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('company', 'Member','trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('appointment', 'Appointment','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('telno', 'Phone','trim');
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']); 	      	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('profile');
			$this->session->set_flashdata('error', "You have been updated executive successfully!");
			redirect(_URL.'dashboard/executive');	
		}		
		$this->index();
	}
	public function editPatron()
	{
		$this->form_validation->set_rules('id','Patron', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('appointment', 'Appointment','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('telno', 'Phone','trim');
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']);
        	if($_POST['appointment']=='Board of trustees')$_POST['position']='trustees';else$_POST['position']='patron'; 	      	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('profile');
			$this->session->set_flashdata('error', "You have been updated patron successfully!");
			redirect(_URL.'dashboard/executive');	
		}		
		$this->index();
	}
	public function newMember()
	{
		$this->form_validation->set_rules('company', 'Member','trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('appointment', 'Appointment','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('telno', 'Phone','trim');
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		 	      	
            $_POST['created']=_DATE;
    		$_POST['position']='executive';
    		if(empty($_POST['sorted'])){
    			$sorted=$this->db->select('sorted')->order_by('sorted DESC')->get_where('profile',array('position'=>'executive','ctl<>'=>2))->row_object();
    			$_POST['sorted']=$sorted->sorted+1;
    		}
			$this->db->insert('profile',$_POST);
			$this->session->set_flashdata('error', "You have been added executive successfully!");
			redirect(_URL.'dashboard/executive');	
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
	public function newPatron()
	{
		$this->form_validation->set_rules('name', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('appointment', 'Appointment','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('telno', 'Phone','trim');
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		 	      	
            $_POST['created']=_DATE;
    		if($_POST['appointment']=='Board of trustees'){
    			$_POST['position']='trustees';
	    		if(empty($_POST['sorted'])){
	    			$sorted=$this->db->select('sorted')->order_by('sorted DESC')->get_where('profile',array('position'=>'trustees','ctl<>'=>2))->row_object();
	    			$_POST['sorted']=$sorted->sorted+1;
	    		}
    		}else{
    			$_POST['position']='patron';
	    		if(empty($_POST['sorted'])){
	    			$sorted=$this->db->select('sorted')->order_by('sorted DESC')->get_where('profile',array('position'=>'patron','ctl<>'=>2))->row_object();
	    			$_POST['sorted']=$sorted->sorted+1;
	    		}
    		}
			$this->db->insert('profile',$_POST);
			$this->session->set_flashdata('error', "You have been added patron/ trustees successfully!");
			redirect(_URL.'dashboard/executive');	
		}		
		$this->index();
	}
}
