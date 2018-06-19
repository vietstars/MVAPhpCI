<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	public $_user_id;

	public $_user_name;

	public $_level;

	public $_logged;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
		$this->_checkLogged();		
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public function _render($view, $data = NULL, $returnhtml = 1)
	{
		if(empty($this->data)){
			$this->viewdata = (empty($data)) ? NULL : $data;
		}else{
			$this->viewdata = (empty($data)) ? $this->data : $data;	
		}
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);
		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}

	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 */
	public function _cookie($key = FALSE, $val = FALSE, $expire = FALSE)
	{
		if(empty($val)){ 
			return get_cookie($key); 
		}else{ 
			if($val=='del')
			setcookie($key,'',_NOW-3600,'/',$_SERVER['SERVER_NAME'],false);
				else
			setcookie($key,$val,$expire,'/',$_SERVER['SERVER_NAME'],false);
		}
	}

	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 */
	public function _checkLogged()
	{		
		if(null===$this->_cookie('lang'))$this->_cookie('lang','en');
		if($this->_cookie('loghash')){
			$loghash=$this->_cookie('loghash');
			$point=strlen(_NOW);
			$lasttime=substr($loghash,-$point);
			$hashid=substr($loghash,0,-$point);
			$config =& get_config();
			if($lasttime>=_NOW-$config['logtime']){
				$logged=$this->_cookie('logged');
				list($id,$name,$uptime)=explode('_',$logged);
				$this->_cookie('loghash',$hashid._NOW,_NOW+$config['logtime']);
				$this->_cookie('logged',$id.'_'.$name.'_'.$uptime,_NOW+$config['logtime']);
				$this->_level=substr($loghash,0,1);
				$this->_user_id=$id;
				$this->_user_name=$name;
				$this->_logged=TRUE;
				if($uptime>=_NOW-$config['session_up']){
					$this->db->set(array('lastactivity'=>$_SERVER['REQUEST_URI'],'lastime'=>date('Y-m-d H:i:s')))
					->where(array('idhash'=>substr($hashid,1)))
					->update('session');
					$this->_cookie('logged',$id.'_'.$name.'_'._NOW,_NOW+$config['logtime']);
					$this->db->set(array('ctl'=>2))
					->where(array('UNIX_TIMESTAMP(lastime)<'=>_NOW-$config['outtime']))
					->update('session');
					$sessions=$this->db->select(array('userid','lastactivity','UNIX_TIMESTAMP(logintime)`logintime`','UNIX_TIMESTAMP(lastime)`lastime`'))
					->get_where('session', array('ctl'=>2))->result();
					if(!empty($sessions)){
						foreach ($sessions as $session) {
							$got=$this->db->select('visited')->get_where('user', array('id'=>$session->userid))->row_object();
							$visittime=$session->lastime-$session->logintime;
							$addvisit=array(
								'lastactivity'=>$session->lastactivity,
								'visited'=>$got->visited + $visittime,
								'lastvisit'=>date('Y-m-d H:i:s'),
							);
							$this->db->set($addvisit)
							->where(array('id'=>$session->userid))
							->update('user');
							$this->db->where(array('ctl'=>2))->delete('session');
						}
					}
				}
			}else{
				$this->_cookie('loghash','del');
				$this->_cookie('logged','del');
				$this->db->set(array('lastime'=>date('Y-m-d H:i:s'),'ctl'=>2))
				->where(array('idhash'=>substr($hashid,1)))
				->update('session');
				$this->_logged=FALSE;
				redirect(_URL);
			}
		}else{
			$this->_logged=FALSE;
		}
		$ci_folder=current($this->uri->segments);
		if($ci_folder=='master'){
			if($this->_level<$this->config->item('master') || $this->_logged==false)redirect(_URL);
		}
		if($ci_folder=='dashboard'){
			if($this->_level<$this->config->item('dashboard') || $this->_logged==false)redirect(_URL);
		}
		if($ci_folder=='mod'){
			if($this->_level<$this->config->item('moderator') || $this->_logged==false)redirect(_URL);
		}
	}
}
