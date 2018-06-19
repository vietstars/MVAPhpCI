<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class articles extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	public function index()
	{
		$data['blog_id'] = array('id'=>'new-blog');
		$data['blog_action'] = _URL.'dashboard/newArticle';
		$this->_render('dashboard/articles',$data);
	}
	public function blogList()
	{
		if($_POST){
			$option['page']=$_POST['start'];
			$option['block']=$_POST['length'];
			$option['dir']="ASC";
			$option['order']="blog.ctl ASC,blog.id";
			$option['search']=null;			
			if(isset($_POST['order'][0])){
				$option['dir']=$_POST['order'][0]['dir'];
				if($_POST['order'][0]['column']==0)$option['order']='blog.title';elseif($_POST['order'][0]['column']==1)$option['order']='blog.content';elseif($_POST['order'][0]['column']==2)$option['order']='blog.modified';
			}
			if(isset($_POST['search']['value'])&&$_POST['search']['value']){
				$option['search']='(blog.title LIKE \'%'.$_POST['search']['value'].'%\' OR blog.content LIKE \'%'.$_POST['search']['value'].'%\')';
				$this->db->cache_off();
				$results=$this->db->select(array('blog.id','blog.title','blog.content','blog.image','DATE_FORMAT({pre}blog.created,"%b, %d %Y") `created`','DATE_FORMAT({pre}blog.modified,"%b, %d %Y") `modified`','blog.ctl'))
				->where($option['search'])
				->order_by($option['order']." ".$option['dir'])
				->get_where('blog',array('blog.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}else{
				$this->db->cache_off();
				$results=$this->db->select(array('blog.id','blog.title','blog.content','blog.image','DATE_FORMAT({pre}blog.created,"%b, %d %Y") `created`','DATE_FORMAT({pre}blog.modified,"%b, %d %Y") `modified`','blog.ctl'))				
				->order_by($option['order']." ".$option['dir'])
				->get_where('blog',array('blog.ctl <>'=>2),$option['block'],$option['page'])
				->result_object();
			}
			$this->db->cache_off();
			$total=$this->db->select('count(*)`total`')->get_where('usedbike',array('ctl<>'=>2))->row_object();
			if($results){
				foreach ($results as $blog) {
					$data=array(
						"id"=>$blog->id,
						"text-title"=>"<div class='checkbox'><input type='checkbox' class='check-id' value='".$blog->id."'><label></label></div><div class='img-avatar pull-right' style='background:url(".$this->load->module('image')->img($blog->image)->folder('blog')->getThumb().");'></div><a href='javascript:;' class='event-event' data-toggle='popover'><strong data-toggle='tooltip' data-placement='top' data-original-title='Click to edit this event'>".$blog->title."</strong></a>",
						"text-content"=>$this->load->module('text')->cut($blog->content,300),
						"image"=>$this->load->module('image')->img($blog->image)->folder('blog')->get(),
						"title"=>$blog->title,
						"content"=>$blog->content,
						"created"=>$blog->modified.'<br><small>'.$blog->created.'</small>',
						"ctl"=>$blog->ctl
					);
					$datas[]=$data;
				}
			}else{
				$datas[]=array(
					"id"=>"",
					"text-title"=>"",
					"text-content"=>"",
					"image"=>"",
					"title"=>"",
					"content"=>"",
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
	public function addBlog()
	{
		$this->form_validation->set_rules('title', 'Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('content', 'Price','trim');
		if ($this->form_validation->run())
        {	
        	foreach ($_POST as $key => $value) {
        		if($value=='null'){
        			unset($_POST[$key]);
        		}
        	}
        	$img=$this->load->module('image')
			->file($_FILES['image'])
			->folder('blog')
			->type('gif|jpg|png')
			->crCrop()
			->crThumb()
			->upImage();			
        	$_POST['created']=_DATE;
        	$_POST['user_id']=$this->_user_id;
			if(isset($img->name))$_POST['image']=$img->name;
            $this->db->insert('blog',$_POST);        	 	
			$this->session->set_flashdata('error', "You have been added article successfully!");
			redirect(_URL.'dashboard/articles');	
		}		
		$this->index();
	}
	public function editBlog()
	{
		$this->form_validation->set_rules('id','Blog', 'trim|required',array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('title', 'Title','trim|required',array('required' => 'You have not provided %s.'));
		$this->form_validation->set_rules('content', 'content','trim');
		if ($this->form_validation->run())
        {	
        	$id=$_POST['id'];unset($_POST['id']);
        	foreach ($_POST as $key => $value) {
        		if($value=='null'){
        			unset($_POST[$key]);
        		}
        	}
        	$img=$this->load->module('image')
			->file($_FILES['image'])
			->folder('blog')
			->type('gif|jpg|png')
			->crCrop()
			->crThumb()
			->upImage();
			$_POST['user_id']=$this->_user_id;
			if(isset($img->name))$_POST['image']=$img->name; 	
            $this->db->set($_POST)
            ->where(array('id'=>$id))
			->update('blog');
			$this->session->set_flashdata('error', "You have been updated article successfully!");
			redirect(_URL.'dashboard/articles');	
		}		
		$this->index();
	}
	public function lockBlog()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>1))
            ->where_in('id',$_POST['items'])
			->update('blog'));	
		}			  
	}
	public function unlockBlog()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>0))
            ->where_in('id',$_POST['items'])
			->update('blog'));	
		}
	}
	public function delBlog()
	{
		if ($_POST['items'])
        {		
            echo json_encode($this->db->set(array('ctl'=>2))
            ->where_in('id',$_POST['items'])
			->update('blog'));	
		}
	}
}
