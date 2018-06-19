<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchants extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['executive_id'] = array('id'=>'new-executive');
		$data['executive_action'] = _URL.'dashboard/newMember';
		$data['categories']=$this->db->select(array('id','name'))->get_where('category',array('position'=>'directory','ctl <>'=>2))->result_object();
		$data['locations']=$this->db->select(array('id','name'))->get_where('location',array('position'=>'directory','ctl <>'=>2))->result_object();
		$this->_render('dashboard/merchants',$data);
	}
	public function merchantsList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="ctl ASC,company";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='company';elseif($_POST['order'][0]['column']==1)$option['order']='created';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(company LIKE \'%'.$_POST['search']['value'].'%\' OR address LIKE \'%'.$_POST['search']['value'].'%\' OR email LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results = $this->db->select("*,DATE_FORMAT(created,'%b, %d %Y')`created`,DATE_FORMAT(modified,'%b, %d %Y')`modified`")->where($option['search'])->order_by($option['order']." ".$option['dir'])->get_where('directory',array('ctl<>'=>2))->result_object();
			}else{
				$this->db->cache_off();
				$results = $this->db->select("*,DATE_FORMAT(created,'%b, %d %Y')`created`,DATE_FORMAT(modified,'%b, %d %Y')`modified`")->order_by($option['order']." ".$option['dir'])->get_where('directory',array('ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('directory',array('ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $dir) {
					$data=array(
						"text-company"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$dir->id."'><label></label></div><div class='img-avatar pull-right' style='background:url(".$this->load->module('image')->img($dir->image)->folder('directory')->getThumb().");'></div><a href='javascript:;' class='edit-merchants' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this merchants'>".$dir->company.'</strong></a><br><small>'.$dir->address.'</small>',
						"text-desc"=>'<strong>'.$dir->working_hour.'</strong><br><small>'.$this->load->module('text')->cut($dir->description,80).'</small>',
						"text-email"=>'<strong>'.$dir->website.'</strong><br><small>'.$dir->email.'</small>',
						"text-telno"=>'<strong>'.$dir->telno.'</strong><br><small>'.$dir->fax.'</small>',
						"text-sorted"=>'<b class="dropdown pull-right" data-toggle="dropdown" style="cursor:pointer;"><i class="la la-ellipsis-v la-2x"></i><ul class="dropdown-menu dropdown-menu-right option-menu" data-id="'.$dir->id.'"><li><a href="#category-modal" data-toggle="modal">Category</a></li><li><a href="#location-modal" data-toggle="modal">Location</a></li><li><a href="#">Newbikes</a></li><li><a href="#">Userbikes</a></li><li><a href="#">Accessory</a></li></ul></b><strong>'.$dir->modified.'</strong><br><small>'.$dir->created.'</small>',
						"id"=>$dir->id,			
						"company"=>$dir->company,				
						"designation"=>$dir->designation,		
						"image"=>$this->load->module('image')->img($dir->image)->folder('directory')->getThumb(),	
						"description"=>$dir->description,
						"introduction"=>$dir->introduction,	
						"working_hour"=>$dir->working_hour,			
						"address"=>$dir->address,			
						"email"=>$dir->email,				
						"website"=>$dir->website,			
						"telno"=>$dir->telno,			
						"fax"=>$dir->fax,			
						"featured"=>$dir->featured,			
						"dealer"=>$dir->dealer,		
						"zipcode"=>$dir->zipcode,
						"ctl"=>$dir->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-company"=>"",
					"text-desc"=>"",
					"text-email"=>"",
					"text-telno"=>"",
					"text-sorted"=>"",
					"id"=>"",			
					"company"=>"",				
					"designation"=>"",		
					"image"=>"",	
					"description"=>"",
					"introduction"=>"",
					"working_hour"=>"",			
					"address"=>"",			
					"email"=>"",			
					"website"=>"",			
					"telno"=>"",			
					"fax"=>"",			
					"featured"=>"",			
					"dealer"=>"",			
					"zipcode"=>"",
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
	public function getCategory()
	{
		$this->db->where(array('ctl'=>2))->delete('position');	
		$data=null;
		if(ctype_digit($_POST['id'])&&$_POST['position']){
			$data=$this->db->select(array('position.id `cate-id`','category.name `category-name`'),false)->join('category','category.id = position.main_id','left')->order_by('position.created ASC')->get_where('position',array('position.position'=>$_POST['position'],'position.sub_id'=>$_POST['id'],'position.ctl'=>0))->result_object();			
		}
		echo json_encode($data);
	}
	public function getLocation()
	{
		$this->db->where(array('ctl'=>2))->delete('position');	
		$data=null;
		if(ctype_digit($_POST['id'])&&$_POST['position']){
			$data=$this->db->select(array('position.id `location-id`','location.name `location-name`'),false)->join('location','location.id = position.main_id','left')->order_by('position.created ASC')->get_where('position',array('position.position'=>$_POST['position'],'position.sub_id'=>$_POST['id'],'position.ctl'=>0))->result_object();			
		}
		echo json_encode($data);
	}
	public function delCategory()
	{
		if(ctype_digit($_POST['id'])){			
			echo json_encode($this->db->set(array('ctl'=>2))
            ->where(array('id'=>$_POST['id'],'position'=>'category'))
			->update('position'));
		}
	}
	public function addCategory()
	{
		if(ctype_digit($_POST['main_id'])&&ctype_digit($_POST['sub_id'])){
			$_POST['created']=_DATE;
    		$_POST['position']='category';
			echo json_encode(true!==$this->db->insert('position',$_POST)?false:true);			
		}
	}
	public function delLocation()
	{
		if(ctype_digit($_POST['id'])){		
			echo json_encode($this->db->set(array('ctl'=>2))
            ->where(array('id'=>$_POST['id'],'position'=>'location'))
			->update('position'));
		}
	}
	public function addLocation()
	{
		if(ctype_digit($_POST['main_id'])&&ctype_digit($_POST['sub_id'])){
			$_POST['created']=_DATE;
    		$_POST['position']='location';
			echo json_encode(true!==$this->db->insert('position',$_POST)?false:true);			
		}
	}
	public function editDirectory()
	{
		$this->form_validation->set_rules('id','Directory', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('company', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
        {		
        	$id=$_POST['id'];unset($_POST['id']); 
        	if(empty($_FILES['image']['error'])){
				$img=$this->load->module('image')
				->file($_FILES['image'])
				->folder('directory')
				->type('gif|jpg|png')
				->crRec()
				->crThumb()
				->upImage();
				if(isset($img->error)){
					$this->session->set_flashdata('error',$img->error);
					redirect(_URL.'dashboard/merchants');
				}elseif(isset($img->name))$_POST['image']=$img->name;
			} 	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('directory');
			$this->session->set_flashdata('error', "You have been updated directory successfully!");
			redirect(_URL.'dashboard/merchants');	
		}		
		$this->index();
	}
	public function newDirectory()
	{
		$this->form_validation->set_rules('company', 'Name','trim|required',array('required' => 'You have not provided %s.'));
		if ($this->form_validation->run())
        {		
        	unset($_POST['id']); 
        	$_POST['created']=_DATE;
        	if(empty($_FILES['image']['error'])){
				$img=$this->load->module('image')
				->file($_FILES['image'])
				->folder('directory')
				->type('gif|jpg|png')
				->crRec()
				->crThumb()
				->upImage();
				if(isset($img->error)){
					$this->session->set_flashdata('error',$img->error);
					redirect(_URL.'dashboard/merchants');
				}elseif(isset($img->name))$_POST['image']=$img->name;
			} 
			$this->db->insert('directory',$_POST); 
			$this->session->set_flashdata('error', "You have been added new directory successfully!");
			redirect(_URL.'dashboard/merchants');	
		}		
		$this->index();
	}
	// public function newMember()
	// {
	// 	$this->form_validation->set_rules('company', 'Name','trim|required',array('required' => 'You have not provided %s.'));
	// 	$this->form_validation->set_rules('name', 'Address','trim|required',array('required' => 'You have not provided %s.'));
	// 	$this->form_validation->set_rules('appointment', 'Email','trim',array('required' => 'You have not provided %s.'));
	// 	$this->form_validation->set_rules('telno', 'telno','trim',array('required' => 'You have not provided %s.'));
	// 	$this->form_validation->set_rules('sorted', 'Sort number','trim');
	// 	if ($this->form_validation->run())
 //        {		 	      	
 //            $_POST['created']=_DATE;
 //    		$_POST['position']='member';
	// 		$this->db->insert('profile',$_POST);
	// 		$this->session->set_flashdata('error', "You have been added member successfully!");
	// 		redirect(_URL.'dashboard/member');	
	// 	}		
	// 	$this->index();
	// }
	public function lockDirectory()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('directory'));	
		}			  
	}
	public function unlockDirectory()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('directory'));	
		}
	}
	public function drFeature()
	{
		if ($_POST['items'])
        {
        	$got=$this->db->select('featured')->order_by('featured DESC')->get_where('directory',array('ctl<>'=>2))->row_object();		
            echo json_encode($this->db->set(array('featured'=>$got->featured+1))
            ->where_in('id',$_POST['items'])
			->update('directory'));	
		}
	}
	public function drDealer()
	{
		if ($_POST['items'])
        {		
            $got=$this->db->select('dealer')->order_by('dealer DESC')->get_where('directory',array('ctl<>'=>2))->row_object();		
            echo json_encode($this->db->set(array('dealer'=>$got->dealer+1))
            ->where_in('id',$_POST['items'])
			->update('directory'));	
		}
	}
	public function delDirectory()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('directory'));	
		}
	}
	public function drImgCode()
	{
		if($_POST['img']){
			$upload=$this->load->module('image')
				->img($_POST['name'])
				->folder($_POST['folder'])
				->type($_POST['ext'])
				->crThumb()
				->upCode($_POST);
			if($upload->name){
				echo json_encode(end($upload->path));
			}else echo json_encode(_IMG.'no_photo.svg');
		}
	}
}
