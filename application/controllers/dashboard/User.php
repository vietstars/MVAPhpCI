<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['user_id'] = array('id'=>'new-user');
		$data['user_action'] = _URL.'dashboard/newUser';
		// $user=$this->db->get_where('user',array('id'=>1))->row_object();
		// $data['user_info']=(object)array_map(function($ar){ return ''; },(array)$user);
		$this->_render('dashboard/user',$data);
	}
	public function userList()
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
				$option['search']='(fullname LIKE \'%'.$_POST['search']['value'].'%\' OR email LIKE \'%'.$_POST['search']['value'].'%\' OR telno LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results = $this->db->select(array('id','fullname','email','id_no','gender','avatar','telno','address','visited','DATE_FORMAT(created,"%b, %d %Y")`created`','DATE_FORMAT(birthday,"%Y-%m-%d")`birthday`','ctl'))->where($option['search'])->order_by($option['order']." ".$option['dir'])->get_where('user',array('role'=>2,'ctl<>'=>2))->result_object();
			}else{
				$this->db->cache_off();
				$results = $this->db->select(array('id','fullname','email','id_no','gender','avatar','telno','address','visited','DATE_FORMAT(created,"%b, %d %Y")`created`','DATE_FORMAT(birthday,"%Y-%m-%d")`birthday`','ctl'))->order_by($option['order']." ".$option['dir'])->get_where('user',array('role'=>2,'ctl<>'=>2),$option['block'],$option['page'])->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('user',array('role'=>2,'ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $user) {
					$hours=floor($user->visited / 3600);
					$mins=floor($user->visited / 60 % 60);
					/*$secs=floor($user->visited % 60);*/
					$visited=$hours."h ".$mins."'";
					$data=array(
						"id"=>$user->id,
						"text-name"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$user->id."'><label></label></div><div class='img-avatar pull-right' style='background:url(".$this->load->module('image')->img($user->avatar)->folder('avatar')->getThumb().");'></div><a href='javascript:;'  data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to view message'>".$user->fullname."</strong></a> [<i class='text-danger la la-".$user->gender."'></i>]<br>".$user->email,
						"text-phone"=>"<strong>".$user->telno."</strong><br>".$user->address,
						"text-birthday"=>"<strong>".date('M, d Y',strtotime($user->birthday))."</strong><br><small>".$user->created."</small>",
						"fullname"=>$user->fullname,
						"gender"=>$user->gender,
						"email"=>$user->email,
						"avatar"=>$this->load->module('image')->img($user->avatar)->folder('avatar')->getThumb(),
						"telno"=>$user->telno,
						"address"=>$user->address,
						"birthday"=>$user->birthday,
						"created"=>$visited,
						"ctl"=>$user->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"id"=>"",
					"text-name"=>"",
					"text-phone"=>"",
					"text-birthday"=>"",
					"fullname"=>"",
					"gender"=>"",
					"email"=>"",
					"avatar"=>"",
					"telno"=>"",
					"address"=>"",
					"birthday"=>"",
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
	public function editUser()
	{
		$this->form_validation->set_rules('fullname', 'Fullname','trim|required',array(
			'required' => 'You have not provided %s.'
		));
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email',array(
			'required' => 'You have not provided %s.'
		));
		if ($this->form_validation->run())
        {	
        	$id=$_POST['id'];unset($_POST['id']);
        	$info=$this->db->select(array('fullname','email'))->get_where('user',array('role'=>2,'ctl<>'=>2,'id'=>$id))->row_object();	
        	if($info->fullname!=$_POST['fullname']){
				$this->form_validation->set_rules('fullname', 'Fullname','is_unique[user.fullname]',array(
					'is_unique'     => 'This %s already exists.'
				));
        	}
        	if($info->email!=$_POST['email']){
				$this->form_validation->set_rules('email', 'Email','is_unique[user.email]',array(
					'is_unique'     => 'This %s already exists.'
				));
			}
			if ($this->form_validation->run()){
				if(empty($_FILES['avatar']['error'])){
					$img=$this->load->module('image')
					->file($_FILES['avatar'])
					->folder('avatar')
					->type('gif|jpg|png')
					->crCrop()
					->crThumb()
					->upImage();
					if(isset($img->error)){
						$this->session->set_flashdata('error',$img->error);
						redirect(_URL.'dashboard/user');
					}elseif(isset($img->name))$_POST['avatar']=$img->name;
				}
				if(!empty($_POST['password'])){
		        	list($pass,$salt)=explode('_',$_POST['password']);
		        	$_POST['password']=$pass;
		        	$_POST['salt']=$salt;
				}else unset($_POST['password']);
	            $this->db->set($_POST)
	            ->where(array('id'=>$id))
				->update('user');
				$this->session->set_flashdata('error', "You have been updated user information successfully!");
				redirect(_URL.'dashboard/user');
			}	
		}		
		$this->index();
	}
	public function newUser()
	{
		$this->form_validation->set_rules('fullname', 'Fullname','trim|required|is_unique[user.fullname]',array(
			'required' => 'You have not provided %s.',
			'is_unique'     => 'This %s already exists.'
		));
		$this->form_validation->set_rules('password', 'password','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|is_unique[user.email]',array(
			'required' => 'You have not provided %s.',
			'is_unique'     => 'This %s already exists.'
		));
		if ($this->form_validation->run())
        {	
        	if(empty($_FILES['avatar']['error'])){
				$img=$this->load->module('image')
				->file($_FILES['avatar'])
				->folder('avatar')
				->type('gif|jpg|png')
				->crCrop()
				->crThumb()
				->upImage();
				if(isset($img->error)){
					$this->session->set_flashdata('error',$img->error);
					redirect(_URL.'dashboard/user');
				}elseif(isset($img->name))$_POST['avatar']=$img->name;
			}
        	list($pass,$salt)=explode('_',$_POST['password']);
        	$_POST['password']=$pass;
        	$_POST['salt']=$salt;
        	$_POST['role']=2;
        	$_POST['created']=_DATE;
			$this->db->insert('user',$_POST);
			$this->session->set_flashdata('error', "You have been added new user successfully!");
			redirect(_URL.'dashboard/user');	
		}
		$this->index();
	}
	public function delUser()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('user'));	
		}
	}
	public function lockUser()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('user'));	
		}			  
	}
	public function unlockUser()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('user'));	
		}
	}
}
