<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class accessories extends CI_Controller {
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
		$this->_render('dashboard/accessories',$data);
	}
	public function accessoryList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="accessory.ctl ASC,accessory.name";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='accessory.name';elseif($_POST['order'][0]['column']==1)$option['order']='accessory.price';elseif($_POST['order'][0]['column']==2)$option['order']='accessory.quality';elseif($_POST['order'][0]['column']==4)$option['order']='accessory.modified';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(accessory.name LIKE \'%'.$_POST['search']['value'].'%\' OR accessory.description LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results=$this->db->select(array('accessory.id','accessory.name','accessory.image','user.fullname `userName`','accessory.description','accessory.quality','make.name `makeName`','accessory.category','category.name `categoryName`','accessory.make `makeId`','accessory.user_id `userId`','accessory.dealer_id `dealerId`','directory.company `dealerName`','accessory.price','IF({pre}accessory.paid_expiry IS NOT NULL OR {pre}accessory.paid_expiry="",DATE({pre}accessory.paid_expiry),"Free Ad")`paid_ad`','accessory.ctl','DATE_FORMAT({pre}accessory.created,"%b, %d %Y") `created`','DATE_FORMAT({pre}accessory.modified,"%b, %d %Y") `modified`'))
				->join('make','make.id = accessory.make AND make.ctl=0','left')
				->join('category','category.id = accessory.category AND category.ctl=0','left')
				->join('directory','directory.id = accessory.dealer_id AND directory.ctl=0','left')
				->join('user','user.id = accessory.user_id AND user.ctl=0','left')
				->where($option['search'])
				->order_by($option['order']." ".$option['dir'])
				->get_where('accessory',array('accessory.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}else{
				$this->db->cache_off();
				$results=$this->db->select(array('accessory.id','accessory.name','accessory.image','user.fullname `userName`','accessory.description','accessory.quality','make.name `makeName`','accessory.category','category.name `categoryName`','accessory.make `makeId`','accessory.user_id `userId`','accessory.dealer_id `dealerId`','directory.company `dealerName`','accessory.price','IF({pre}accessory.paid_expiry IS NOT NULL OR {pre}accessory.paid_expiry="",DATE({pre}accessory.paid_expiry),null)`paid_ad`','accessory.ctl','DATE_FORMAT({pre}accessory.created,"%b, %d %Y") `created`','DATE_FORMAT({pre}accessory.modified,"%b, %d %Y") `modified`'))
				->join('make','make.id = accessory.make AND make.ctl=0','left')
				->join('category','category.id = accessory.category AND category.ctl=0','left')
				->join('directory','directory.id = accessory.dealer_id AND directory.ctl=0','left')
				->join('user','user.id = accessory.user_id AND user.ctl=0','left')
				->order_by($option['order']." ".$option['dir'])
				->get_where('accessory',array('accessory.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('accessory',array('ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $item) {
					$contact=$this->getContact($item->id);
					$suitable=$item->makeName?$item->makeName:'All models';
					$data=array(
						"text-bike"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$item->id."'><label></label></div><div class='img-avatar pull-right' data-toggle='modal' data-id='".$item->id."' data-target='#image-modal' data-tool='tooltip' data-placement='right' data-original-title='Click to view images' style='background:url(".$this->load->module('image')->img($item->image)->folder('accessory')->getThumb().");'></div><a href='javascript:;' class='event-event' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this event'>".$item->name."</strong></a> - <small>".$suitable."<br>".$this->load->module('text')->cut($item->description,100)."</small>",	
						"text-price"=>ucfirst($item->userName)." <span class='text-danger'>S$ ".number_format($item->price)."</span><br><small class='text-success'>".$item->dealerName."</small>",
						"text-cate"=>$item->categoryName."<br>".ucfirst(str_replace('_',' ',$item->quality)),
						"id"=>$item->id,
						"bikeName"=>$item->name,		
						"make"=>$item->makeId,	
						"image"=>$this->load->module('image')->img($item->image)->folder('accessory')->getThumb(),	
						"description"=>$item->description,
						"price"=>$item->price,
						"userId"=>$item->userId,
						"dealerId"=>$item->dealerId,
						"category"=>$item->category,
						"paid_ad"=>$item->paid_ad,
						"contact"=>$contact,
						"created"=>$item->modified.'<br><small>'.$item->created.'</small>',
						"ctl"=>$item->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"text-bike"=>"",	
					"text-price"=>"",
					"text-cate"=>"",
					"id"=>"",
					"bikeName"=>"",		
					"make"=>"",	
					"image"=>"",	
					"description"=>"",
					"price"=>"",
					"userId"=>"",
					"dealerId"=>"",
					"type_id"=>"",
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
		$data['cate']=$this->db->select(array('id `key`','name `value`'),false)->order_by('name ASC')->get_where('category',array('ctl'=>0,'position <>'=>'directory'))->result_object();
		$data['user']=$this->db->select(array('id `key`','fullname `value`'),false)->order_by('fullname ASC')->get_where('user',array('ctl'=>0))->result_object();
		$data['dealer']=$this->db->select(array('id `key`','company `value`'),false)->order_by('company ASC')->get_where('directory',array('ctl'=>0))->result_object();	
		echo json_encode($data);
	}
	public function getImages()
	{
		if(ctype_digit($_POST['id'])){
			$img=$this->db->select(array('image'))->get_where('accessory',array('ctl'=>0,'id'=>$_POST['id']))->row_object();			
			$data=$this->db->select(array('id `image-id`','image `image_url`'))->order_by('created ASC')->get_where('image',array('ctl'=>0,'item'=>$_POST['id'],'position'=>$_POST['position']))->result_object();
			foreach ($data as $k => $v) {
				if($img->image==$v->image_url){
					$data[$k]->checked='default';
				}else{
					$data[$k]->checked='';
				}
				$data[$k]->image_url='background:url('.$this->load->module('image')->img($v->image_url)->folder('accessory')->getThumb().')';
			}		
			echo json_encode($data);	
		}
	}
	public function getContact($id=false)
	{
		if(ctype_digit($id)){			
			$data=$this->db->select(array('id','name','address','email','phone'))->order_by('sorted ASC,name ASC')->get_where('seller',array('ctl'=>0,'bike_id'=>$id,'position'=>'accessory'))->result_object();
			return $data;	
		}
	}
	public function removeAccImage()
	{
		if(ctype_digit($_POST['id'])){
			echo json_encode($this->db->set('ctl',2)
			->where(array('id'=>$_POST['id'],'position'=>'accessory'))
			->update('image'));
		}
	}
	public function addAContact()
	{
		if(ctype_digit($_POST['bike_id'])){
			$_POST['created']=_DATE;
			$_POST['position']='accessory';
			$this->db->insert('seller',$_POST);		
			echo json_encode($this->db->insert_id());
		}
	}
	public function sortAContact()
	{
		if(ctype_digit($_POST['id'])&&$_POST['items']){
			foreach ($_POST['items'] as $k => $v) {
				$this->db->set('sorted',$k+1)
				->where(array('ctl'=>0,'bike_id'=>$_POST['id'],'position'=>'accessory','id'=>$v))
				->update('seller');
			}
			echo json_encode(true);
		}
	}
	public function removeAContact()
	{
		if(ctype_digit($_POST['id'])){
			echo json_encode($this->db->set('ctl',2)
			->where(array('id'=>$_POST['id']))
			->update('seller'));
		}
	}
	public function defaultAccimage()
	{
		if(ctype_digit($_POST['id'])){
			$img=$this->db->select(array('image','item'))->get_where('image',array('ctl'=>0,'id'=>$_POST['id']))->row_object();
			echo json_encode($this->db->set('image',$img->image)
			->where(array('id'=>$img->item))
			->update('accessory'));
		}
	}
	public function newAccessory()
	{
		$this->form_validation->set_rules('name', 'Model','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('price', 'Price','trim');
		$this->form_validation->set_rules('description', 'Description','trim');
		$this->form_validation->set_rules('make', 'Model','trim');
		$this->form_validation->set_rules('category', 'Category','trim');
		$this->form_validation->set_rules('user', 'User','trim');
		$this->form_validation->set_rules('dealer', 'Dealer','trim');
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
            $this->db->insert('accessory',$_POST);
            $id=$this->db->insert_id();
        	foreach ($file as $k => $img) {
	        	if(empty($img['error'])){
					$img=$this->load->module('image')
					->file($img)
					->folder('accessory')
					->type('gif|jpg|png')
					->crRec()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/accessories');
					}elseif(isset($img->name)){
						if(empty($k))$_POST['image']=$img->name;
						$_img=array(
							'image'=>$img->name,
							'item'=>$id,
							'position'=>'accessory',
							'created'=>_DATE
						);
						$this->db->insert('image',$_img);
					}
				}
        	} 
        	$this->db->set(array('image'=>$_POST['image']))
            ->where(array('id'=>$id))
			->update('accessory'); 	
			$this->session->set_flashdata('error', "You have been added accessory successfully!");
			redirect(_URL.'dashboard/accessories');	
		}		
		$this->index();
	}
	public function editAccessory()
	{
		$this->form_validation->set_rules('id','Accessory', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('name', 'Model','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('price', 'Price','trim');
		$this->form_validation->set_rules('description', 'Description','trim');
		$this->form_validation->set_rules('make', 'Model','trim');
		$this->form_validation->set_rules('category', 'Category','trim');
		$this->form_validation->set_rules('user', 'User','trim');
		$this->form_validation->set_rules('dealer', 'Dealer','trim');
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
				->where(array('item'=>$id,'position'=>'accessory'))
				->update('image');
				unset($_POST['del']);
        	}	
        	foreach ($file as $k => $img) {
	        	if(empty($img['error'])){
					$img=$this->load->module('image')
					->file($img)
					->folder('accessory')
					->type('gif|jpg|png')
					->crRec()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/accessories');
					}elseif(isset($img->name)){
						if(empty($k))$_POST['image']=$img->name;
						$_img=array(
							'image'=>$img->name,
							'item'=>$id,
							'position'=>'accessory',
							'created'=>_DATE
						);
						$this->db->insert('image',$_img);
					}
				}
        	}  	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('accessory');
			$this->session->set_flashdata('error', "You have been updated accessory successfully!");
			redirect(_URL.'dashboard/accessories');	
		}		
		$this->index();
	}
	public function lockItems()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>3))
            ->where_in('id',$_POST['items'])
			->update('accessory'));	
		}			  
	}
	public function soldItems()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('accessory'));	
		}			  
	}
	public function unlockItems()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('accessory'));	
		}
	}
	public function delItems()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('accessory'));	
		}
	}
}
