<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usedbikes extends CI_Controller {
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
		$this->_render('dashboard/usedbikes',$data);
	}
	public function usedbikeList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="usedbike.ctl ASC,usedbike.name";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='usedbike.fullname';elseif($_POST['order'][0]['column']==1)$option['order']='usedbike.type_id';elseif($_POST['order'][0]['column']==2)$option['order']='usedbike.video_url';elseif($_POST['order'][0]['column']==4)$option['order']='usedbike.modified';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(usedbike.fullname LIKE \'%'.$_POST['search']['value'].'%\' OR usedbike.name LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results=$this->db->select(array('usedbike.id','usedbike.name','usedbike.fullname','usedbike.user_id `userId`','user.fullname `userName`','usedbike.dealer_id `dealerId`','directory.company `dealerName`','usedbike.image','make.name `makeName`','type.name `typeName`','class.name `className`','usedbike.description','usedbike.make_id','usedbike.mileage','usedbike.capacity','usedbike.type_id','usedbike.class_id','usedbike.video_url','usedbike.price','usedbike.price','usedbike.ctl','DATE_FORMAT({pre}usedbike.coe_expiry,"%b, %d %Y") `coe_expiry`','DATE({pre}usedbike.coe_expiry)`coe_date`','DATE_FORMAT({pre}usedbike.reg_date,"%b, %d %Y") `reg_date`','DATE({pre}usedbike.reg_date)`reg_day`','IF({pre}usedbike.paid_expiry IS NOT NULL OR {pre}usedbike.paid_expiry="",DATE({pre}usedbike.paid_expiry),null)`paid_ad`','DATE_FORMAT({pre}usedbike.created,"%b, %d %Y") `created`','DATE_FORMAT({pre}usedbike.modified,"%b, %d %Y") `modified`'))
				->join('make','make.id = usedbike.make_id AND make.ctl=0','left')
				->join('type','type.id = usedbike.type_id AND type.ctl=0','left')
				->join('class','class.id = usedbike.class_id AND class.ctl=0','left')
				->join('directory','directory.id = usedbike.dealer_id AND directory.ctl=0','left')
				->join('user','user.id = usedbike.user_id AND user.ctl=0','left')
				->where($option['search'])
				->order_by($option['order']." ".$option['dir'])
				->get_where('usedbike',array('usedbike.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}else{
				$this->db->cache_off();
				$results=$this->db->select(array('usedbike.id','usedbike.name','usedbike.fullname','usedbike.user_id `userId`','user.fullname `userName`','usedbike.dealer_id `dealerId`','directory.company `dealerName`','usedbike.image','make.name `makeName`','type.name `typeName`','class.name `className`','usedbike.description','usedbike.make_id','usedbike.mileage','usedbike.capacity','usedbike.type_id','usedbike.class_id','usedbike.video_url','usedbike.price','usedbike.ctl','DATE_FORMAT({pre}usedbike.coe_expiry,"%b, %d %Y")`coe_expiry`','DATE({pre}usedbike.coe_expiry)`coe_date`','DATE_FORMAT({pre}usedbike.reg_date,"%b, %d %Y") `reg_date`','DATE({pre}usedbike.reg_date)`reg_day`','IF({pre}usedbike.paid_expiry IS NOT NULL OR {pre}usedbike.paid_expiry="",DATE({pre}usedbike.paid_expiry),null)`paid_ad`','DATE_FORMAT({pre}usedbike.created,"%b, %d %Y") `created`','DATE_FORMAT({pre}usedbike.modified,"%b, %d %Y") `modified`'))
				->join('make','make.id = usedbike.make_id AND make.ctl=0','left')
				->join('type','type.id = usedbike.type_id AND type.ctl=0','left')
				->join('class','class.id = usedbike.class_id AND class.ctl=0','left')
				->join('directory','directory.id = usedbike.dealer_id AND directory.ctl=0','left')
				->join('user','user.id = usedbike.user_id AND user.ctl=0','left')
				->order_by($option['order']." ".$option['dir'])
				->get_where('usedbike',array('usedbike.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('usedbike',array('ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $bike) {
					$contact=$this->getContact($bike->id);
					$name=$bike->fullname?strtoupper($bike->fullname):strtoupper($bike->name);
					$data=array(
						"text-bike"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$bike->id."'><label></label></div><div class='img-avatar pull-right' data-toggle='modal' data-id='".$bike->id."' data-target='#image-modal' data-tool='tooltip' data-placement='right' data-original-title='Click to view images' style='background:url(".$this->load->module('image')->img($bike->image)->folder('ubike')->getThumb().");'></div><a href='javascript:;' class='event-event' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this event'>".$name."</strong></a><br><small>".$bike->name." - ".$bike->makeName."</small>",
						"text-dealer"=>ucfirst($bike->userName)." <span class='text-danger'>S$ ".number_format($bike->price)."</span><br><small class='text-success'>".$bike->dealerName."</small>",	
						"text-type"=>"<strong>".$bike->typeName." - ".$bike->className."</strong><br>".$bike->mileage.'km - '.$bike->capacity.'cc',
						"text-path"=>$bike->video_url,
						"text-date"=>$bike->coe_expiry.'<br><small>'.$bike->reg_date.'</small>',
						"id"=>$bike->id,
						"bikeName"=>$bike->fullname,			
						"model"=>$bike->name,		
						"make"=>$bike->make_id,	
						"image"=>$this->load->module('image')->img($bike->image)->folder('ubike')->getThumb(),
						"description"=>$bike->description,
						"price"=>$bike->price,
						"userId"=>$bike->userId,
						"dealerId"=>$bike->dealerId,
						"type_id"=>$bike->type_id,
						"class_id"=>$bike->class_id,
						"video"=>$bike->video_url,
						"coe_date"=>$bike->coe_date,
						"reg_date"=>$bike->reg_day,
						"paid_ad"=>$bike->paid_ad,
						"contact"=>$contact,
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
					"text-date"=>"",
					"id"=>"",
					"bikeName"=>"",			
					"model"=>"",		
					"make"=>"",	
					"image"=>"",	
					"description"=>"",
					"price"=>"",
					"userId"=>"",
					"dealerId"=>"",
					"type_id"=>"",
					"class_id"=>"",
					"video"=>"",
					"coe_date"=>"",
					"reg_date"=>"",
					"paid_ad"=>"",
					"contact"=>"",
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
		$data['user']=$this->db->select(array('id `key`','fullname `value`'),false)->order_by('fullname ASC')->get_where('user',array('ctl'=>0))->result_object();
		$data['dealer']=$this->db->select(array('id `key`','company `value`'),false)->order_by('company ASC')->get_where('directory',array('ctl'=>0))->result_object();	
		echo json_encode($data);
	}
	public function getImages()
	{
		if(ctype_digit($_POST['id'])){
			$img=$this->db->select(array('image'))->get_where('usedbike',array('ctl'=>0,'id'=>$_POST['id']))->row_object();			
			$data=$this->db->select(array('id `image-id`','image `image_url`'))->order_by('created ASC')->get_where('image',array('ctl'=>0,'item'=>$_POST['id'],'position'=>$_POST['position']))->result_object();
			foreach ($data as $k => $v) {
				if($img->image==$v->image_url){
					$data[$k]->checked='default';
				}else{
					$data[$k]->checked='';
				}
				$data[$k]->image_url='background:url('.$this->load->module('image')->img($v->image_url)->folder('ubike')->getThumb().')';
			}		
			echo json_encode($data);	
		}
	}
	public function getContact($id=false)
	{
		if(ctype_digit($id)){			
			$data=$this->db->select(array('id','name','address','email','phone'))->order_by('sorted ASC,name ASC')->get_where('seller',array('ctl'=>0,'bike_id'=>$id,'position'=>'usedbike'))->result_object();
			return $data;	
		}
	}
	public function removeUBimage()
	{
		if(ctype_digit($_POST['id'])){
			echo json_encode($this->db->set('ctl',2)
			->where(array('id'=>$_POST['id'],'position'=>'usedbike'))
			->update('image'));
		}
	}
	public function addUBspec()
	{
		if(ctype_digit($_POST['bike_id'])){
			$_POST['created']=_DATE;
			$_POST['position']='usedbike';
			$this->db->insert('seller',$_POST);		
			echo json_encode($this->db->insert_id());
		}
	}
	public function sortUBspec()
	{
		if(ctype_digit($_POST['id'])&&$_POST['items']){
			foreach ($_POST['items'] as $k => $v) {
				$this->db->set('sorted',$k+1)
				->where(array('ctl'=>0,'bike_id'=>$_POST['id'],'position'=>'usedbike','id'=>$v))
				->update('seller');
			}
			echo json_encode(true);
		}
	}
	public function removeUBspec()
	{
		if(ctype_digit($_POST['id'])){
			echo json_encode($this->db->set('ctl',2)
			->where(array('id'=>$_POST['id']))
			->update('seller'));
		}
	}
	public function defaultUBimage()
	{
		if(ctype_digit($_POST['id'])){
			$img=$this->db->select(array('image','item'))->get_where('image',array('ctl'=>0,'id'=>$_POST['id']))->row_object();
			echo json_encode($this->db->set('image',$img->image)
			->where(array('id'=>$img->item))
			->update('usedbike'));
		}
	}
	public function addUsedbike()
	{
		$this->form_validation->set_rules('name', 'Model','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('price', 'Price','trim');
		$this->form_validation->set_rules('description', 'Description','trim');
		$this->form_validation->set_rules('make_id', 'Make','trim');
		$this->form_validation->set_rules('type_id', 'Type','trim');
		$this->form_validation->set_rules('class_id', 'Class','trim');
		$this->form_validation->set_rules('user', 'User','trim');
		$this->form_validation->set_rules('dealer', 'Dealer','trim');
		$this->form_validation->set_rules('video_url', 'Video','trim');
		$this->form_validation->set_rules('class_id', 'Class','trim');
		if ($this->form_validation->run())
        {	
        	unset($_POST['id'],$_POST['del']);
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
            $this->db->insert('usedbike',$_POST);
            $id=$this->db->insert_id();
        	foreach ($file as $k => $img) {
	        	if(empty($img['error'])){
					$img=$this->load->module('image')
					->file($img)
					->folder('ubike')
					->type('gif|jpg|png')
					->crRec()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/usedbikes');
					}elseif(isset($img->name)){
						if(empty($k))$_POST['image']=$img->name;
						$_img=array(
							'image'=>$img->name,
							'item'=>$id,
							'position'=>'usedbike',
							'created'=>_DATE
						);
						$this->db->insert('image',$_img);
					}
				}
        	} 
        	$this->db->set(array('image'=>$_POST['image']))
            ->where(array('id'=>$id))
			->update('usedbike'); 	
			$this->session->set_flashdata('error', "You have been added usedbike successfully!");
			redirect(_URL.'dashboard/usedbikes');	
		}		
		$this->index();
	}
	public function editUsedbike()
	{
		$this->form_validation->set_rules('id','Usedbike', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Model','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('price', 'Price','trim');
		$this->form_validation->set_rules('description', 'Description','trim');
		$this->form_validation->set_rules('make_id', 'Make','trim');
		$this->form_validation->set_rules('type_id', 'Type','trim');
		$this->form_validation->set_rules('class_id', 'Class','trim');
		$this->form_validation->set_rules('user', 'User','trim');
		$this->form_validation->set_rules('dealer', 'Dealer','trim');
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
				->where(array('item'=>$id,'position'=>'usedbike'))
				->update('image');
				unset($_POST['del']);
        	}	
        	foreach ($file as $k => $img) {
	        	if(empty($img['error'])){
					$img=$this->load->module('image')
					->file($img)
					->folder('ubike')
					->type('gif|jpg|png')
					->crRec()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/usedbike');
					}elseif(isset($img->name)){
						if(empty($k))$_POST['image']=$img->name;
						$_img=array(
							'image'=>$img->name,
							'item'=>$id,
							'position'=>'usedbike',
							'created'=>_DATE
						);
						$this->db->insert('image',$_img);
					}
				}
        	}  	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('usedbike');
			$this->session->set_flashdata('error', "You have been updated usedbike successfully!");
			redirect(_URL.'dashboard/usedbikes');	
		}		
		$this->index();
	}	
	public function lockUsedbike()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>3))
            ->where_in('id',$_POST['items'])
			->update('usedbike'));	
		}			  
	}
	public function soldUsedbike()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('usedbike'));	
		}			  
	}
	public function unlockUsedbike()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('usedbike'));	
		}
	}
	public function delUsedbike()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('usedbike'));	
		}
	}
}
