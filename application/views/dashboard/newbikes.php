<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid newbike-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/newbikes'?>">Newbikes</a></li>
			  	<li class="breadcrumb-item active">Newbikes manager</li>
			</ol>
    		<h3 class="page-title">Newbikes manager<small>You can edit all functions on newbikes page.</small></h3> 	
			<div class="card newbike-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#newbike-list">Newbikes list	
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected newbike'></i>	
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected newbike'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected newbike'></i></h3>
				    	</div>
				    	<div class="col-6">
				    		<div class="form-group">
							    <input type="search" class="form-control input-field" id="search-sender" placeholder="Key make or model for search">
						  	</div>
				    	</div>
				    </div>			  			
			  	</div>
			  	<div class="card-body card-content newbike with-border">
			  		<div class="container-fluid">
			  			<div class="row">
				    		<div class="col-9">
				    			<div class="card newbike-form">
								  	<div class="card-body table-view">
								  		<table id="newbike-list" class="table table-hover table-bordered">
								  			<thead>
											    <tr>
											      <th width="35%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to check all newbikes'><input type="checkbox" data-target="#newbike-list" class="check-all"><label></label></div>Bike's full name<br><small>Make - model</small></th>
											      <th width="20%">Type - class<br><small>Builtin - Release year</small></th>
											      <th width="25%">Video path</th>
											      <th width="10%">Min price<br><small>max price</small></th>
											      <th width="10%">Modified<br><small>Created</small></th>
											    </tr>
										  	</thead>
								  		</table>
								  	</div>
								</div>
				    		</div>
				    		<div class="col-3">
				    			<div class="card search-form">
				    				<?= form_open_multipart($bike_action,$bike_id); ?>
								  	<div class="card-body">
									    <h4 class="card-title">New bike</h4>
									    <div class="row">
									    	<div class="col-12">
									    		<div style="background:url(<?=$this->module('image')->folder('bike')->getThumb()?>)" class='img-view' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
										      		<input type="file" name="image[]" class="update-directory-img" data-responsive=".img-view"  multiple/>
										      	</div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="hidden" class="fullname-field" name="fullname">
			                                        <input type="text" class="form-control input-field name-field" name="name" placeholder="Input Model">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group floating-label">
													<select class="form-control choose-type choose-make" name="make_id" data-target='.fullname-field' data-check='.name-field'>
								                        <option value="" hidden>Choose make</option>
								                       <?php foreach($make as $mk):?>
								                       <option value="<?=$mk->id?>"><?=$mk->name?></option>
								                       <?php endforeach;?>
								                    </select>
								              	</div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group floating-label">
													<select class="form-control choose-type" name="type_id">
								                        <option value="" hidden>Choose type</option>
								                       <?php foreach($type as $tp):?>
								                       <option value="<?=$tp->id?>"><?=$tp->name?></option>
								                       <?php endforeach;?>
								                    </select>
								              	</div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group floating-label">
													<select class="form-control choose-type" name="class_id">
								                        <option value="" hidden>Choose class</option>
								                       <?php foreach($class as $cl):?>
								                       <option value="<?=$cl->id?>"><?=$cl->name?></option>
								                       <?php endforeach;?>
								                    </select>
								              	</div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group floating-label">
													<select class="form-control choose-type" name="builtin">
								                        <option value="" hidden>Choose buitlin</option>
								                       <?php foreach($builtin as $nation):?>
								                       <option value="<?=$nation->id?>"><?=$nation->name?></option>
								                       <?php endforeach;?>
								                    </select>
								              	</div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="release_year" placeholder="Input release year">
			                                    </div>
									    	</div>
									    </div>
									    <!-- <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="pdf_url" placeholder="Input pdf path">
			                                    </div>
									    	</div>
									    </div> -->
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="video_url" placeholder="Input video path">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <textarea class="form-control input-field required" rows="5" name="description" placeholder="Input description" id="description"></textarea>
			                                    </div>
									    	</div>
									    </div>
								    	<button type="button" class="btn btn-save btn-new-bike">Save</button>
								  	</div>
								  	</form>
								</div>
				    		</div>
				    	</div>	
					</div>			  			
			  	</div>
			</div>					
    	</div>
    </div>
</section>
<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="image-Label" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h2 class="modal-title" id="image-Label">Images</h2>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true"><i class="fa fa-close"></i></span>
		        </button>
	      	</div>
	      	<div class="modal-body">
		        <div class="row justify-content-md-center list"></div>
	      	</div>
	      	<div class="modal-footer">	    		
	        	<button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
	      	</div>
	    </div>
  	</div>
</div>