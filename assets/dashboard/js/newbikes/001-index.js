;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';  
        var _type=_class=_builtin=_make={};
        var _item='';           
        $.get(_URL+'getOptions',function (o) {
            _type=o.type;
            _class=o.class;
            _builtin=o.builtin;
            _make=o.make;
        },'json');         
        var _executive=$('#newbike-list').DataTable( {
            "ajax": {                   
                "url": _URL+"newbikeList",
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
                { "data": "text-bike" },
                { "data": "text-type" },
                { "data": "text-path" },
                { "data": "price" },
                { "data": "created" }
            ],
            "aoColumnDefs": [
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], className: "text-right"},
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
                        template:'<div class="popover edit-newbike" role="tooltip"><div class="arrow"></div><div class="popover-body pop-edit-body"></div></div>',
                        'content': function (e) {
                            var _slType=_slMake=_slClass=_slBuiltin=_specification="";
                            $.each(_type,function () {
                                if(this.key!=aData.type_id){
                                    _slType+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slType+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(_make,function () {
                                if(this.key!=aData.make){
                                    _slMake+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slMake+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(_class,function () {
                                if(this.key!=aData.class_id){
                                    _slClass+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slClass+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(_builtin,function () {
                                if(this.key!=aData.builtin){
                                    _slBuiltin+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slBuiltin+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(aData.specification,function(k){
                                _specification+="<div class='row spec-item' data-id='"+this.id+"'><div class='col-3' data-toggle='tooltip' data-placement='right' data-original-title='Drag this line to change order sorted'>"+this.sp_key+"</div><div class='col-8' data-toggle='tooltip' data-placement='top' data-original-title='Key to edit content this line'><input type='text' class='sp_val edit-val' value='"+this.sp_val+"' data-id='"+this.id+"'/></div><div class='col-1 action-field'><span class='removeSpec' data-id='"+this.id+"' data-toggle='tooltip' data-placement='left' data-original-title='Click to deleted this line'><i class='la la-trash'></i></span></div></div>";
                            });
                            return '<form action="'+_URL+'editNewbike'+'" id="editNewbike-'+aData.id+'" multipart="" enctype="multipart/form-data" method="post" accept-charset="utf-8">'+
                                    '<nav>'+
                                    '<div class="nav nav-tabs" id="nav-tab" role="tablist">'+
                                        '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Newbike editor</a>'+
                                        '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Specification</a>'+
                                    '</div>'+
                                    '</nav>'+
                                    '<div class="tab-content" id="nav-tabContent" style="padding: 10px;">'+
                                      '<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">'+
                                            '<div class="row">'+
                                                '<div class="col-6">'+
                                                    '<div class="form-group">'+
                                                        '<input type="hidden" name="id" value="'+aData.id+'">'+
                                                        '<label for="model">Model</label>'+
                                                        '<input type="text" class="form-control input-field" name="name" placeholder="Model" value="'+aData.model+'">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="model">Release year</label>'+
                                                        '<input type="text" class="form-control input-field" name="release_year" placeholder="Release year" value="'+aData.year+'">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-12">'+
                                                    '<div class="form-group">'+
                                                        '<label for="description">Description</label>'+
                                                        '<textarea class="form-control newbike-description input-field required" rows="5" name="description" id="newbike-'+aData.id+'-description">'+aData.description+'</textarea>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-6">'+
                                                    '<div class="switch-form">'+
                                                        '<label class="switch info" style="width:70%;">'+
                                                            '<b>Remove old images</b>'+
                                                            '<input type="checkbox" name="del">'+
                                                            '<span class="slider round"></span>'+
                                                        '</label>'+
                                                    '</div>'+
                                                    '<div style="background:url('+aData.image+')" class="img-view" data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">'+
                                                        '<input type="file" name="image[]" class="update-directory-img" data-responsive=".img-view" multiple/>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-6">'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="make_id">Make</label>'+
                                                        '<select class="form-control choose-type" name="make_id">'+
                                                            '<option value="" hidden>Choose make</option>'+_slMake+
                                                        '</select>'+
                                                    '</div>'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="type_id">Type</label>'+
                                                        '<select class="form-control choose-type" name="type_id">'+
                                                            '<option value="" hidden>Choose type</option>'+_slType+
                                                        '</select>'+
                                                    '</div>'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="class_id">Class</label>'+
                                                        '<select class="form-control choose-type" name="class_id">'+
                                                            '<option value="" hidden>Choose class</option>'+_slClass+
                                                        '</select>'+
                                                    '</div>'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="builtin">Builtin</label>'+
                                                        '<select class="form-control choose-type" name="builtin">'+
                                                            '<option value="" hidden>Choose builtin</option>'+_slBuiltin+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-12">'+
                                                    '<div class="form-group">'+
                                                        '<label for="video_url">Video path</label>'+
                                                        '<input type="text" class="form-control input-field" name="video_url" placeholder="Video path" value="'+aData.video+'">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="min">Min price</label>'+
                                                        '<input type="text" class="form-control input-field" placeholder="Min price" value="'+aData.min+'" readonly>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="max">Max price</label>'+
                                                        '<input type="text" class="form-control input-field" placeholder="Max price" value="'+aData.max+'" readonly>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                      '</div>'+
                                      '<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">'+
                                            '<div class="specification-detail" data-id="'+aData.id+'">'+
                                                '<div class="row spec-item bg-info"><div class="col-3"><input type="text" class="sp_key" placeholder="Input key"/></div><div class="col-8"><input type="text" class="sp_val" placeholder="Input value"/></div><div class="col-1 text-center"><span class="newSpec" data-id="'+aData.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Click to add new line"><i class="la la-send"></i></span></div></div>'+_specification+'</div>'+
                                      '</div>'+
                                    '</div>'+
                                    '<div class="popover-footer">'+                                
                                        '<button type="button" class="btn btn-save btn-save-newbike">Update</button>'+
                                        '<button type="button" class="btn btn-cancel">Cancel</button>'+
                                    '</div>'+
                                '</form>';
                        }
                    });
                }   
            },
            "fnDrawCallback": function( oSettings ) {
                $('[data-tool="tooltip"]').tooltip();
                $('[data-toggle="modal"]').on('click',function () {
                    var _id=$(this).data("id");
                    var _target=$(this).data('target');
                    $(_target).modal();
                    $(_target).find('.list').empty();
                    var options = {
                        valueNames: [ 
                            {attr:'data-id',name:'image-id'},
                            {attr:'style',name:'image_url'},
                            {attr:'default',name:'checked'},
                        ],                        
                        page: 10,
                        pagination: false
                    };
                    if(_target=='#image-modal'){
                        options.item='<div class="col-3">'+
                            '<div style="" data-id class="img-view image-id image_url checked" data-toggle="tooltip" data-placement="top" data-original-title="Click to change default image">'+
                                '<span class="del-img" data-toggle="tooltip" data-placement="left" data-original-title="Click to deleted this image"><i class="la la-close"></i></span>'+
                            '</div>'+
                        '</div>';
                        $.post(_URL+'getImages',{id:_id,position:'newbike'},function (data) {
                            if(data.length>0){
                                categoryList= new List('image-modal',options,data);
                                $('[data-toggle="tooltip"]:not([default="default"])').tooltip();
                            }else{
                                $(_target).find('.list').html('<h1 class="text-center"> No images availbility now!</h1>')
                            }
                        },'json');
                    }
                })
            }
        })
        $('.new-event-date').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});//YYYY-MM-DD hh:mm A
        $(document).on('keyup','#search-sender',function(){
            _executive.ajax.reload();
        })  
        $(document).on('change','.edit-val',function (e) {
            var _origin=$(this),_id=_origin.data('id'),_val=_origin.val();
            var check=confirm('Do you want to change content this line?');
            if(check){
                $.post(_URL+'editNBspec',{id:_id,sp_val:_val},function() {
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.success('You have been deleted image successfully!');
                });
            }
        })   
        $(document).on('click','.newSpec',function (e) {
            var _origin=$(this),_id=_origin.data('id'),
            _key=_origin.parent().siblings().find('input.sp_key').val()
            _val=_origin.parent().siblings().find('input.sp_val').val();
            if(_key!=''&&_val!=''){
                var check=confirm('Do you want to add new line?');
                if(check){
                    $.post(_URL+'addNBspec',{'item':_id,'sp_key':_key,'sp_val':_val},function(id) {
                        toastr.clear();
                        toastr.options.closeButton = true;
                        toastr.options.positionClass='toast-top-right'; 
                        toastr.success('You have been added specification successfully!');
                        $('.row.spec-item.bg-info').after("<div class='row spec-item' data-id='"+id+"'><div class='col-3' data-toggle='tooltip' data-placement='right' data-original-title='Drag this line to change order sorted'>"+_key+"</div><div class='col-8' data-toggle='tooltip' data-placement='top' data-original-title='Key to edit content this line'><input type='text' class='sp_val edit-val' value='"+_val+"' data-id='"+id+"'/></div><div class='col-1 action-field'><span class='removeSpec' data-id='"+id+"' data-toggle='tooltip' data-placement='left' data-original-title='Click to deleted this line'><i class='la la-trash'></i></span></div></div>");
                    });
                }
            }
        })   
        $(document).on('click','.removeSpec',function (e) {
            var _origin=$(this),_id=_origin.data('id');
            var check=confirm('Do you want to remove this line?');
            if(check){
                $.post(_URL+'removeNBspec',{id:_id},function() {
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.success('You have been deleted specification successfully!');
                    _origin.parent().parent().hide('slow',function () {
                        $(this).remove();
                    })
                });
            }
        })   
        $(document).on('click','.del-img',function (e) {
            var _origin=$(this).parent(),_id=_origin.data('id');
            var check=confirm('Do you want to remove this image?');
            if(check){
                $.post(_URL+'removeNBimage',{id:_id},function() {
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.success('You have been deleted image successfully!');
                    _origin.hide('slow',function () {
                        $(this).remove();
                    })
                });
            }
            e.stopPropagation();
        }) 
        $(document).on('click','.img-view.checked',function () {
            var _origin=$(this),_id=_origin.data('id');
            var check=confirm('Do you want to set default this image?');
            if(check){
                $.post(_URL+'defaultNBimage',{id:_id},function() {
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.success('You have been set default image successfully!');
                    _origin.attr("default","default").parent().siblings().find('div[default="default"]').removeAttr("default")
                });
            }
        })
        $(document).on('click','.btn-save',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('click','.btn-cancel',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('shown.bs.popover','[data-toggle="popover"]',function () {
            $('[data-toggle="popover"]').not(this).popover('hide');
            $(".newbike-description").slimScroll({
                width: '100%',
                height: 120,
                railVisible: false,
                alwaysVisible: false,
                color:'#26a69a',
                disableFadeOut: true
            });
            $(".specification-detail").slimScroll({
                width: '100%',
                height: 400,
                railVisible: false,
                alwaysVisible: false,
                color:'#26a69a',
                disableFadeOut: true
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.specification-detail').sortable({
                cancel: ".bg-info,.edit-val",
                placeholder: "ui-state-highlight",
                stop: function( event, ui ) {
                    items=$('.specification-detail').sortable('toArray',{attribute: 'data-id'});items.shift();
                    $.post(_URL+'sortNBspec',{id:$(this).data('id'),items},function(o) {},'json');
                }
            });
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
        $(document).on('change','.name-field',function () {
            var _make=$("#new-bike .choose-make").find("option:selected").text(),
            _changed=_make+' '+$(this).val();
            if(_make!='Choose make'){
                $(this).siblings('input[type="hidden"]').val(_changed);
                $("#new-bike").find('.card-title').html(_changed);
            }
        })
        $(document).on('change','.choose-make',function () {
            var _check=$(this).data('check'),
            _response=$(this).data('target'),
            _make=$(this).find("option:selected").text();
            if($(_check).val()==''){
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.options.positionClass='toast-top-right'; 
                toastr.error('Please key model fields!', '');
                $(this).find("option:selected").removeAttr('selected');
                $(this).find("option:first").attr('selected', true);
                return false;
            }else{
                var _name=_make+' '+$(_check).val();
                $(_response).val(_name);
                $("#new-bike").find('.card-title').html(_name);
            }
        })
        $(document).on('click','.btn-new-bike',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type=text]');
            var _submit=true;                
            $.each(_input,function () {
                if($(this).attr('name')=='modal'&&$(this).val()==''){
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
                    $.post(_URL+'lockNewbike',{items},function (o) {
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
                    $.post(_URL+'unlockNewbike',{items:items},function (o) {
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
                    $.post(_URL+'delNewbike',{items:items},function (o) {
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
        $(document).on('click','.btn-save-newbike',function (e) {
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
            if(_submit)_form.submit();
        })
    });
})(jQuery, window);