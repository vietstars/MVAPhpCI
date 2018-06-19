<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid executive-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/event'?>">Event activities</a></li>
			  	<li class="breadcrumb-item active">Event activities manager</li>
			</ol>
    		<h3 class="page-title">Event activities manager<small>You can edit all functions on event activities page.</small></h3> 	
			<div class="card executive-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#executive-list">Event activities	
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected event'></i>	
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected event'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected event'></i></h3>
				    	</div>
				    	<div class="col-6">
				    		<div class="form-group">
							    <input type="search" class="form-control input-field" id="search-sender" placeholder="Key description for search">
						  	</div>
				    	</div>
				    </div>			  			
			  	</div>
			  	<div class="card-body card-content executive with-border">
			  		<div class="container-fluid">
			  			<div class="row">
				    		<div class="col-9">
				    			<div class="card executive-form">
								  	<div class="card-body table-view">
								  		<table id="executive-list" class="table table-hover table-bordered">
								  			<thead>
											    <tr>
											      <th width="25%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to check all event'><input type="checkbox" data-target="#executive-list" class="check-all"><label></label></div>Name</th>
											      <th width="55%">Description</th>
											      <th width="10%">Sort</th>
											      <th width="10%">Date</th>
											    </tr>
										  	</thead>
								  		</table>
								  	</div>
								</div>
				    		</div>
				    		<div class="col-3">
				    			<div class="card search-form">
				    				<?= form_open($executive_action,$executive_id); ?>
								  	<div class="card-body">
									    <h4 class="card-title">Event activities</h4>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="name" placeholder="Input name">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <textarea class="form-control event-description input-field required" rows="5" name="description" placeholder="Input description" id="event-description"></textarea>
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field new-event-date" name="created" placeholder="Input date">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="sorted" placeholder="Input sort (blank for auto increment)">
			                                    </div>
									    	</div>
									    </div>
								    	<button type="button" class="btn btn-save btn-new-event">Save</button>
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