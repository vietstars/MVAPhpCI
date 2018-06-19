;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';
        $(".advisers-description").slimScroll({
            width: '100%',
            height: 100,
            railVisible: false,
            alwaysVisible: false,
            color:'#26a69a',
            disableFadeOut: true
        });
        $(document).on('change','input[type=file].update-person-img',function () {
            var _orign=$(this);
            var _responsive=_orign.data('responsive');
            var reader = new FileReader();
            reader.onload = function (e) {
                _orign.parent().attr('style','background:url('+e.target.result+')');
            }
            reader.readAsDataURL(this.files[0]);
        })
        $(document).on('click','.btn-del-advisers',function (e) {
            var _id=$(this).data('id');
            var _this=$(this);
            $.post(_URL+'delAdvisers',{id:_id},function (data) {
                if(data){
                    _this.parent().parent().parent().parent().slideUp('slow',function () {
                        $(this).remove();
                    })
                }
            });
        })
        $(document).on('click','.btn-edit-advisers',function (e) {
            var _form=$(this).parent().parent().parent();
            var _input=_form.find('input[type=text]');
            var _submit=true;                
            $.each(_input,function () {
                if(($(this).attr('name')!='telno'&&$(this).attr('name')!='sorted')&&$(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)_form.submit();
        })
        $(document).on('click','.btn-advisers-new',function (e) {
            $.post(_URL+'newAdvisers',{id:'new'},function (data) {
                if(data){
                    location.reload();
                }
            });
        })
    });
})(jQuery, window);