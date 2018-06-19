<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="col-11 right-content">
    	<div class="container-fluid blog-content">
    		<ol class="breadcrumb">
			  	<li class="breadcrumb-item"><a href="<?=_URL?>dashboard/">Smcta</a></li>
			  	<li class="breadcrumb-item"><a href="<?=_URL.'dashboard/articles'?>">Articles</a></li>
			  	<li class="breadcrumb-item active">Articles manager</li>
			</ol>
    		<h3 class="page-title">Articles manager<small>You can edit all functions on articles page.</small></h3> 	
			<div class="card blog-form">
			  	<div class="card-body card-table-header with-border">	  			
		  			<div class="row">
				    	<div class="col-6">
				    		<h3 class='card-title' data-target="#blog-list">Articles list
				    			<i class="la la-trash pull-right bg-danger text-white multi-del-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to delete selected articles'></i>
				    			<i class="la la-unlock pull-right bg-warning text-white multi-lock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to lock selected articles'></i>	
				    			<i class="la la-unlock-alt pull-right bg-info text-white multi-unlock-btn" data-toggle='tooltip' data-placement='left' data-original-title='Click to unlock selected articles'></i></h3>
				    	</div>
				    	<div class="col-6">
				    		<div class="form-group">
							    <input type="search" class="form-control input-field" id="search-sender" placeholder="Key title for search">
						  	</div>
				    	</div>
				    </div>			  			
			  	</div>
			  	<div class="card-body card-content blog with-border">
			  		<div class="container-fluid">
			  			<div class="row">
				    		<div class="col-9">
				    			<div class="card blog-form">
								  	<div class="card-body table-view">
								  		<table id="blog-list" class="table table-hover table-bordered">
								  			<thead>
											    <tr>
											      <th width="45%"><div class="checkbox" data-toggle='tooltip' data-placement='top' data-original-title='Click to check all newbikes'><input type="checkbox" data-target="#blog-list" class="check-all"><label></label></div>Title <small>Image</small></th>
											      <th width="45%">Content</th>
											      <th width="10%">Modified<br><small>Created</small></th>
											    </tr>
										  	</thead>
								  		</table>
								  	</div>
								</div>
				    		</div>				    		
				    		<div class="col-3">
				    			<div class="card search-form">
				    				<?= form_open_multipart($blog_action,$blog_id); ?>
								  	<div class="card-body">
									    <h4 class="card-title">New article</h4>
									    <div class="row">
									    	<div class="col-12">
									    		<div style="background:url(<?=$this->module('image')->folder('blog')->getThumb()?>)" class='img-view' data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">
										      		<input type="file" name="image" class="update-directory-img" data-responsive=".img-view"/>
										      	</div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <input type="text" class="form-control input-field name-field" name="title" placeholder="Input title">
			                                    </div>
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col-12">
									    		<div class="form-group">
			                                        <textarea class="form-control input-field input-content" rows="5" name="content" placeholder="Input content" id="content"></textarea>
			                                    </div>
									    	</div>
									    </div>
								    	<button type="button" class="btn btn-save btn-new-article">Save</button>
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