<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid executive-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/executive'?>">Executive committee</a></li>
			  	<li class="breadcrumb-item active">Executive committee manager</li>
			</ol>
    		<h3 class="page-title">Executive committee manager<small>You can edit all functions on Executive committee page.</small></h3> 	
			<div class="card executive-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#executive-list">Executive committee	
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected executive'></i>	
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected executive'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected executive'></i></h3>
				    	</div>
				    	<div class="col-6">
				    		<div class="form-group">
							    <input type="search" class="form-control input-field" id="search-sender" placeholder="Key member's name or executive's name for search">
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
											      <th width="35%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to check all executive'><input type="checkbox" data-target="#executive-list" class="check-all"><label></label></div>Member's name</th>
											      <th width="20%">Name</th>
											      <th width="15%">Appointment</th>
											      <th width="10%">Tel. no</th>
											      <th width="10%">Sort</th>
											      <th width="10%">Created</th>
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
									    <h4 class="card-title">New executive</h4>
									    <div class="row">
									    	<div class="col-12">
											    <div class="form-group">
			                                        <input type="text" class="form-control input-field" name="company" placeholder="Input member's name">
			                                    </div>
									    	</div>
									    </div>
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
			                                        <input type="text" class="form-control input-field" name="appointment" placeholder="Input appointment">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="telno" placeholder="Input tel. No">
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
								    	<button type="button" class="btn btn-save btn-new-member">Save</button>
								  	</div>
								  	</form>
								</div>
				    		</div>
				    	</div>	
					</div>			  			
			  	</div>
			</div> 	
			<div class="card executive-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#patron-list">Patron & Trustees
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected members'></i>	
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected members'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected members'></i></h3>
				    	</div>
				    	<div class="col-6">
				    		<div class="form-group">
							    <input type="search" class="form-control input-field" id="search-patron" placeholder="Key member's name for search">
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
								  		<table id="patron-list" class="table table-hover table-bordered">
								  			<thead>
											    <tr>
											      <th width="50%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to all members'><input type="checkbox" data-target="#patron-list" class="check-all"><label></label></div>Name</th>
											      <th width="20%">Designation</th>
											      <th width="10%">Tel. no</th>
											      <th width="10%">Sort</th>
											      <th width="10%">Created</th>
											    </tr>
										  	</thead>
								  		</table>
								  	</div>
								</div>
				    		</div>
				    		<div class="col-3">
				    			<div class="card search-form">
				    				<?= form_open($patron_action,$patron_id); ?>
								  	<div class="card-body">
									    <h4 class="card-title">New Patron/ Trustees</h4>
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
			                                        <select class="form-control choose-type" id="designation" name="appointment" onchange="this.className='form-control choose-type selected'">
												      	<option value="null" hidden="">Choose designation</option>
												      	<option value="Board of trustees">Board of trustees</option>
												      	<option value="Patron">Patron</option>
												    </select>
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="telno" placeholder="Input tel. No">
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
								    	<button type="button" class="btn btn-save btn-new-patron">Save</button>
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