;(function ($, window, undefined) { 
    $(document).ready(function () {
        /******** form ***********/       
        $(document).on('submit','#login-form',function (e) {
            var _identity=$(this).find('input[type="text"]');
            var _password=$(this).find('input[type="password"]');
            var _val=_password.val();
            if(_identity.val()==''||_password.val()==''){
        		toastr.clear();
           	 	toastr.options.closeButton = true;
           	 	toastr.options.positionClass='toast-top-right';
            	toastr.error('Please complete all fields!');
        		e.preventDefault();
            }else{
                $(this).find('input[type="hidden"]').val(md5(_val));
            }
        })
        /*************************/
    })
})(jQuery, window);