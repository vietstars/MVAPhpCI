<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid home-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/home'?>">Home</a></li>
			  	<li class="breadcrumb-item active">Homepage manager</li>
			</ol>
    		<h3 class="page-title">Homepage manager<small>You can edit all functions on homepage.</small></h3>
	    	<div class="card home-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Top left introduce</h3>
		  			<button class='btn pull-right btn-green btn-top-left-editor' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit form"><i class="fa fa-send"></i></button>			  			
			  	</div>
			  	<div class="card-body card-content with-border">
			  		<?= form_open_multipart($tl_action,$tl_attributes); ?>
		  			<div class="container-fluid">
			  			<div class="row">
						    <div class="col-2">
						    	<div class="home-logo">
							      	<div class='tl-persion-image' style="background:url('<?=$this->module('image')->img($top_left->image)->folder('people')->getThumb()?>')" alt="chairman"></div>
							      	<button class="btn btn-add-logo"> Change Image
							      		<input type="file" name="person-img" class="update-img" data-responsive=".tl-persion-image">
							      	</button>
						    	</div>							    	
						    </div>
						    <div class="col-10">
						    	<div class="row">
								    <div class="col-6">
										<div class="form-group">
										    <label for="Company-name">Name</label>
										    <input type="text" class="form-control company-name required" name='name' id="tl-person-name" placeholder="Input Name" value="<?=$top_left->name?>">
									  	</div>
								    </div>
								    <div class="col-6">							    	
										<div class="form-group">
										    <label for="appointment">Appointment</label>
										    <input type="text" class="form-control required" id="tl-appointment" name='appointment' placeholder="Input Appointment" value="<?=$top_left->appointment?>">
									  	</div>	
								    </div>	
						    	</div>
						    	<div class="row">
								    <div class="col-12">						    	
										<div class="form-group">
										    <label for="url">Title</label>
										    <input type="text" class="form-control required" id="tl-title" name='title' placeholder="Input Title" value="<?=$top_left->title?>">
									  	</div>
								  	</div>
								    <div class="col-12">						    	
										<div class="form-group">
										    <label for="url">Content</label>
										    <textarea class="form-control content-form" id="tl-content" name='content' placeholder="Input Content" rows="5"><?=$top_left->content?></textarea>
									  	</div>
								  	</div>
								</div>
						    </div>
			  			</div>				  			
			  		</div>
			  		</form>
			  	</div>
			</div>
			<div class="card home-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Smcta timeline</h3>
		  			<button class='btn pull-right btn-green btn-timeline-new' data-toggle="tooltip" data-placement="left" data-original-title="Click to add new timeline"><i class="fa fa-plus"></i></button>				  			
			  	</div>
			  	<div class="card-body card-content timeline with-border">
			  		<div class="container-fluid">
			  			<div class="row">
			  			  <?php foreach($timeline as $note):?>
				  			<div class="col-3">
			  				  <?= form_open($timeline_action,array('id'=>'timeline-'.$note->id)); ?>
								<div class="card ipaddress-form">
								  	<div class="card-header with-border">							  		
							  			<h3 class='card-title'><?=$note->created?></h3>
							  			<button class='btn pull-right btn-green btn-edit-timeline' type='button' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit this timeline"><i class="fa fa-send"></i></button>			  			
							  			<button class='btn pull-right btn-primary btn-del-timeline' type='button' data-id='<?=$note->id?>' data-toggle="tooltip" data-placement="left" data-original-title="Click to delete this timeline"><i class="fa fa-trash"></i></button>	
								  	</div>	
								  	<div class="card-body with-border">
								  		<div class="form-group date-form">
										    <label for="Company-name">Date</label>
										    <input type="text" class="form-control date-timeline" name='created' id="timeline-<?=$note->id?>-date" placeholder="Date" value="<?=$note->created?>">
										    <i class="la la-calendar la-2x"></i>
									  	</div>
								  		<div class="form-group">
										    <label for="Company-name">Title</label>
										    <input type="hidden" name='id' value="<?=$note->id?>">
										    <input type="text" class="form-control required" name='title' id="timeline-<?=$note->id?>-title" placeholder="Input title" value="<?=$note->title?>">
									  	</div>	
								  		<div class="form-group">
										    <label for="Company-name">Content</label>
										  	<textarea class="form-control timeline-content required" rows='5' name='content' id="timeline-<?=$note->id?>-title"><?=$note->content?></textarea>		
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
			<div class="card home-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Link page image</h3>	
		  			<button class='btn pull-right btn-green btn-image-link-editor' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit form"><i class="fa fa-send"></i></button>			  			
			  	</div>
			  	<div class="card-body card-content Image-uploaded with-border">
					<div class="container-fluid">
		  				<?= form_open_multipart($il_action,$il_attributes); ?>
			  			<div class="row">
			  				<?php foreach($img_links as $img_link):?>
						    <div class="col-4">
						    	<div class="img-uploaded">
						    		<div class="form-group">
									    <label for="Company-name">Title</label>
									    <input type="text" class="form-control company-name required" name='<?=$img_link->id?>[title]' id="event-title" placeholder="Input Title" value="<?=$img_link->title?>">
								  	</div>
						    		<div class="form-group">
									    <label for="Company-name">URL</label>
									    <input type="text" class="form-control required" name='<?=$img_link->id?>[position]' id="event-url" placeholder="Input URL" value="<?=$img_link->position?>">
								  	</div>
							      	<div style="background:url(<?=$this->module('image')->img($img_link->image)->folder('system')->getThumb()?>)" class='img-view img-view-<?=$img_link->id?>' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
							      		<input type="file" name="img-<?=$img_link->id?>" class="update-img-link" data-responsive=".img-view-<?=$img_link->id?>"/>
							      	</div>
						    	</div>							    	
						    </div>
			  				<?php endforeach;?>						    
			  			</div>				  			
						</form>
			  		</div>
			  	</div>
			</div>
			<div class="card home-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Bottom content</h3>
		  			<button class='btn pull-right btn-green btn-bot-content-editor' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit form"><i class="fa fa-send"></i></button>			  			
			  	</div>
			  	<div class="card-body card-content with-border">
			  		<?= form_open_multipart($bc_action,$bc_attributes); ?>
		  			<div class="container-fluid">
			  			<div class="row">
						    <div class="col-2">
						    	<div class="home-logo">
							      	<div class='bc-persion-image' style="background:url('<?=$this->module('image')->img($bot_content->image)->folder('people')->getThumb()?>')" alt="chairman"></div>
							      	<button class="btn btn-add-logo"> Change Image
							      		<input type="file" name="person-img" class="update-img" data-responsive=".bc-persion-image">
							      	</button>
						    	</div>							    	
						    </div>
						    <div class="col-10">
						    	<div class="row">
								    <div class="col-6">
										<div class="form-group">
										    <label for="Company-name">Name</label>
										    <input type="text" class="form-control company-name required" name='name' id="bc-person-name" placeholder="Input Name" value="<?=$bot_content->name?>">
									  	</div>
								    </div>
								    <div class="col-6">							    	
										<div class="form-group">
										    <label for="appointment">Appointment</label>
										    <input type="text" class="form-control required" id="bc-appointment" name='appointment' placeholder="Input Appointment" value="<?=$bot_content->appointment?>">
									  	</div>	
								    </div>	
						    	</div>
						    	<div class="row">
								    <div class="col-12">						    	
										<div class="form-group">
										    <label for="url">Title</label>
										    <input type="text" class="form-control required" id="bc-title" name='title' placeholder="Input Title" value="<?=$bot_content->title?>">
									  	</div>
								  	</div>
								    <div class="col-12">						    	
										<div class="form-group">
										    <label for="url">Content</label>
										    <textarea class="form-control content-form" id="bc-content" name='content' placeholder="Input Content" rows="5"><?=$bot_content->content?></textarea>
									  	</div>
								  	</div>
								</div>
						    </div>
			  			</div>				  			
			  		</div>
			  		</form>
			  	</div>
			</div>
			<div class="card home-form">
			  	<div class="card-body with-border">
		  			<h3 class='card-title'>Association link</h3>	
		  			<button class='btn pull-right btn-green btn-association-link-editor' data-toggle="tooltip" data-placement="left" data-original-title="Click to submit form"><i class="fa fa-send"></i></button>			  			
			  	</div>
			  	<div class="card-body card-content Image-uploaded with-border">
					<div class="container-fluid">
		  				<?= form_open_multipart($al_action,$al_attributes); ?>
			  			<div class="row">
			  				<?php foreach($al_links as $al_link):?>
						    <div class="col-4">
						    	<div class="img-uploaded">
						    		<div class="form-group">
									    <label for="Company-name">Title</label>
									    <input type="text" class="form-control company-name required" name='<?=$al_link->id?>[title]' id="event-title" placeholder="Input Title" value="<?=$al_link->title?>">
								  	</div>
						    		<div class="form-group">
									    <label for="Company-name">URL</label>
									    <input type="text" class="form-control required" name='<?=$al_link->id?>[position]' id="event-url" placeholder="Input URL" value="<?=$al_link->position?>">
								  	</div>
							      	<div style="background:url(<?=$this->module('image')->img($al_link->image)->folder('system')->getThumb()?>)" class='img-view img-view-<?=$al_link->id?>' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
							      		<input type="file" name="img-<?=$al_link->id?>" class="update-img-link" data-responsive=".img-view-<?=$al_link->id?>"/>
							      	</div>
						    	</div>							    	
						    </div>
			  				<?php endforeach;?>						    
			  			</div>				  			
						</form>
			  		</div>
			  	</div>
			</div>		
    	</div>
    </div>
</section>