;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/',
        _item='<div class="col-10 with-border" style="padding-top:10px;"><strong class="category-name"></strong><i class="la la-trash la-2x pull-right del-category cate-id" data-toggle="tooltip" data-placement="left" data-original-title="Click to delete this category" data-id=""></i></div>';           
        var _executive=$('#executive-list').DataTable( {
            "ajax": {                   
                "url": _URL+"merchantsList",
                "type": "POST",
                "data": function (d) {
                    d.search.value=$('#search-sender').val();
                }
            },
            "paging": true,
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 10,
            "searching": false,
            "info": false,
            "bSort": true,
            "order": [],
            "columns": [
                { "data": "text-company" },
                { "data": "text-desc" },
                { "data": "text-email" },
                { "data": "text-telno" },
                { "data": "text-sorted" },
            ],
            "aoColumnDefs": [
                { "aTargets": [ 1 ], "bSortable": true},
                { "aTargets": [ -1 ], "bSortable": true, className: "text-right"},
                { "aTargets": [ -2 ], className: "text-right"},
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
                        title:'Merchant editor',
                        template:'<div class="popover edit-executive" role="tooltip"><div class="popover-body pop-edit-body" style="padding:5px"></div></div>',
                        'content': function (e) {
                            return '<form action="'+_URL+'drEditDirectory'+'" id="directory-'+aData.id+'" enctype="multipart/form-data" method="post" accept-charset="utf-8">'+
                                '<nav>'+
                                '<div class="nav nav-tabs" id="nav-tab" role="tablist">'+
                                    '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">PROFILE</a>'+
                                    '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">INTRODUCTION</a>'+
                                '</div>'+
                                '</nav>'+
                                '<div class="tab-content" id="nav-tabContent" style="padding: 10px;">'+
                                  '<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">'+
                                        '<div class="row">'+
                                            '<div class="col-12">'+
                                                '<div class="form-group">'+
                                                    '<input type="hidden" name="id" value="'+aData.id+'">'+
                                                    '<label for="company">Company\'s name</label>'+
                                                    '<input type="text" class="form-control input-field" name="company" placeholder="Company\'s name" value="'+aData.company+'">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-12">'+
                                                '<div class="form-group">'+
                                                    '<label for="description">Description</label>'+
                                                    '<textarea class="form-control merchants-description input-field required" rows="5" name="description" id="merchants-'+aData.id+'-description">'+aData.description+'</textarea>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-6">'+
                                                '<label for="name">Image <small>(Best dimension: 385x195)</small></label>'+
                                                '<div style="background:url('+aData.image+')" class="img-view" data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">'+
                                                    '<input type="file" name="image" class="update-directory-img" data-responsive=".img-view"/>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="address">Address</label>'+
                                                    '<input type="text" class="form-control input-field" name="address" placeholder="Address" value="'+aData.address+'">'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<label for="name">Zip code</label>'+
                                                    '<input type="text" class="form-control input-field" name="zipcode" placeholder="Zip code" value="'+aData.zipcode+'">'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<label for="name">Phone</label>'+
                                                    '<input type="text" class="form-control input-field" name="telno" placeholder="Phone" value="'+aData.telno+'">'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<label for="fax">Fax</label>'+
                                                    '<input type="text" class="form-control input-field" name="fax" placeholder="Fax" value="'+aData.fax+'">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-12">'+
                                                '<div class="form-group">'+
                                                    '<label for="working_hour">Working time</label>'+
                                                    '<input type="text" class="form-control input-field" name="working_hour" placeholder="Working time" value="'+aData.working_hour+'">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="website">Website</label>'+
                                                    '<input type="text" class="form-control input-field" name="website" placeholder="Sort" value="'+aData.website+'">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="email">Email</label>'+
                                                    '<input type="text" class="form-control input-field" name="email" placeholder="Email" value="'+aData.email+'">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="name">Featured <small>( Descending by feature number )</small></label>'+
                                                    '<input type="text" class="form-control input-field" name="featured" placeholder="featured" value="'+aData.featured+'">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="fax">Dealer <small>( Descending by dealer number )</small></label>'+
                                                    '<input type="text" class="form-control input-field" name="dealer" placeholder="dealer" value="'+aData.dealer+'">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                  '</div>'+
                                  '<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">'+
                                        '<div class="row">'+
                                            '<div class="col-12">'+
                                                '<div class="form-group">'+
                                                    '<textarea class="form-control merchants-introduction input-field required" rows="5" name="introduction" id="merchants-'+aData.id+'-introduction">'+aData.introduction+'</textarea>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="popover-footer">'+                                
                                    '<button type="button" class="btn btn-save btn-new-directory">Save as new</button>'+
                                    '<button type="button" class="btn btn-save btn-save-directory">Update</button>'+
                                    '<button type="button" class="btn btn-cancel">Cancel</button>'+
                                '</div>'+
                            '</form>';
                        }
                    });
                }   
            },
            "fnDrawCallback": function( oSettings ) {
                $('[data-toggle="modal"]').on('click',function () {
                    var _id=$(this).parent().parent().data("id");
                    var _target=$(this).attr('href');
                    $(_target).modal();
                    $(_target).find('.list').empty();
                    var options = {
                        valueNames: [ 
                            {attr:'data-id',name:'cate-id'},
                            "category-name"
                        ],
                        
                        page: 10,
                        pagination: true
                    };
                    if(_target=='#category-modal'){
                        $(_target).find('.btn-add-category').attr('data-id',_id);
                        options.item= _item;
                        $.post(_URL+'getCategory',{id:_id,position:'category'},function (data) {
                            if(data.length>0){
                                categoryList= new List('category-modal',options,data);
                                $('[data-toggle="tooltip"]').tooltip();
                            }else{
                                $(_target).find('.list').html('<h1 class="text-center"> No category availbility now!</h1>')
                            }
                        },'json');
                    }
                    if(_target=='#location-modal'){
                        $(_target).find('.btn-add-location').attr('data-id',_id);
                        options.valueNames=[ {attr:'data-id',name:'location-id'},"location-name"];
                        options.item='<div class="col-10 with-border" style="padding-top:10px;"><strong class="location-name"></strong><i class="la la-trash la-2x pull-right del-location location-id" data-toggle="tooltip" data-placement="left" data-original-title="Click to delete this location" data-id=""></i></div>';
                        $.post(_URL+'getLocation',{id:_id,position:'location'},function (data) {
                            if(data.length>0){
                                categoryList= new List('location-modal',options,data);
                                $('[data-toggle="tooltip"]').tooltip();
                            }else{
                                $(_target).find('.list').html('<h1 class="text-center"> No location availbility now!</h1>')
                            }
                        },'json');
                    }
                });
            }
        })
        $('.new-event-date').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});//YYYY-MM-DD hh:mm A
        $(document).on('keyup','#search-sender',function(){
            _executive.ajax.reload();
        })  
        $(document).on('change','input[type=file].update-directory-img',function () {
            var _orign=$(this);
            var _responsive=_orign.data('responsive');
            var reader = new FileReader();
            reader.onload = function (e) {
                _orign.parent().attr('style','background:url('+e.target.result+')');
            }
            reader.readAsDataURL(this.files[0]);
        })
        $(document).on('click',".del-category",function (e) {
            var _origin=$(this),_id=_origin.data('id'),_check=confirm('Do you want to remove this category?');
            $.post(_URL+"drDelCategory",{id:_id},function(data) {
                _origin.parent().hide('slow',function(){
                    $(this).remove();
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('You have been removed category successful!', '');
                    _submit=false;
                })
            },'json')
        })
        $(document).on('click',".btn-add-category",function (e) {
            var _origin=$(this),_id=_origin.data('id'),_check=confirm('Do you want to add this category?');
            var _cate=_origin.siblings('select#category-list').val();
            $.post(_URL+"drAddCategory",{main_id:_cate,sub_id:_id},function(data) {
                if(data===true){
                    location.reload();
                }else{
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Insert category fails!', '');
                    _submit=false;
                }
            },'json')
        })
        $(document).on('click',".del-location",function (e) {
            var _origin=$(this),_id=_origin.data('id'),_check=confirm('Do you want to remove this location?');
            $.post(_URL+"drDelLocation",{id:_id},function(data) {
                _origin.parent().hide('slow',function(){
                    $(this).remove();
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('You have been removed location successful!', '');
                    _submit=false;
                })
            },'json')
        })
        $(document).on('click',".btn-add-location",function (e) {
            var _origin=$(this),_id=_origin.data('id'),_check=confirm('Do you want to add this location?');
            var _cate=_origin.siblings('select#location-list').val();
            $.post(_URL+"drAddLocation",{main_id:_cate,sub_id:_id},function(data) {
                if(data===true){
                    location.reload();
                }else{
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Insert location fails!', '');
                    _submit=false;
                }
            },'json')
        })

        $(document).on('click','.btn-save',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('click','.btn-cancel',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('shown.bs.popover','[data-toggle="popover"]',function () {
            $('[data-toggle="popover"]').not(this).popover('hide');
            $(".merchants-description").slimScroll({
                width: '100%',
                height: 120,
                railVisible: false,
                alwaysVisible: false,
                color:'#26a69a',
                disableFadeOut: true
            });
            $(".merchants-introduction").summernote({          
                upload:'http://'+window.location.hostname+'/dashboard/drImgCode',
                disableDragAndDrop: true,
                folder:'editor',
                height: 300,
            });  
            $('[data-toggle="tooltip"]').tooltip();
        })
        $(document).on('click','.btn-new-event',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type=text]');
            var _submit=true;                
            $.each(_input,function () {
                if(($(this).attr('name')!='name'&&$(this).attr('name')!='sorted')&&$(this).val()==''){
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
                question=confirm("Do you want to lock all selected directory? ");
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
                    $.post(_URL+'drLockDirectory',{items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been locked directory successfully!', '');
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
                question=confirm("Do you want to unlock all selected directory? ");
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
                    $.post(_URL+'drUnlockDirectory',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been unlocked directory successfully!', '');
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
                question=confirm("Do you want to delete all selected directory? ");
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
                    $.post(_URL+'drDelDirectory',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been deleted directory successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(".featured-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to take feature all selected directory? ");
                if(question){
                    items=[];
                    $.each(checked,function () {
                        items.push($(this).val());
                    });
                    if($('.check-all').prop('checked')==true){
                        $('.check-all').trigger('click');
                    }
                    $.post(_URL+'drFeature',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been featured directory successfully!');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(".dealer-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to take dealer all selected directory? ");
                if(question){
                    items=[];
                    $.each(checked,function () {
                        items.push($(this).val());
                    });
                    if($('.check-all').prop('checked')==true){
                        $('.check-all').trigger('click');
                    }
                    $.post(_URL+'drDealer',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been dealer directory successfully!');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(document).on('click','.btn-save-directory',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type=text]').not('.note-link-text,.note-link-url,.note-image-url,.note-video-url');
            var _submit=true;                
            $.each(_input,function () {
                if($(this).attr('name')=='company'&&$(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)_form.submit();
        })
        $(document).on('click','.btn-new-directory',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type=text]').not('.note-link-text,.note-link-url,.note-image-url,.note-video-url');
            var _submit=true;                
            $.each(_input,function () {
                if($(this).attr('name')=='company'&&$(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit)_form.attr('action',_URL+'drNewDirectory').submit();
        })
    });
})(jQuery, window);