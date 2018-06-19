<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid message-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/message'?>">Message</a></li>
			  	<li class="breadcrumb-item active">Message manager</li>
			</ol>
    		<h3 class="page-title">Message manager<small>You can edit all functions on message page.</small></h3>
			<div class="card message-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Message list</h3>
		  			<button class='btn pull-right btn-green btn-message-new' data-toggle="tooltip" data-placement="left" data-original-title="Click to add new message"><i class="fa fa-plus"></i></button>				  			
			  	</div>
			  	<div class="card-body card-content message with-border">
			  		<div class="container-fluid">
			  			<div class="row">
			  			  <?php foreach($message as $message):?>
				  			<div class="col-3">
			  				  <?= form_open_multipart($message_action,array('id'=>'message-'.$message->id)); ?>
								<div class="card message-form">
								  	<div class="card-header with-border">							  		
							  			<h4 class='card-title'><?=$this->module('text')->cut($message->name)?></h4>
							  			<button class='btn pull-right btn-green btn-edit-message' type='button' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit this message"><i class="fa fa-send"></i></button>			  			
							  			<button class='btn pull-right btn-primary btn-del-message' type='button' data-id='<?=$message->id?>' data-toggle="tooltip" data-placement="left" data-original-title="Click to delete this message"><i class="fa fa-trash"></i></button>	
								  	</div>	
								  	<div class="card-body with-border">
									  	<div style="background:url(<?=$this->module('image')->img($message->image)->folder('people')->getThumb()?>)" class='img-view img-view-<?=$message->id?>' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
								      		<input type="file" name="img-<?=$message->id?>" class="update-person-img" data-responsive=".img-view-<?=$message->id?>"/>
								      	</div>
								  		<div class="form-group">
										    <input type="hidden" name='id' value="<?=$message->id?>">
										    <label for="Company-name">Name</label>
										    <input type="text" class="form-control required" name='name' id="message-<?=$message->id?>-name" placeholder="Input name" value="<?=$message->name?>">
									  	</div>
								  		<div class="form-group">
										    <label for="">Appointment</label>
										    <input type="text" class="form-control required" name='appointment' id="message-<?=$message->id?>-appointment" placeholder="Input appointment" value="<?=$message->appointment?>">
									  	</div>
									  	<div class='row'>
									  		<div class="form-group col-8">
											    <input type="hidden" name='id' value="<?=$message->id?>">
											    <label for="Company-name">Tel number</label>
											    <input type="text" class="form-control required" name='telno' id="message-<?=$message->id?>-telno" placeholder="Input tel .no" value="<?=$message->telno?>">
										  	</div>	
									  		<div class="form-group col-4">
											    <input type="hidden" name='id' value="<?=$message->id?>">
											    <label for="Company-name">Sort</label>
											    <input type="text" class="form-control text-right required" name='sorted' id="message-<?=$message->id?>-sorted" placeholder="Input sortting" value="<?=$message->sorted?>">
										  	</div>	
									  	</div>
								  		<div class="form-group">
										    <label for="Company-name">Description</label>
										  	<textarea class="form-control message-description required" rows='3' name='description' id="message-<?=$message->id?>-description"><?=$message->description?></textarea>		
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