<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class text_module //extends CI_Controller 
{
	// public function __construct()
 //    {
 //        parent::__construct();
	// }
	public function cut($text=false,$len=20)
	{
		if($text){
			mb_internal_encoding('UTF-8'); 
			mb_strlen($text,'UTF-8')>$len?($text=mb_substr($text,0,$len,'UTF-8')and$text=mb_substr($text,0, mb_strrpos($text," ",'UTF-8'),'UTF-8').'...'):null;
		}else $text='&nbsp;';
		return $text;
	}
}
