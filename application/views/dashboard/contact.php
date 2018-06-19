<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid executive-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/member'?>">Contact </a></li>
			  	<li class="breadcrumb-item active">Contact manager</li>
			</ol>
    		<h3 class="page-title">Contact manager<small>You can edit all functions on contact page.</small></h3> 	
			<div class="card executive-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#executive-list">Contact 
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected contact'></i>
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
				    		<div class="col-3">
				    			<div class="card search-form">
				    				<?= form_open($contact_action,$contact_id); ?>
								  	<div class="card-body">
									    <h4 class="card-title">Contact profile</h4>
									    <?php foreach($contac_info as $info):?>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field" name="<?=$info->sys_key?>" placeholder="Input <?=str_replace('ct_','',$info->sys_key)?>" value="<?=$info->sys_value?>">
			                                    </div>
									    	</div>
									    </div>
										<?php endforeach;?>
								    	<button type="button" class="btn btn-save btn-update-contact">Save</button>
								  	</div>
								  	</form>
								</div>
				    		</div>
				    		<div class="col-9">
				    			<div class="card executive-form">
								  	<div class="card-body table-view">
								  		<table id="executive-list" class="table table-hover table-bordered">
								  			<thead>
											    <tr>
											      <th width="20%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to all members'><input type="checkbox" data-target="#executive-list" class="check-all"><label></label></div>Name</th>
											      <th width="20%">Email</th>
											      <th width="50%">Message</th>
											      <th width="10%">Created</th>
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