<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid executive-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/user'?>">User</a></li>
			  	<li class="breadcrumb-item active">User manager</li>
			</ol>
    		<h3 class="page-title">User manager<small>You can edit all functions on user page.</small></h3> 	
			<div class="card executive-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#executive-list">User list 
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected user'></i>	
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected user'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected user'></i></h3>
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
											      <th width="40%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to all user'><input type="checkbox" data-target="#executive-list" class="check-all"><label></label></div>Display name <small>[Gender] /Email</small></th>
											      <th width="30%">Phone/ <small>Address</small></th>
											      <th width="15%">Birthday/ <small>Join date</small></th>
											      <th width="15%">Visited</th>
											    </tr>
										  	</thead>
								  		</table>
								  	</div>
								</div>
				    		</div>
				    		<div class="col-3">
				    			<div class="card search-form">
				    				<?= form_open_multipart($user_action,$user_id); ?>
								  	<div class="card-body">
									    <h4 class="card-title">New user</h4>
									    <div style="background:url(<?=$this->module('image')->img()->folder('people')->get()?>)" class='img-view' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
								      		<input type="file" name="avatar" class="update-person-img" data-responsive=".img-view"/>
								      	</div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="fullname" placeholder="Input fullname">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="hidden" name="password">
			                                        <input type="text" class="form-control input-field" onkeyup='$(this).val!=""?$(this).attr("type","password"):$(this).attr("type","text");' placeholder="Input password">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="email" placeholder="Input email">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <select class="form-control choose-type" name="gender" onchange="this.className='form-control choose-type selected'">
												      	<option value="male">Male</option>
												      	<option value="female">Female</option>
												    </select>
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
									    			<input type="text" class="form-control input-field birthdate" name="birthday" placeholder="Input birthday">
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
									    			<input type="text" class="form-control input-field" name="address" placeholder="Input address">
									    		</div>
									    	</div>
									    </div>
								    	<button type="button" class="btn btn-save btn-new-user">Save</button>
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