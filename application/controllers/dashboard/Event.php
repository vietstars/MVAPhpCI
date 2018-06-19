<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class event extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['executive_id'] = array('id'=>'new-executive');
		$data['executive_action'] = _URL.'dashboard/newEvent';
		$this->_render('dashboard/event',$data);
	}
	public function eventList()
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
				$option['search']='(description LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results = $this->db->select(array('id','name','description','DATE_FORMAT(created,"%Y-%m-%d")`created`','sorted','ctl'))->where($option['search'])->order_by($option['order']." ".$option['dir'])->get_where('profile',array('position'=>'event','ctl<>'=>2))->result_object();
			}else{
				$this->db->cache_off();
				$results = $this->db->select(array('id','name','description','DATE_FORMAT(created,"%Y-%m-%d")`created`','sorted','ctl'))->order_by($option['order']." ".$option['dir'])->get_where('profile',array('position'=>'event','ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('profile',array('position'=>'event','ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $event) {
					$data=array(
						"text-name"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$event->id."'><label></label></div><a href='javascript:;' class='event-event' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this event'>".strtoupper($event->name)."</strong>",	
						"text-description"=>"<strong>".$event->description."</strong>",
						"id"=>$event->id,			
						"name"=>$event->name,			
						"description"=>$event->description,
						"sorted"=>$event->sorted,
						"created"=>$event->created,
						"ctl"=>$event->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-name"=>"",	
					"text-description"=>"",
					"id"=>"",			
					"name"=>"",			
					"description"=>"",
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
	public function editEvent()
	{
		$this->form_validation->set_rules('id','Executive', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('description', 'Description','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']); 
        	$_POST['created'].=' 00:00:00';    	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('profile');
			$this->session->set_flashdata('error', "You have been updated event successfully!");
			redirect(_URL.'dashboard/event');	
		}		
		$this->index();
	}
	public function newEvent()
	{
		$this->form_validation->set_rules('name', 'Name','trim');
		$this->form_validation->set_rules('description', 'Description','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('created', 'Event date','trim');
		$this->form_validation->set_rules('sorted', 'Sort number','trim');
		if ($this->form_validation->run())
        {		 	      	
            if($_POST['created'])$_POST['created'].=" 00:00:00";else$_POST['created']=_DATE;
    		$_POST['position']='event';
    		if(empty($_POST['sorted'])){
    			$sorted=$this->db->select('sorted')->order_by('sorted DESC')->get_where('profile',array('position'=>'event','ctl<>'=>2))->row_object();
    			$_POST['sorted']=$sorted->sorted+1;
    		}
			$this->db->insert('profile',$_POST);
			$this->session->set_flashdata('error', "You have been added event successfully!");
			redirect(_URL.'dashboard/event');	
		}		
		$this->index();
	}
	public function lockEvent()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('profile'));	
		}			  
	}
	public function unlockEvent()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('profile'));	
		}
	}
	public function delEvent()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('profile'));	
		}
	}
}
