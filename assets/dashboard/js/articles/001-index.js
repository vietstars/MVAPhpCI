;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';  
        var _item='';         
        var _executive=$('#blog-list').DataTable( {
            "ajax": {                   
                "url": _URL+"blogList",
                "type": "POST",
                "data": function (d) {
                    d.search.value=$('#search-sender').val();
                }
            },
            "paging": true,
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 13,
            "searching": false,
            "info": false,
            "bSort": true,
            "order": [],
            "columns": [
                { "data": "text-title" },
                { "data": "text-content" },
                { "data": "created" }
            ],
            "aoColumnDefs": [
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ -1 ], "bSortable": true, className: "text-right"},
                { "aTargets": [ '_all' ], "bSortable": false }                
            ],
            "fnCreatedRow": function( nRow, aData, iDataIndex ) { 
                if(aData.ctl==1){
                    $(nRow).addClass('bg-danger text-white');
                }
            },        
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {    
                if(aData.ctl!=1){          
                    $(nRow).find('[data-toggle="popover"]').popover({
                        trigger: 'click',
                        placement: 'bottom',
                        html:true,
                        title:'Blog editor',
                        template:'<div class="popover edit-executive" role="tooltip"><div class="arrow"></div><h3 class="popover-header pop-edit-header"></h3><div class="popover-body pop-edit-body"></div></div>',
                        'content': function (e) {                            
                            return '<form action="" id="editBlog-'+aData.id+'" multipart="" enctype="multipart/form-data" method="post" accept-charset="utf-8">'+
                                    '<div class="row">'+
                                        '<div class="col-12">'+
                                            '<div class="form-group">'+
                                                '<label for="title">Title</label>'+
                                                '<input type="hidden" name="id" value="'+aData.id+'">'+
                                                '<input type="text" class="form-control input-field" name="title" placeholder="title" value="'+aData.title+'">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-9">'+
                                            '<div class="form-group">'+
                                                '<label for="content">Content</label>'+
                                                '<textarea class="form-control input-field content-field" name="content">'+aData.content+'</textarea>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-3">'+
                                            '<label for="title">Image</label>'+
                                            '<div style="background:url(\''+aData.image+'\')" class="img-view" data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">'+
                                                '<input type="file" name="image" class="update-directory-img" data-responsive=".img-view"/>'+
'                                            </div>'+
'                                        </div>'+
                                    '</div>'+
                                    '<div class="popover-footer">'+                                
                                        '<button type="button" class="btn btn-save btn-save-article">Update</button>'+
                                        '<button type="button" class="btn btn-cancel">Cancel</button>'+
                                    '</div>'+
                                '</form>';
                        }
                    });
                }   
            },
            "fnDrawCallback": function( oSettings ) {
                $('[data-tool="tooltip"]').tooltip();
            }
        })
        $(document).on('keyup','#search-sender',function(){
            _executive.ajax.reload();
        })
        $(document).on('click','.btn-save',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('click','.btn-cancel',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('shown.bs.popover','[data-toggle="popover"]',function () {
            $('[data-toggle="popover"]').not(this).popover('hide');
            $(".content-field").summernote({          
                upload:'http://'+window.location.hostname+'/dashboard/drImgCode',
                disableDragAndDrop: true,
                folder:'editor',
                height: 300,
            }); 
            $('[data-toggle="tooltip"]').tooltip();
        }) 
        $(document).on('change','input[type=file].update-directory-img',function () {
            var _orign=$(this);
            var _responsive=_orign.data('responsive');
            var reader = new FileReader();
            reader.onload = function (e) {
                _orign.parent().attr('style','background:url('+e.target.result+')');
            }
            reader.readAsDataURL(this.files[0]);
            $(document).find("input[name='del']").trigger('click');
        })
        $(".input-content").summernote({          
            upload:'http://'+window.location.hostname+'/dashboard/drImgCode',
            disableDragAndDrop: true,
            folder:'editor',
            height: 300,
        });  
        $(document).on('click','.btn-new-article',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type=text]');
            var _submit=true;                
            $.each(_input,function () {
                if($(this).attr('name')=='title'&&$(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)_form.submit();
        })
        $(document).on('click','.check-all',function () {
            var _form=$(this).data('target');
            var _checkbox=$(_form).find("input[type='checkbox']").not(this);
            if($(this).prop('checked')==true){
                _checkbox.prop("checked",true);
            }else{
                _checkbox.prop("checked",false);
            }
        })
        $(".multi-lock-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to lock all selected bike? ");
                if(question){
                    items=[];
                    $.each(checked,function () {
                        items.push($(this).val());
                        var _origin=$(this).parent().parent().parent();
                        _origin.addClass('bg-danger text-white')
                        $(this).trigger('click')
                    });
                    if($('.check-all').prop('checked')==true){
                        $('.check-all').trigger('click');
                    }                    
                    $.post(_URL+'lockBlog',{items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been locked bike successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(".multi-unlock-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to unlock all selected bike? ");
                if(question){
                    items=[];
                    $.each(checked,function () {
                        items.push($(this).val());
                        var _origin=$(this).parent().parent().parent();
                        _origin.removeClass('bg-danger text-white')
                        $(this).trigger('click')
                    });
                    if($('.check-all').prop('checked')==true){
                        $('.check-all').trigger('click');
                    }
                    $.post(_URL+'unlockBlog',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been unlocked bike successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(".multi-del-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to delete all selected bike? ");
                if(question){
                    items=[];
                    $.each(checked,function () {
                        items.push($(this).val());
                        var _origin=$(this).parent().parent().parent().hide('slow',function () {
                            $(this).remove();
                        })
                    });
                    if($('.check-all').prop('checked')==true){
                        $('.check-all').trigger('click');
                    }
                    $.post(_URL+'delBlog',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been deleted bike successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(document).on('click','.btn-save-article',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type=text]');
            var _submit=true;                
            $.each(_input,function () {
                if($(this).attr('name')=='name'&&$(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)_form.attr('action',_URL+'editArticle').submit();
        })
    });
})(jQuery, window);