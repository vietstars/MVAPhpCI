<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		// $this->_sv = $this->load->database('server',TRUE); 		     
	}
	// public function index()
	// {
		// $this->load->_ci_title='Home page';
        // $query = $this->_sv->get('user');
        // $user['data'] = $query->result();
     	// $user = $this->db->get('user');
     	// $user2 = $this->db->get_where('user', array('id' => 2));
      	// var_dump($user2->result());
		// var_dump($this->agent->browser());
		// $this->_cookie("lg","vn",_NOW+60);
		// var_dump($this->_cookie('lg'));
		// var_dump($this->session);
		// setcookie("lg","en",false, '/',$_SERVER['SERVER_NAME'], false);
		// var_dump(get_cookie('lg'));
		// $this->_render('template/default/index');
	// }
	public function login()
	{
		if(empty($this->_logged)){
			$this->form_validation->set_rules('password','Password', 'trim|required|min_length[8]',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('identity', 'Email','trim|required|valid_email',array(
	            'required'      => 'You have not provided %s.'
	        ));
			if ($this->form_validation->run())
	        {
				$profile=$this->db->select(array('user.id','user.fullname','user.password','user.salt','role.role','role.level','user.lastvisit','user.lg'))
				->join('role','role.id=user.role')
				->get_where('user', array('user.email'=>$_POST['identity'],'user.ctl'=>0))
				->row_object();
				sleep(2);
				$config =& get_config();
				if(!empty($profile)){
					if($_POST['password']==md5($profile->password.'_'.$profile->salt)){
						unset($_POST['password'],$profile->password,$profile->salt);
						$this->updateSessionUser($profile->id);
						$hashid=uniqid();
						$session=array(
							'idhash'=>$hashid,
							'userid'=>$profile->id,
							'host'=>$_SERVER['REMOTE_ADDR'],
							'lastactivity'=>$_SERVER['REQUEST_URI'],
							'useragent'=>$this->agent->browser(),
							'loggedin'=>1,
							'logintime'=>_DATE,
							'apiaccesstoken'=>preg_replace('/[^a-zA-Z0-9]/','', base64_encode(openssl_random_pseudo_bytes(24))),				
						);
						$this->db->insert('session',$session);
						$this->_cookie('lang',$profile->lg);
						$this->deleteSession();
						$this->updateLoggedOut();
						$this->_cookie("loghash",$profile->level.$hashid._NOW,_NOW+$config['logtime']);
						$this->_cookie("logged",$profile->id.'_'.$profile->fullname.'_'._NOW,_NOW+$config['logtime']);
						$this->session->set_flashdata('error', "Welcome ".$profile->fullname.", to Our site. ");
						redirect(_URL);
						exit();
					}else{
						$this->session->set_flashdata('error', "Our system can't find your matching data!");
					}
				}else{
					$this->session->set_flashdata('error', "Our system can't find your matching data!");
				}
			}			
			$this->load->_ci_title='Login';
			$data['attributes'] = array('id' => 'login-form');
			$data['banner']=_IMG."system/mva_about_us_hero_wide.jpg";
			$data['bg_class']="aboutus-page";
			$data['bg_content']='<div class="gradient-bg">'.
				'<div class="container">'.
					'<div class="banner-text aboutus-text">'.
						'<h1>THIS IS US</h1>'.
						'<span>We do not simply build motorcycles, we craft emotions. We look to the future, and build machines that are always one step ahead.</span>'.
					'</div>'.
				'</div>'.
			'</div>';  
			$this->_render('template/default/login',$data);
		}else{
			redirect(_URL);
			exit();
		} 
	}
	public function checkUser()
	{
		if($_POST){
			$avatar=null;
			if(isset($_POST['data']['first_name'])&&$_POST['data']['first_name']&&isset($_POST['data']['last_name'])&&$_POST['data']['last_name'])$fullname=$_POST['data']['first_name'].'_'.$_POST['data']['last_name'];else$fullname='';
			if(isset($_POST['data']['gender'])&&$_POST['data']['gender'])$gender=$_POST['data']['gender'];else$gender='male';
			if(isset($_POST['data']['id'])&&$_POST['data']['id'])$id_no=$_POST['data']['id'];else$id_no='';
			$gotuser=$this->db->select(array('id','fullname','lg'))->get_where('user',array('id_no'=>'FB:'.$id_no))->row_object();
			if(isset($_POST['data']['picture']['data']['url'])&&$_POST['data']['picture']['data']['url']&&(!isset($gotuser->avatar)||empty($gotuser->avatar))){
				$avatar=$this->load->module("image")->folder('avatar')->img($id_no.'.jpg')->save_image($_POST['data']['picture']['data']['url']);
			}
			$config =& get_config();
			if($gotuser->id){
				$id=$gotuser->id;
				$fullname=$gotuser->fullname;
				$return=_URL;
				$lg=$gotuser->lg;
			}else{
				$register=array(
					'fullname'=>($fullname)?$fullname:$id_no,
					'id_no'=>'FB:'.$id_no,
					'gender'=>$gender,
					'avatar'=>$avatar,
					'salt'=>'fb:'.$id_no,
					"role"=>5,
					"actived"=>_DATE,
					"created"=>_DATE,		
				);
				if($this->db->insert('user',$register)){
					$id=$this->db->insert_id();
					$fullname=$register['fullname'];
					$return=_URL.'profile';
					$lg='en';
				}
			}
			$this->updateSessionUser($id);
			$hashid=uniqid();
			$session=array(
				'idhash'=>$hashid,
				'userid'=>$id,
				'host'=>$_SERVER['REMOTE_ADDR'],
				'lastactivity'=>$_SERVER['REQUEST_URI'],
				'useragent'=>$this->agent->browser(),
				'loggedin'=>1,
				'logintime'=>_DATE,
				'apiaccesstoken'=>preg_replace('/[^a-zA-Z0-9]/','', base64_encode(openssl_random_pseudo_bytes(24))),				
			);
			$this->db->insert('session',$session);
			$this->deleteSession();
			$this->updateLoggedOut();
			$this->_cookie('lang','del');
			$this->_cookie('loghash','del');
			$this->_cookie('logged','del');
			$this->_cookie('lang',$lg);
			$this->db->set(array('lastime'=>_DATE,'ctl'=>2))
			->where(array('idhash'=>substr($hashid,1)))
			->update('session');
			$this->_cookie("loghash",'1'.$hashid._NOW,_NOW+$config['logtime']);
			$this->_cookie("logged",$id.'_'.$fullname.'_'._NOW,_NOW+$config['logtime']);
			$this->session->set_flashdata('error', "Welcome ".$fullname.", to Our site.");
			echo json_encode($return);
		}
	}
	public function register()
	{
		if(empty($this->_logged)){
			if($_POST){
		        if(isset($_POST['g-recaptcha-response']))
			          	$captcha=$_POST['g-recaptcha-response'];
		        if(!$captcha){
		          	$this->session->set_flashdata('error', 'Please check your data again, Thanks');				
		        }
		        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcKDikTAAAAAC1roLfEGpqhm_GBjMZivOkTPHIE&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		        if($response['success'] == false)
		        {
		          	$this->session->set_flashdata('error', "Please don't spam, Thanks");				
		        }
		        else
		        {
					$this->form_validation->set_rules('name','Username','trim|required|min_length[5]|max_length[12]|is_unique[user.fullname]',array(
			            'required'      => 'You have not provided %s.',
			            'is_unique'     => 'This %s already exists.'
			        ));
					$this->form_validation->set_rules('password','Password', 'trim|required|min_length[8]',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('repassword','Password Confirmation','trim|required|matches[password]');
					$this->form_validation->set_rules('identity', 'Email','trim|required|valid_email|is_unique[user.email]',array(
			            'required'      => 'You have not provided %s.',
			            'is_unique'     => 'This %s already exists.'
			        ));
					if($this->form_validation->run()){
						unset($_POST['g-recaptcha-response']);
						list($pass,$salt)=explode('_',$_POST['password']);
						$insert=array(
							'fullname'=>$_POST['name'],
							'password'=>$pass,
							'salt'=>$salt,
							'email'=>$_POST['identity'],
							'role'=>6,
							'created'=>_DATE
						);
						$this->db->insert('user',$insert);
						$this->session->set_flashdata('error', "Thank you for registering with our site!");	
						redirect(_URL.'login');exit();
					}
		        }
			}
			$this->load->_ci_title='Register';
			$data['attributes'] = array('id' => 'myform');
			$data['banner']=_IMG."system/mva_about_us_hero_wide.jpg";
			$data['bg_class']="aboutus-page";
			$data['bg_content']='<div class="gradient-bg">'.
				'<div class="container">'.
					'<div class="banner-text aboutus-text">'.
						'<h1>THIS IS US</h1>'.
						'<span>We do not simply build motorcycles, we craft emotions. We look to the future, and build machines that are always one step ahead.</span>'.
					'</div>'.
				'</div>'.
			'</div>';  
			$this->_render('template/default/register',$data);
		}else redirect(_URL);
	}
	public function updateLoggedOut()
	{
		$config =& get_config();
		$this->db->set(array('ctl'=>2))
		->where(array('UNIX_TIMESTAMP(lastime)<'=>_NOW-$config['outtime']))
		->update('session');
	}
	public function deleteSession()
	{
		$sessions=$this->db->select(array('userid','lastactivity','UNIX_TIMESTAMP(logintime)`logintime`','UNIX_TIMESTAMP(lastime)`lastime`'))
		->get_where('session', array('ctl'=>2))->result();
		if(!empty($sessions)){
			foreach ($sessions as $session) {
				$got=$this->db->select('visited')->get_where('user', array('id'=>$session->userid))->row_object();
				$visittime=$session->lastime-$session->logintime;
				$addvisit=array(
					'lastactivity'=>$session->lastactivity,
					'visited'=>$got->visited + $visittime,
					'lastvisit'=>_DATE,
				);
				$this->db->set($addvisit)
				->where(array('id'=>$session->userid))
				->update('user');
				$this->db->where(array('ctl'=>2))->delete('session');
			}
		}
	}
	public function updateSessionUser($user=false)
	{
		if($user){
			$user_check=array(
				'userid'=>$user,
				'host'=>$_SERVER['REMOTE_ADDR'],
				'lastactivity'=>$_SERVER['REQUEST_URI'],
				'useragent'=>$this->agent->browser(),
				'ctl'=>0
			);
			$this->db->set('ctl',2)
			->where( $user_check)
			->update('session');
		}
	}
	public function logout()
	{
		if(!empty($this->_logged)){
			$loghash=$this->_cookie('loghash');
			$point=strlen(_NOW);
			$hashid=substr($loghash,0,-$point);
			$this->_cookie('loghash','del');
			$this->_cookie('logged','del');
			$this->db->set(array('lastime'=>_DATE,'ctl'=>2))
			->where(array('idhash'=>substr($hashid,1)))
			->update('session');			
			$this->session->set_flashdata('error', "You has been logged out successfully, Thanks!");
			redirect(_URL);
		}else redirect(_URL);exit();
	}
	public function changeLanguage()
	{
		if(null===$_COOKIE['lang']){
			$_lg='en';
		}else{
			if($_COOKIE['lang']=='en'){
				$_lg='cn';
			}else{
				$_lg='en';
			}
		}
		if(null!==$this->_user_id){
			$this->db->set(array('lg'=>$_lg))
				->where(array('id'=>$this->_user_id))
				->update('user');			
		}
		return $this->_cookie('lang',$_lg);
	}
}
