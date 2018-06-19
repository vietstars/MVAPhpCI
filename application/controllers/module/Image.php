<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class image_module extends CI_Controller {
	private $_img='no_photo.svg';
	private $_folder='underfined';
	private $_file=array();
	private $_canType='gif|jpg|png|svg';
	private $_maxSize=0;
	private $_maxWidth=0;
	private $_maxHeight=0;
	private $_width=500;
	private $_height=500;
	private $_size=350;
	private $_thumbSize=350;
	private $_compress=80;
	private $_imgType=IMAGETYPE_JPEG;
	private $_inPath='';
	private $_outPath='';
	private $_errorImg='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTQ3cHgiIGhlaWdodD0iMTQ3cHgiIHZpZXdCb3g9IjAgMCAxNDcgMTQ3IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxNDcgMTQ3IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGZpbGw9IiM4MDgyODUiIGQ9Ik00MS44NDMsOTguOTEyYzAsMy42NjksMi45ODcsNi42NDMsNi42NDMsNi42NDNIOTguMmMzLjY2OSwwLDYuNjQzLTIuOTg2LDYuNjQzLTYuNjQzVjQ5LjE5Nw0KCWMwLTMuNjY5LTIuOTg2LTYuNjQzLTYuNjQzLTYuNjQzSDQ4LjQ4NWMtMy42NjksMC02LjY0MywyLjk4Ni02LjY0Myw2LjY0M1Y5OC45MTJ6IE05OC4yLDEwMi40MDFINDguNDg1DQoJYy0xLjkxOCwwLTMuNDg5LTEuNTctMy40ODktMy40ODl2LTguMzAzbDExLjk0Ni0xMS45NDZsMTAuMjA4LDEwLjIwOGMwLjYxOCwwLjYxOSwxLjYwOSwwLjYxOSwyLjIyNywwbDE4LjQzNS0xOC40MzNsMTMuODc3LDEzLjg3Ng0KCXYxNC41OThDMTAxLjY4OSwxMDAuODMxLDEwMC4xMTgsMTAyLjQwMSw5OC4yLDEwMi40MDF6IE00OC40ODUsNDUuNzA5SDk4LjJjMS45MTgsMCwzLjQ4OSwxLjU3LDMuNDg5LDMuNDg4djMwLjY1TDg4LjkxOSw2Ny4wOTENCgljLTAuNjE4LTAuNjE4LTEuNjA4LTAuNjE4LTIuMjI4LDBMNjguMjU4LDg1LjUyNEw1OC4wNSw3NS4zMTZjLTAuNjE4LTAuNjE3LTEuNjA5LTAuNjE3LTIuMjI3LDBMNDQuOTk3LDg2LjE0M1Y0OS4xOTcNCglDNDQuOTk3LDQ3LjI3OSw0Ni41NjcsNDUuNzA5LDQ4LjQ4NSw0NS43MDl6Ii8+DQo8cGF0aCBmaWxsPSIjODA4Mjg1IiBkPSJNNjEuMzcxLDY3Ljc5OWM0LjQyOCwwLDguMDItMy42MDQsOC4wMi04LjAycy0zLjYwNC04LjAyLTguMDItOC4wMnMtOC4wMiwzLjYwNC04LjAyLDguMDINCglTNTYuOTQzLDY3Ljc5OSw2MS4zNzEsNjcuNzk5eiBNNjEuMzcxLDU0LjkxM2MyLjY5LDAsNC44NjYsMi4xODgsNC44NjYsNC44NjZzLTIuMTg4LDQuODY2LTQuODY2LDQuODY2cy00Ljg2Ni0yLjE4OC00Ljg2Ni00Ljg2Ng0KCVM1OC42ODEsNTQuOTEzLDYxLjM3MSw1NC45MTN6Ii8+DQo8L3N2Zz4NCg==';
	private $_crThumb=false;
	private $_crCrop=false;
	private $_crCropW=false;
	private $_crCropH=false;
	private $_crRec=false;

	public function __construct()
    {
        parent::__construct();
	}
	public function imgLoad($inPath) {
		$this->_inPath=$inPath;
		$imageInfo = getimagesize($inPath);
	  	$this->_imgType = $imageInfo[2];
	  	if( $this->_imgType == IMAGETYPE_JPEG ) {
			$this->_img = imagecreatefromjpeg($inPath);
	  	}elseif( $this->_imgType == IMAGETYPE_GIF ) {
			$this->_img = imagecreatefromgif($inPath);
	  	}elseif( $this->_imgType == IMAGETYPE_PNG ) {
			$this->_img = imagecreatefrompng($inPath);
	  	}
	  	$this->getWidth();	
	  	$this->getHeight();	
	  	$this->getMaxSize();	  	
	  	return $this;
	}	
   	public function imgSave($outPath=false) { 
		if( $this->_imgType == IMAGETYPE_JPEG ) {
		 	imagejpeg($this->_img,$outPath,$this->_compress);
		} elseif( $this->_imgType == IMAGETYPE_GIF ) {
		 	imagegif($this->_img,$outPath);
		} elseif( $this->_imgType == IMAGETYPE_PNG ) {		    
		 	imagepng($this->_img,$outPath);
		}
 		chmod($outPath,0777);
	 	return $this;
   	}
   	public function getWidth($return=false) {
		$this->_width=imagesx($this->_img);
		if($return)
			return $this->_width;
		else
			return $this;
	}
	public function getHeight($return=false) {
	  	$this->_height=imagesy($this->_img);
		if($return)
			return $this->_height;
		else
			return $this;
	}
	public function getMaxSize($return=false) {
		if($this->_width>$this->_height){
			$this->_size=$this->_width;
		}else{
			$this->_size=$this->_height;
		}
		$this->_size+=10;
		if($return)
			return $this->_size;
		else
			return $this;
	}
	public function getMinSize($return=false) {
		if($this->_width<$this->_height){
			$this->_size=$this->_width;
		}else{
			$this->_size=$this->_height;
		}
		if($return)
			return $this->_size;
		else
			return $this;
	}
	public function resize($width,$height) {
	  	$newImage=imagecreatetruecolor($width, $height);
	  	if($this->_imgType==IMAGETYPE_PNG){
	  		imagealphablending($newImage, false);
		    imagesavealpha($newImage, true);
		    $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
		    imagefilledrectangle($newImage, 0, 0, $width, $height, $transparent);
	  	}
	  	imagecopyresampled($newImage,$this->_img,0,0,0,0,$width,$height,$this->_width,$this->_height);
	  	$this->_img=$newImage;
	  	return $this;
	} 
	public function file($file=false)
	{
		if($file){
			$this->_file=$file;
			return $this;
		}else return false;
	}
	public function type($type=false)
	{
		if($type){
			$this->_canType=$type;
			return $this;
		}else return false;
	}
	public function maxSize($size=100)
	{
		if($size){
			$this->_maxSize=$size;
			return $this;
		}else return false;
	}
	public function maxWidth($width=1024)
	{
		if($width){
			$this->_maxWidth=$width;
			return $this;
		}else return false;
	}
	public function maxHeight($height=768)
	{
		if($height){
			$this->_maxHeight=$height;
			return $this;
		}else return false;
	}
	public function scaleToWidth($width) {
	  	$ratio=$width/$this->_width;
	  	$height=$this->_height*$ratio;
	  	$this->resize($width,$height);
	}
	public function scaleToHeight($height) {
	  	$ratio=$height/$this->_height;
	  	$width=$this->_width*$ratio;
	  	$this->resize($width,$height);
	}
	public function scale($percent=100) {
	  	$width=$this->_width*$percent/100;
	  	$height=$this->_height*$percent/100;
	  	$this->resize($width,$height);
	}
	public function fillRec($width,$height,$notcen=false) {
		$newImage=imagecreatetruecolor($width, $height);
		$white=imagecolorallocate($newImage, 255, 255, 255);
		// $transparent=imagecolorallocatealpha($newImage, 0, 0, 0, 127);
		if($notcen){
			$x=($width-$this->_width)/2;
			$y=1; //khác 0
		}else{
			$x=($width-$this->_width)/2;
			$y=($height-$this->_height)/2;
		}
		// imagefill($newImage,0,0,$transparent);
		// imagealphablending($newImage, false);
		// imagesavealpha($newImage, true);
		imagecopy($newImage,$this->_img,$x,$y,0,0,$width,$height);
		imagefill($newImage,0,0,$white);
		$this->_img = $newImage;
	}
	public function img($img=false)
	{
		if($img)$this->_img=$img;else$this->_img='no_photo.svg';
		return $this;
	}
	public function folder($folder=false)
	{
		if($folder)$this->_folder=$folder;else$this->_folder='underfined';
		return $this;
	}
	public function thumb()
	{
		$this->thumb=FALSE;
		return $this;
	}
	public function get()
	{
		if(empty($this->_img)||$this->_img=='no_photo.svg'){
			return $this->_errorImg;
		}else{
			if($this->_folder=='root'){
				$path=__IMG.$this->_img;
				if(file_exists($path)){
					return _IMG.$this->_img;
				}else{
					return $this->_errorImg;
				}
			}else{
				$date=current(explode("_",$this->_img));
				if(is_numeric($date)){
					$sub=date('d-m-Y',$date);
					$path=__IMG.$this->_folder._D.$sub._D.$this->_img;
					$thumbPath=__IMG.'thumb'._D.$this->_folder._D.$sub._D.$this->_img;
					if(file_exists($path)){
						return _IMG.$this->_folder._S.$sub._S.$this->_img;
					}elseif(file_exists($thumbPath)){
						return _IMG.'thumb'._S.$this->_folder._S.$sub._S.$this->_img;
					}else{
						return $this->_errorImg;
					}
				}else return $this->_errorImg;
			}
		}
		$this->clear();
	}
	public function getThumb()
	{
		if(empty($this->_img)||$this->_img=='no_photo.svg'){
			return $this->_errorImg;
		}else{
			if($this->_folder=='root'){
				$path=__IMG.$this->_img;
				if(file_exists($path)){
					return _IMG.$this->_img;
				}else{
					return $this->_errorImg;
				}
			}else{
				$date=current(explode("_",$this->_img));
				if(is_numeric($date)){
					$sub=date('d-m-Y',$date);
					$path=__IMG.$this->_folder._D.$sub._D.$this->_img;
					$thumbPath=__IMG.'thumb'._D.$this->_folder._D.$sub._D.$this->_img;
					if(file_exists($thumbPath)){
						return _IMG.'thumb'._S.$this->_folder._S.$sub._S.$this->_img;
					}elseif(file_exists($path)){
						return _IMG.$this->_folder._S.$sub._S.$this->_img;
					}else{
						return $this->_errorImg;
					}
				}else return $this->_errorImg;
			}
		}
		$this->clear();
	}
	public function getAvatar($user=false)
	{
		if($user){
			$got=$this->db->select('avatar')->get_where('user',array('id'=>$user))->row_object();
			if($got->avatar){
				return $this->img($got->avatar)->folder('avatar')->get();
			}else return $this->_errorImg;
		}else return $this->_errorImg;
	}
	public function getName($cur=false)
	{
		$names=explode(".",$this->_img);
		$ext=end($names);
		list($name,$null)=explode(".".$ext, $this->_img);
		$name=preg_replace('/[^A-Za-z0-9]/','_',$name);
		$name=preg_replace('/_+/','_',$name);
		if($cur)
			return $name.'.'.$ext;
		else
			return _NOW.'_'.$name.'.'.$ext;
	}
	public function mkFolder($sub=false)
	{
		$dir= __IMG.$this->_folder;
		if(!is_dir($dir)){
			mkdir($dir, 0777);
			chmod($dir, 0777);
		}
		if(!is_dir(__IMG."thumb")){
			mkdir(__IMG."thumb", 0777);
			chmod(__IMG."thumb", 0777);
		}
		$thumb= __IMG."thumb"._D.$this->_folder;
		if(!is_dir($thumb)){
			mkdir($thumb, 0777);
			chmod($thumb, 0777);
		}		
		$data=(object) array(
			'dir'=>__IMG.$this->_folder._D,
			'thumb'=>__IMG."thumb"._D.$this->_folder._D
		);
		if($sub){
			$subfolder= __IMG.$this->_folder._D.$sub;
			if(!is_dir($subfolder)){
				mkdir($subfolder, 0777);
				chmod($subfolder, 0777);
			}
			$subthumb= __IMG."thumb"._D.$this->_folder._D.$sub;
			if(!is_dir($subthumb)){
				mkdir($subthumb, 0777);
				chmod($subthumb, 0777);
			}
			$data=(object) array(
				'dir'=>__IMG.$this->_folder._D.$sub._D,
				'thumb'=>__IMG."thumb"._D.$this->_folder._D.$sub._D
			);
		}
		return $data;
	}
	public function clear()
	{
		$this->_img='no_photo.svg';
		$this->_folder='underfined';
		$this->_file=array();
		$this->_canType='gif|jpg|png';
		$this->_maxSize=0;
		$this->_maxWidth=0;
		$this->_maxHeight=0;
		$this->_width=500;
		$this->_height=500;
		$this->_size=350;
		$this->_thumbSize=350;
		$this->_compress=80;
		$this->_imgType=IMAGETYPE_JPEG;
		$this->_inPath='';
		$this->_outPath='';
		$this->_crThumb=false;
		$this->_crCrop=false;
		$this->_crCropW=false;
		$this->_crCropH=false;
		$this->_crRec=false;
		return $this;
	}	
	public function crThumb($outPath=false)
	{
		if($outPath){
			$this->_outPath=$outPath;
		}else{
			if(empty($this->_outPath))$this->_outPath=$this->_inPath;
		}
		$this->_crThumb=true;
		return $this;
	}
	public function crCrop($outPath=false,$w=false,$h=false)
	{
		if($outPath){
			$this->_outPath=$outPath;
		}else{
			if(empty($this->_outPath))$this->_outPath=$this->_inPath;
		}
		if($w&&$h){
			$this->_crCropW=$w;
			$this->_crCropH=$h;
		}
		$this->_crCrop=true;
		return $this;
	}
	public function crRec($outPath=false)
	{
		if($outPath){
			$this->_outPath=$outPath;
		}else{
			if(empty($this->_outPath))$this->_outPath=$this->_inPath;
		}
		$this->_crRec=true;
		return $this;
	}
	public function createThumb($outPath=false,$size=false,$clear=true)
	{
		if($size){
			$this->scaleToWidth($size);
		}else{
			$this->scaleToWidth($this->_thumbSize);
		}
		if($outPath)$this->imgSave($outPath);else$this->imgSave($this->_outnPath);
		if($clear)$this->clear();
	}
	public function fullRec($outPath=false,$clear=true)
	{
		$this->fillRec($this->_size,$this->_size);
		if($outPath)$this->imgSave($outPath);else$this->imgSave($this->_outPath);		
		if($clear)$this->clear();
	}
	public function cropCenter($outPath=false,$size=false,$clear=true) {
		if($size)$width=$height=$size;else{
			if($this->_crCropW&&$this->_crCropH){
				$width=$this->_crCropW;
				$height=$this->_crCropH;
			}else $width=$height=$this->getMinSize(1);
		}
	   	$new_image=imagecreatetruecolor($width,$height);
	   	$transparent=imagecolorallocatealpha($new_image, 0, 0, 0, 127);
		imagefill($new_image,0,0,$transparent);
		imagealphablending($new_image, false);
		imagesavealpha($new_image, true);
		$heightold=$height;
		$widthold=$width;
		$ratio_orig=$this->_width/$this->_height;
		$src_y=0;
		$src_x=0;
		if ($width/$height > $ratio_orig){
		    $ratio=$width/$this->_width;
	 		$height=$this->_height * $ratio;
			$src_y=-($height-$heightold)/2;
		}else
		{
		   $ratio=$height/$this->_height;
	 		$width=$this->_width * $ratio;
			$src_x=-($width-$heightold)/2;
		}
		imagecopyresampled($new_image,$this->_img,$src_x,$src_y,0,0,$width,$height,$this->_width,$this->_height);
		$this->_img=$new_image;
		if($outPath)$this->imgSave($outPath);else$this->imgSave($this->_outPath);		
		if($clear)$this->clear();
	}
	public function upImage()
	{
		$path=$this->mkFolder(date('d-m-Y'));
		$config['upload_path']=$path->dir;
    	$config['allowed_types']=$this->_canType;
    	if($this->_maxSize)$config['max_size']=$this->_maxSize;
    	if($this->_maxWidth)$config['max_width']=$this->_maxWidth;
    	if($this->_maxHeight)$config['max_height']=$this->_maxHeight;
        $this->upload->initialize($config);
		$_filename=$this->_file['name']=$this->img($this->_file['name'])->getname();
		$up=$this->upload->do_upload($this->_file);
		$this->_inPath=$path->dir.$_filename;$this->_outPath=$path->thumb.$_filename;
		if($up){
			$return=(object) array(
				'name'=>$_filename,
				'path'=>array($path->dir.$_filename,_IMG.$this->_folder._S.date('d-m-Y')._S.$_filename)
			);
			if($this->_crCrop){
				$this->imgLoad($this->_inPath)
				->cropCenter($this->_inPath,0,0);
			}elseif($this->_crRec){
				$this->imgLoad($this->_inPath)
				->fullRec($this->_inPath,0);
			}
			if($this->_crThumb){
				$return->thumb=(object)array($path->thumb.$_filename,_IMG.'thumb/'.$this->_folder._S.date('d-m-Y')._S.$_filename);
				$this->imgLoad($this->_inPath)
				->createThumb($this->_outPath,0,0);
			}
			$this->clear();
			return $return;
		}else{
			return (object)array('error'=>$this->upload->display_errors());
		} 
	}
	public function upCode($data=false)
	{
		if($data){
			$ext='/^image\/(gif|bmp|jpe?g|png|svg\+xml)$/';
			if(preg_match($ext,strtolower($this->_canType), $return)){
				$sized=$this->db->select('sys_key, sys_value')->where_in("sys_key",array("img_maxSize","img_maxCount"))->get("system")->result_object();
				foreach ($sized as $value) {
					$key=$value->sys_key;
					$$key=$value->sys_value;
				}
				if($data['size']<=$img_maxSize&&$data['img']){					
					$folder=$this->mkFolder(date('d-m-Y'));
					$_filename=$this->getname();
					$this->_inPath=$folder->dir.$_filename;
					$this->_outPath=$folder->thumb.$_filename;
					$up=fopen($this->_inPath,"wb"); 
					fwrite($up,base64_decode($data['img']));
					fclose($up);
					if($data['ext']=="image/svg+xml"){
						copy($this->_inPath,$this->_outPath);
					}else{
						$return=(object) array(
							'name'=>$_filename,
							'path'=>(object)array($this->_inPath,_IMG.$this->_folder._S.date('d-m-Y')._S.$_filename)
						);
						if($this->_crCrop){
							$this->imgLoad($this->_inPath)
							->cropCenter($this->_inPath,0,0);
						}elseif($this->_crRec){
							$this->imgLoad($this->_inPath)
							->fullRec($this->_inPath,0);
						}						
						if($this->_crThumb){
							$return->thumb=(object)array($this->_outPath,_IMG.'thumb/'.$this->_folder._S.date('d-m-Y/').$_filename);
							$this->imgLoad($this->_inPath)
							->createThumb($this->_outPath,0,0);
						}
						$this->clear();
					}
					return $return;
				}else return false; 
			}else return false;
		}else return false;
	}
	public function rmImg($img=false,$folder='root')
	{
		if($img){
			$date=current(explode("_",$img));
			$sub=date('d-m-Y',$date);
			$path=__IMG.$folder.S.$sub.S.$img;
			$thumbPath=__IMG.'thumb'.S.$folder.S.$sub.S.$img;
			if(file_exists($thumbPath)){
				unlink($thumbPath);
				if(file_exists($path)){
					unlink($path);
					return true;
				}else return false;
			}else{
				if(file_exists($path)){
					unlink($path);
					return true;
				}else return false;
			} 
		}else return false;
	}
	public function save_image($url=false)
	{
		if($url){
		    $in=fopen($url, "rb");
		    $folder=$this->mkFolder(date('d-m-Y'));
		    $_filename=$this->getname();
			$this->_inPath=$folder->dir.$_filename;
			$this->_outPath=$folder->thumb.$_filename;
		    $real_out=fopen($this->_inPath, "wb");
		    while ($chunk = fread($in,8192))
		    {
		        fwrite($real_out, $chunk, 8192);
		    }
		    copy($this->_inPath,$this->_outPath);
		    fclose($in);
		    fclose($real_out);
		    if(file_exists($this->_outPath)){
		    	return $_filename;
		    }else return null;
		}else return null;
	}
}
