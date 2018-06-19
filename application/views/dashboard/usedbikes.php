<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid newbike-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/usedbikes'?>">Usedbikes</a></li>
			  	<li class="breadcrumb-item active">Usedbikes manager</li>
			</ol>
    		<h3 class="page-title">Usedbikes manager<small>You can edit all functions on usedbikes page.</small></h3> 	
			<div class="card newbike-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#newbike-list">Usedbikes list
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected usedbike'></i>
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected usedbike'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected usedbike'></i>
				    			<i class="la la-hand-paper-o pull-right bg-warning text-white multi-sold-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to sold out selected usedbike'></i></h3>
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
				    		<div class="col-12">
				    			<div class="card newbike-form">
								  	<div class="card-body table-view">
								  		<table id="newbike-list" class="table table-hover table-bordered">
								  			<thead>
											    <tr>
											      <th width="30%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to check all newbikes'><input type="checkbox" data-target="#newbike-list" class="check-all"><label></label></div>Bike's name<br><small>Make - model</small></th>
											      <th width="13%">Username - <span class='text-danger'>Price</span><br><small>Dealer</small></th>
											      <th width="13%">Type - class<br><small>Mileage - Capacity</small></th>
											      <th width="22%">Video path</th>
											      <th width="12%">COE expiry<br><small>Registration date</small></th>
											      <th width="10%">Modified<br><small>Created</small></th>
											    </tr>
										  	</thead>
								  		</table>
								  	</div>
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