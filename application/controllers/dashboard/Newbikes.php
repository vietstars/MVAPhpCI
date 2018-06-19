<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newbikes extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['bike_id'] = array('id'=>'new-bike');
		$data['bike_action'] = _URL.'dashboard/newBike';
		$data['type']=$this->db->select(array('id','name'))->order_by('name ASC')->get_where('type',array('ctl'=>0))->result_object();
		$data['make']=$this->db->select(array('id','name'))->order_by('name ASC')->get_where('make',array('ctl'=>0))->result_object();
		$data['class']=$this->db->select(array('id','name'))->order_by('name ASC')->get_where('class',array('ctl'=>0))->result_object();
		$data['builtin']=$this->db->select(array('id','name'))->order_by('name ASC')->get_where('builtin',array('ctl'=>0))->result_object();
		$this->_render('dashboard/newbikes',$data);
	}
	public function newbikeList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="bike.ctl ASC,bike.name";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='bike.fullname';elseif($_POST['order'][0]['column']==1)$option['order']='bike.type_id';elseif($_POST['order'][0]['column']==2)$option['order']='bike.video_url';elseif($_POST['order'][0]['column']==4)$option['order']='bike.modified';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(bike.fullname LIKE \'%'.$_POST['search']['value'].'%\' OR bike.name LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results=$this->db->select(array('bike.id','bike.name','bike.fullname','bike.image','make.name `makeName`','type.name `typeName`','class.name `className`','builtin.name `builtinName`','bike.description','bike.make_id','bike.type_id','bike.class_id','bike.builtin','bike.release_year','bike.pdf_url','bike.video_url','bike.min_price','bike.max_price','bike.ctl','DATE_FORMAT(smcta_bike.created,"%b, %d %Y") `created`','DATE_FORMAT(smcta_bike.modified,"%b, %d %Y") `modified`'))
				->join('make','make.id = bike.make_id AND make.ctl=0','left')
				->join('type','type.id = bike.type_id AND type.ctl=0','left')
				->join('class','class.id = bike.class_id AND class.ctl=0','left')
				->join('builtin','builtin.id = bike.builtin AND builtin.ctl=0','left')
				->where($option['search'])
				->order_by($option['order']." ".$option['dir'])
				->get_where('bike',array('bike.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}else{
				$this->db->cache_off();
				$results=$this->db->select(array('bike.id','bike.name','bike.fullname','bike.image','make.name `makeName`','type.name `typeName`','class.name `className`','builtin.name `builtinName`','bike.description','bike.make_id','bike.type_id','bike.class_id','bike.builtin','bike.release_year','bike.pdf_url','bike.video_url','bike.min_price','bike.max_price','bike.ctl','DATE_FORMAT(smcta_bike.created,"%b, %d %Y") `created`','DATE_FORMAT(smcta_bike.modified,"%b, %d %Y") `modified`'))
				->join('make','make.id = bike.make_id AND make.ctl=0','left')
				->join('type','type.id = bike.type_id AND type.ctl=0','left')
				->join('class','class.id = bike.class_id AND class.ctl=0','left')
				->join('builtin','builtin.id = bike.builtin AND builtin.ctl=0','left')
				->order_by($option['order']." ".$option['dir'])
				->get_where('bike',array('bike.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('bike',array('bike.ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $bike) {
					$name=$bike->fullname?strtoupper($bike->fullname):strtoupper($bike->name);
					$data=array(
						"text-bike"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$bike->id."'><label></label></div><div class='img-avatar pull-right' data-toggle='modal' data-id='".$bike->id."' data-target='#image-modal' data-tool='tooltip' data-placement='right' data-original-title='Click to view images' style='background:url(".$this->load->module('image')->img($bike->image)->folder('bike')->getThumb().");'></div><a href='javascript:;' class='event-event' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this event'>".$name."</strong></a><br><small>".$bike->name." - ".$bike->makeName."</small>",	
						"text-type"=>"<strong>".$bike->typeName." - ".$bike->className."</strong><br>".$bike->builtinName.' - '.$bike->release_year,
						"text-path"=>$bike->video_url,
						"id"=>$bike->id,			
						"model"=>$bike->name,		
						"make"=>$bike->make_id,	
						"image"=>$this->load->module('image')->img($bike->image)->folder('bike')->getThumb(),
						"description"=>$bike->description,
						"price"=>$bike->min_price.'<br><small>'.$bike->max_price.'</small>',
						"type_id"=>$bike->type_id,
						"class_id"=>$bike->class_id,
						"builtin"=>$bike->builtin,
						"year"=>$bike->release_year,
						"min"=>$bike->min_price,
						"max"=>$bike->max_price,
						"pdf"=>$bike->pdf_url,
						"video"=>$bike->video_url,
						"specification"=>$this->getSpecification($bike->id),
						"created"=>$bike->modified.'<br><small>'.$bike->created.'</small>',
						"ctl"=>$bike->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-bike"=>"",	
					"text-type"=>"",
					"text-path"=>"",
					"id"=>"",			
					"model"=>"",		
					"make"=>"",	
					"image"=>"",	
					"description"=>"",	
					"price"=>"",
					"type_id"=>"",
					"class_id"=>"",
					"builtin"=>"",
					"year"=>"",
					"min"=>"",
					"max"=>"",
					"pdf"=>"",
					"video"=>"",
					"specification"=>"",
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
	public function getOptions()
	{
		$data['type']=$this->db->select(array('id `key`','name `value`'),false)->order_by('name ASC')->get_where('type',array('ctl'=>0))->result_object();
		$data['make']=$this->db->select(array('id `key`','name `value`'),false)->order_by('name ASC')->get_where('make',array('ctl'=>0))->result_object();
		$data['class']=$this->db->select(array('id `key`','name `value`'),false)->order_by('name ASC')->get_where('class',array('ctl'=>0))->result_object();
		$data['builtin']=$this->db->select(array('id `key`','name `value`'),false)->order_by('name ASC')->get_where('builtin',array('ctl'=>0))->result_object();	
		echo json_encode($data);
	}
	public function getImages()
	{
		if(ctype_digit($_POST['id'])){
			$img=$this->db->select(array('image'))->get_where('bike',array('ctl'=>0,'id'=>$_POST['id']))->row_object();			
			$data=$this->db->select(array('id `image-id`','image `image_url`'))->order_by('created ASC')->get_where('image',array('ctl'=>0,'item'=>$_POST['id'],'position'=>$_POST['position']))->result_object();
			foreach ($data as $k => $v) {
				if($img->image==$v->image_url){
					$data[$k]->checked='default';
				}else{
					$data[$k]->checked='';
				}
				$data[$k]->image_url='background:url('.$this->load->module('image')->img($v->image_url)->folder('bike')->getThumb().')';
			}		
			echo json_encode($data);	
		}
	}
	public function getSpecification($id=false)
	{
		if(ctype_digit($id)){			
			$data=$this->db->select(array('id','sp_key','sp_val','sorted'))->order_by('sorted ASC,sp_key ASC')->get_where('specification',array('ctl'=>0,'item'=>$id))->result_object();	
			return $data;	
		}
	}
	public function removeNBimage()
	{
		if(ctype_digit($_POST['id'])){
			echo json_encode($this->db->set('ctl',2)
			->where(array('id'=>$_POST['id'],'position'=>'newbike'))
			->update('image'));
		}
	}
	public function editNBspec()
	{
		if(ctype_digit($_POST['id'])&&$_POST['sp_val']){
			echo json_encode($this->db->set('sp_val',$_POST['sp_val'])
			->where(array('id'=>$_POST['id']))
			->update('specification'));
		}
	}
	public function addNBspec()
	{
		if(ctype_digit($_POST['item'])&&$_POST['sp_key']&&$_POST['sp_val']){
			$_POST['created']=_DATE;
			$this->db->insert('specification',$_POST);		
			echo json_encode($this->db->insert_id());
		}
	}
	public function sortNBspec()
	{
		if(ctype_digit($_POST['id'])&&$_POST['items']){
			foreach ($_POST['items'] as $k => $v) {
				$this->db->set('sorted',$k+1)
				->where(array('ctl'=>0,'item'=>$_POST['id'],'id'=>$v))
				->update('specification');
			}
			echo json_encode(true);
		}
	}
	public function removeNBspec()
	{
		if(ctype_digit($_POST['id'])){
			echo json_encode($this->db->set('ctl',2)
			->where(array('id'=>$_POST['id']))
			->update('specification'));
		}
	}
	public function defaultNBimage()
	{
		if(ctype_digit($_POST['id'])){
			$img=$this->db->select(array('image','item'))->get_where('image',array('ctl'=>0,'id'=>$_POST['id']))->row_object();
			echo json_encode($this->db->set('image',$img->image)
			->where(array('id'=>$img->item))
			->update('bike'));
		}
	}
	public function editNewbike()
	{
		$this->form_validation->set_rules('id','Newbike', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Model','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('release_year', 'Release year','trim');
		$this->form_validation->set_rules('description', 'Description','trim');
		$this->form_validation->set_rules('make_id', 'Make','trim');
		$this->form_validation->set_rules('type_id', 'Type','trim');
		$this->form_validation->set_rules('class_id', 'Class','trim');
		$this->form_validation->set_rules('builtin', 'Builtin','trim');
		$this->form_validation->set_rules('video_url', 'Video','trim');
		$this->form_validation->set_rules('class_id', 'Class','trim');
		if ($this->form_validation->run())
        {	
        	$id=$_POST['id'];unset($_POST['id']);
        	foreach ($_POST as $key => $value) {
        		if($value=='null'){
        			unset($_POST[$key]);
        		}
        	}
        	foreach ($_FILES['image'] as $k => $imgs) {
        		foreach ($imgs as $key => $img) {
        			$file[$key][$k]=$img;
        		}
        	}
        	if(isset($_POST['del'])&&$_POST['del']=='on'){
        		$this->db->set('ctl',2)
				->where(array('item'=>$id,'position'=>'newbike'))
				->update('image');
				unset($_POST['del']);
        	}	
        	foreach ($file as $k => $img) {
	        	if(empty($img['error'])){
					$img=$this->load->module('image')
					->file($img)
					->folder('bike')
					->type('gif|jpg|png')
					->crRec()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/newbike');
					}elseif(isset($img->name)){
						if(empty($k))$_POST['image']=$img->name;
						$_img=array(
							'image'=>$img->name,
							'item'=>$id,
							'position'=>'newbike',
							'created'=>_DATE
						);
						$this->db->insert('image',$_img);
					}
				}
        	}  	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('bike');
			$this->session->set_flashdata('error', "You have been updated newbike successfully!");
			redirect(_URL.'dashboard/newbikes');	
		}		
		$this->index();
	}
	public function newBike()
	{
		$this->form_validation->set_rules('name', 'Model','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('release_year', 'Release year','trim');
		$this->form_validation->set_rules('description', 'Description','trim');
		$this->form_validation->set_rules('make_id', 'Make','trim');
		$this->form_validation->set_rules('type_id', 'Type','trim');
		$this->form_validation->set_rules('class_id', 'Class','trim');
		$this->form_validation->set_rules('builtin', 'Builtin','trim');
		$this->form_validation->set_rules('video_url', 'Video','trim');
		$this->form_validation->set_rules('class_id', 'Class','trim');
		if ($this->form_validation->run())
        {		 
        	foreach ($_POST as $key => $value) {
        		if($value=='null'){
        			unset($_POST[$key]);
        		}
        	}
        	foreach ($_FILES['image'] as $k => $imgs) {
        		foreach ($imgs as $key => $img) {
        			$file[$key][$k]=$img;
        		}
        	}
            $_POST['created']=_DATE;
			$this->db->insert('bike',$_POST);
			$id=$this->db->insert_id();
        	foreach ($file as $k => $img) {
	        	if(empty($img['error'])){
					$img=$this->load->module('image')
					->file($img)
					->folder('bike')
					->type('gif|jpg|png')
					->crRec()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/newbike');
					}elseif(isset($img->name)){
						if(empty($k))$_POST['image']=$img->name;
						$_img=array(
							'image'=>$img->name,
							'item'=>$id,
							'position'=>'newbike',
							'created'=>_DATE
						);
						$this->db->insert('image',$_img);
					}
				}
        	}	  
        	$this->db->set(array('image'=>$_POST['image']))
            ->where(array('id'=>$id))
			->update('bike');    	
			$this->session->set_flashdata('error', "You have been added new bike successfully!");
			redirect(_URL.'dashboard/newBikes');	
		}		
		$this->index();
	}
	public function lockNewbike()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('bike'));	
		}			  
	}
	public function unlockNewbike()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('bike'));	
		}
	}
	public function delNewbike()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('bike'));	
		}
	}
}
