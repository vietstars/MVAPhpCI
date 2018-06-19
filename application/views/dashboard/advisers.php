<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid advisers-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/advisers'?>">Advisers & consultants</a></li>
			  	<li class="breadcrumb-item active">Advisers & consultants manager</li>
			</ol>
    		<h3 class="page-title">Advisers & consultants manager<small>You can edit all functions on advisers & consultants page.</small></h3>
			<div class="card advisers-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Advisers & consultants list</h3>
		  			<button class='btn pull-right btn-green btn-advisers-new' data-toggle="tooltip" data-placement="left" data-original-title="Click to add new advisers"><i class="fa fa-plus"></i></button>				  			
			  	</div>
			  	<div class="card-body card-content advisers with-border">
			  		<div class="container-fluid">
			  			<div class="row">
			  			  <?php foreach($advisers as $person):?>
				  			<div class="col-3">
			  				  <?= form_open_multipart($advisers_action,array('id'=>'advisers-'.$person->id)); ?>
								<div class="card advisers-form">
								  	<div class="card-header with-border">							  		
							  			<h4 class='card-title'><?=$this->module('text')->cut($person->name)?></h4>
							  			<button class='btn pull-right btn-green btn-edit-advisers' type='button' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit this advisers"><i class="fa fa-send"></i></button>			  			
							  			<button class='btn pull-right btn-primary btn-del-advisers' type='button' data-id='<?=$person->id?>' data-toggle="tooltip" data-placement="left" data-original-title="Click to delete this advisers"><i class="fa fa-trash"></i></button>	
								  	</div>	
								  	<div class="card-body with-border">
									  	<div style="background:url(<?=$this->module('image')->img($person->image)->folder('people')->getThumb()?>)" class='img-view img-view-<?=$person->id?>' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
								      		<input type="file" name="img-<?=$person->id?>" class="update-person-img" data-responsive=".img-view-<?=$person->id?>"/>
								      	</div>
								  		<div class="form-group">
										    <input type="hidden" name='id' value="<?=$person->id?>">
										    <label for="Company-name">Name</label>
										    <input type="text" class="form-control required" name='name' id="advisers-<?=$person->id?>-name" placeholder="Input name" value="<?=$person->name?>">
									  	</div>
								  		<div class="form-group">
										    <label for="">Appointment</label>
										    <input type="text" class="form-control required" name='appointment' id="advisers-<?=$person->id?>-appointment" placeholder="Input appointment" value="<?=$person->appointment?>">
									  	</div>
									  	<div class='row'>
									  		<div class="form-group col-8">
											    <input type="hidden" name='id' value="<?=$person->id?>">
											    <label for="Company-name">Tel number</label>
											    <input type="text" class="form-control required" name='telno' id="advisers-<?=$person->id?>-telno" placeholder="Input tel .no" value="<?=$person->telno?>">
										  	</div>	
									  		<div class="form-group col-4">
											    <input type="hidden" name='id' value="<?=$person->id?>">
											    <label for="Company-name">Sort</label>
											    <input type="text" class="form-control text-right required" name='sorted' id="advisers-<?=$person->id?>-sorted" placeholder="Input sortting" value="<?=$person->sorted?>">
										  	</div>	
									  	</div>
								  		<div class="form-group">
										    <label for="Company-name">Description</label>
										  	<textarea class="form-control advisers-description required" rows='3' name='description' id="advisers-<?=$person->id?>-description"><?=$person->description?></textarea>		
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