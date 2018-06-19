<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $error=$this->session->flashdata('error');if(!empty($error)){echo '<div class="alert alert-danger notify container" role="alert" style="display:block">'.$error.'</div>';}?>
<?php $error=validation_errors();if(!empty($error)){ echo '<div class="alert alert-danger notify container" role="alert" style="display:block">'.$error.'</div>';}?>
<section id="login-content" class="container">
	<div class="login-panel">
		<div class="row">
			<div class="col-sm-6">
				<div class="block block-login" style="margin-top: 50px;margin-bottom: 50px;">
					<h3 class="block-title"><a href="javascript:;">Login</a></h3>
					<?= form_open('',$attributes); ?>
						<div class="block-content">
							<div class="col-sm-12">
								<div class="form-group floating-label">
					                <input type="text" class="form-control" id="your_name" name="identity">
					                <label for="your_name">Your e-mail</label>
				              	</div>
				            </div>
							<div class="col-sm-12">
								<div class="form-group floating-label">
					                <input type="hidden" id="your_pass" name="password">
					                <input type="password" class="form-control" id="password" autocomplete="new-password">
					                <label for="your_pass">Your password</label>
				              	</div>
							</div>
							<div class="row">
								<div class="col-sm-5 text-left">
				                  <div class="form-check">
								    <input type="checkbox" class="form-check-input" id="exampleCheck1">
								    <label class="form-check-label" for="exampleCheck1">Check me out</label>
								  </div>
				                </div>
								<div class="col-sm-7 text-right">
									<button class="btn btn-primary-light btn-raised pull-right"><i class="la la-paper-plane"></i> LOGIN</button>
				                </div>
							</div>
						</div>
					</form>
				</div>
          	</div>
			<div class="col-sm-6">
				<div class="block block-login">
					<div class="block-content">
						<h3 class="text-light text-center">
							No account yet?
						</h3>
						<div class="col-sm-12">
							<a class="btn btn-teal btn-raised btn-block" href="<?=_URL?>register"><i class="la la-user"></i> REGISTER</a>
			            </div>
			            <h3 class='text-center'>Or</h3>
						<div class="col-sm-12">
							<a class="btn btn-info btn-raised btn-block" href="javascript:;" onclick="fbLogin()"><i class="la la-facebook-f"></i> Continue with Facebook</a>
						</div>							
					</div>
				</div>
          	</div>
		</div>
	</div>
</section>
<script>
var _URL='http://'+window.location.hostname+'/';
window.fbAsyncInit = function() {
FB.init({
  appId      : '347027202455864',//849962215189899',
  xfbml      : true,
  version    : 'v2.12'
});
FB.AppEvents.logPageView();
};
(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "https://connect.facebook.net/en_US/sdk.js";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
function fbLogin() {
	FB.login(function(response) {
	  if (response.status === 'connected') {
	    getFbUserData();
	  } else {
	    console.log('User cancelled login or did not fully authorize.');
	  }
	},{scope: 'public_profile,email'});
}
function getFbUserData(){
	FB.api('/me', function(response) {
      	$.post(_URL+'checkUser',{data:response},function (data) {
    		if(data){
				location.href=data;
    		}else{
      			location.reload();
    		}
    	},'json');
    });
}
</script>