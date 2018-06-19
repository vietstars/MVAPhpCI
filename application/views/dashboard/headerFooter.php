<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid banner-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/HeaderFooter'?>">Header & Footer</a></li>
			  	<li class="breadcrumb-item active">Header & Footer manager</li>
			</ol>
    		<h3 class="page-title">Header & Footer manager<small>You can edit all functions on header footer.</small></h3>
			<div class="card banner-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Scroller header.</h3>
		  			<button class='btn pull-right btn-green btn-banner-new' data-toggle="tooltip" data-placement="left" data-original-title="Click to add new banner"><i class="fa fa-plus"></i></button>				  			
			  	</div>
			  	<div class="card-body card-content banner with-border">
			  		<div class="container-fluid">
			  			<div class="row">
			  			  <?php foreach($scroller as $banner):?>
				  			<div class="col-3">
			  				  <?= form_open_multipart($scroller_action,array('id'=>'banner-'.$banner->id)); ?>
								<div class="card banner-form">
								  	<div class="card-header with-border">							  		
							  			<button class='btn pull-right btn-green btn-edit-banner' type='button' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit this banner"><i class="fa fa-send"></i></button>			  			
							  			<button class='btn pull-right btn-primary btn-del-banner' type='button' data-id='<?=$banner->id?>' data-toggle="tooltip" data-placement="left" data-original-title="Click to delete this banner"><i class="fa fa-trash"></i></button>
								  	</div>	
								  	<div class="card-body with-border">
								  		<label for="Company-name"><small>Resize your banner to </small><small class='text-danger'>1903x335</small><small> first or system auto crop to this dimension</small></label>
									  	<div style="background:url(<?=$this->module('image')->img($banner->image)->folder('banner')->getThumb()?>)" class='img-view img-view-<?=$banner->id?>' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
								      		<input type="file" name="img-<?=$banner->id?>" class="update-person-img" data-responsive=".img-view-<?=$banner->id?>"/>
								      	</div>
								  		<div class="form-group">
										    <label for="Company-name">Description</label>
										  	<textarea class="form-control banner-description required" rows='3' name='description' id="banner-<?=$banner->id?>-description"><?=$banner->description?></textarea>		
									  	</div>			  			
									  	<div class='row'>	
									  		<div class="form-group col-12">
											    <input type="hidden" name='id' value="<?=$banner->id?>">
											    <label for="Company-name">Sort</label>
											    <input type="text" class="form-control text-right required" name='sorted' id="banner-<?=$banner->id?>-sorted" placeholder="Input sortting" value="<?=$banner->sorted?>">
										  	</div>	
									  	</div>
								  	</div>	
							  	</div>
							  </form>
							</div>
						  <?php endforeach;?>
						</div>	
					</div>			  			
			  	</div>
			</div>					
    	</div>
    </div>
</section>