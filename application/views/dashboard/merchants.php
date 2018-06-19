<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid executive-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/merchants'?>">Directory</a></li>
			  	<li class="breadcrumb-item active">Directory manager</li>
			</ol>
    		<h3 class="page-title">Directory manager<small>You can edit all functions on directory page.</small></h3> 	
			<div class="card executive-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#executive-list">Directory list	
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected directory'></i>	
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected directory'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected directory'></i>
				    			<i class="la la-user-plus pull-right bg-success text-white dealer-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to take dealer'></i>
				    			<i class="la la-thumbs-o-up pull-right bg-primary text-white featured-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to feature selected directory'></i>
				    		</h3>
				    	</div>
				    	<div class="col-6">
				    		<div class="form-group">
							    <input type="search" class="form-control input-field" id="search-sender" placeholder="Key company's name or email or address for search">
						  	</div>
				    	</div>
				    </div>			  			
			  	</div>
			  	<div class="card-body card-content executive with-border">
			  		<div class="container-fluid">
			  			<div class="row">
				    		<div class="col-12">
				    			<div class="card executive-form">
								  	<div class="card-body table-view">
								  		<table id="executive-list" class="table table-hover table-bordered">
								  			<thead>
											    <tr>
											      <th width="40%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to check all merchants'><input type="checkbox" data-target="#executive-list" class="check-all"><label></label></div>Company's Name<small><br>Address</small></th>
											      <th width="25%">Working time<small><br>Description</small></th>
											      <th width="15%">Website<small><br>Email</small></th>
											      <th width="10%">Tel. No<small><br>Fax</small></th>
											      <th width="10%">Modified<small><br>Created</small></th>
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
<div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="category-Label" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h2 class="modal-title" id="category-Label">Category list</h2>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true"><i class="fa fa-close"></i></span>
		        </button>
	      	</div>
	      	<div class="modal-body">
		        <div class="row justify-content-md-center list"></div>
	      	</div>
	      	<div class="modal-footer">
	    		<select class="form-control choose-type" id="category-list" onchange="this.className='form-control choose-type selected'">
			      	<option hidden>Choose category</option>
			      	<?php foreach($categories as $cate):?>
			      	<option value="<?=$cate->id?>"><?=$cate->name?></option>
			      	<?php endforeach;?>
			    </select>
	        	<button type="button" class="btn btn-add btn-add-category pull-right">Add</button>
	        	<button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
	      	</div>
	    </div>
  	</div>
</div>
<div class="modal fade" id="location-modal" tabindex="-1" role="dialog" aria-labelledby="Location-Label" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h2 class="modal-title" id="Location-Label">Location list</h2>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true"><i class="fa fa-close"></i></span>
		        </button>
	      	</div>
	      	<div class="modal-body">
		        <div class="row justify-content-md-center list"></div>
	      	</div>
	      	<div class="modal-footer">
	    		<select class="form-control choose-type" id="location-list" onchange="this.className='form-control choose-type selected'">
			      	<option hidden>Choose location</option>
			      	<?php foreach($locations as $location):?>
			      	<option value="<?=$location->id?>"><?=$location->name?></option>
			      	<?php endforeach;?>
			    </select>
	        	<button type="button" class="btn btn-add btn-add-location pull-right">Add</button>
	        	<button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
	      	</div>
	    </div>
  	</div>
</div>