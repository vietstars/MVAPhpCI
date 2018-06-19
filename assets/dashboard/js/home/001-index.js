;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';
        $('.date-timeline').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});//YYYY-MM-DD hh:mm A
        $('.content-form').summernote({          
            upload:'http://'+window.location.hostname+'/api/imgCode',
            disableDragAndDrop: true,
            folder:'editor',
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', []],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });       
        $(".timeline-content").slimScroll({
            width: '100%',
            height: 150,
            railVisible: false,
            alwaysVisible: false,
            color:'#26a69a',
            disableFadeOut: true
        });
        $(document).on('change','input[type=file].update-img',function () {
            var _orign=$(this);
            var _responsive=_orign.data('responsive');
            var reader = new FileReader();
            reader.onload = function (e) {
                _orign.parent().siblings(_responsive).attr('style','background:url('+e.target.result+')');
            }
            reader.readAsDataURL(this.files[0]);
        })
        $(document).on('change','input[type=file].update-img-link',function () {
            var _orign=$(this);
            var _responsive=_orign.data('responsive');
            var reader = new FileReader();
            reader.onload = function (e) {
                _orign.parent().attr('style','background:url('+e.target.result+')');
            }
            reader.readAsDataURL(this.files[0]);
        })
        $(document).on('click','.btn-top-left-editor',function (e) {
            var _input=$('#intro-form').find('input[type="text"].required');
            var _content=$('#intro-form').find('textarea');
            var _submit=true;
            if(_content.val()==''){
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.options.positionClass='toast-top-right'; 
                toastr.error('Please key all fields!', '');
                _submit=false;             
            }                
            $.each(_input,function () {
                if($(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)$('#intro-form').submit();
        })
        $(document).on('click','.btn-bot-content-editor',function (e) {
            var _input=$('#content-form').find('input[type="text"].required');
            var _content=$('#content-form').find('textarea');
            var _submit=true;
            if(_content.val()==''){
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.options.positionClass='toast-top-right'; 
                toastr.error('Please key all fields!', '');
                _submit=false;             
            }                
            $.each(_input,function () {
                if($(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)$('#content-form').submit();
        })
        $(document).on('click','.btn-image-link-editor',function (e) {
            var _input=$('#img-link').find('input[type="text"].required');
            var _submit=true;              
            $.each(_input,function () {
                if($(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)$('#img-link').submit();
        })
        $(document).on('click','.btn-association-link-editor',function (e) {
            var _input=$('#association-link').find('input[type="text"].required');
            var _submit=true;             
            $.each(_input,function () {
                if($(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)$('#association-link').submit();
        })
        $(document).on('click','.btn-del-timeline',function (e) {
            var _id=$(this).data('id');
            var _this=$(this);
            $.post(_URL+'delTimeline',{id:_id},function (data) {
                if(data){
                    _this.parent().parent().parent().parent().slideUp('slow',function () {
                        $(this).remove();
                    })
                }
            });
        })
        $(document).on('click','.btn-edit-timeline',function (e) {
            var _form=$(this).parent().parent().parent();
            var _input=_form.find('input');
            var _content=_form.find('textarea');
            var _submit=true;
            if(_content.val()==''){
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.options.positionClass='toast-top-right'; 
                toastr.error('Please key all fields!', '');
                _submit=false;             
            }                
            $.each(_input,function () {
                if($(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)_form.submit();
        })
        $(document).on('click','.btn-timeline-new',function (e) {
            $.post(_URL+'newTimeline',{id:'new'},function (data) {
                if(data){
                    location.reload();
                }
            });
        })
    });
})(jQuery, window);