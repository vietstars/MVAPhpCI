<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid executive-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/member'?>">Member Listing</a></li>
			  	<li class="breadcrumb-item active">Member listing manager</li>
			</ol>
    		<h3 class="page-title">Member listing manager<small>You can edit all functions on member listing page.</small></h3> 	
			<div class="card executive-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#executive-list">Member listing	
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected members'></i>	
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected members'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected members'></i></h3>
				    	</div>
				    	<div class="col-6">
				    		<div class="form-group">
							    <input type="search" class="form-control input-field" id="search-sender" placeholder="Key company's name or email for search">
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
											      <th width="30%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to all members'><input type="checkbox" data-target="#executive-list" class="check-all"><label></label></div>Company's Name</th>
											      <th width="30%">Address</th>
											      <th width="20%">Email</th>
											      <th width="10%">Tel/ <small>Fax</small></th>
											      <th width="10%">Sort</th>
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
									    <h4 class="card-title">New member</h4>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
									    			<label for="company" class='pull-right'><small>(Key </small><small class='text-danger'>branch</small><small> if this is a branch)</small></label>
			                                        <input type="text" class="form-control input-field" name="company" placeholder="Input company name">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
									    			<label for="company" class='pull-right'><small>(Key </small><small class='text-danger'>&#60;b&#62;title&#60;/b&#62;&#60;br&#62; </small><small>if you want to have branch title)</small></label>
			                                        <input type="text" class="form-control input-field" name="name" placeholder="Input address">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="appointment" placeholder="Input email">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="telno" placeholder="Input phone">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="fax" placeholder="Input fax">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
									    			<label for="company" class='pull-right'><small>(Key </small><small class='text-danger'>branch sort number </small><small>same head office sort number)</small></label>
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