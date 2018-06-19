;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';  
        var _tcate=_class=_make=_user=_dealer={};
        var _item='';           
        $.get(_URL+'getAccOptions',function (o) {
            _cate=o.cate;
            _make=o.make;
            _user=o.user;
            _dealer=o.dealer;
        },'json');         
        var _executive=$('#newbike-list').DataTable( {
            "ajax": {                   
                "url": _URL+"accessoryList",
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
                { "data": "text-price" },
                { "data": "text-cate" },
                { "data": "created" }
            ],
            "aoColumnDefs": [
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ -1 ], "bSortable": true, className: "text-right"},
                { "aTargets": [ '_all' ], "bSortable": false }                
            ],
            "fnCreatedRow": function( nRow, aData, iDataIndex ) { 
                if(aData.ctl==3){
                    $(nRow).addClass('bg-danger text-white');
                }else if(aData.ctl==1){
                    $(nRow).addClass('bg-warning text-white');
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
                            var _slCate=_slMake=_slClass=_slUser=_slDealer=_contact="";
                            $.each(_cate,function () {
                                if(this.key!=aData.category){
                                    _slCate+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slCate+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(_make,function () {
                                if(this.key!=aData.make){
                                    _slMake+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slMake+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(_user,function () {
                                if(this.key!=aData.userId){
                                    _slUser+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slUser+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(_dealer,function () {
                                if(this.key!=aData.dealerId){
                                    _slDealer+="<option value='"+this.key+"'>"+this.value+"</option>";
                                }else{
                                    _slDealer+="<option value='"+this.key+"' selected>"+this.value+"</option>";
                                }
                            });
                            $.each(aData.contact,function(k){
                                _contact+="<div class='row spec-item' data-id='"+this.id+"'><div class='col-2'>"+this.name+"</div><div class='col-4'>"+this.address+"</div><div class='col-3'>"+this.email+"</div><div class='col-2'>"+this.phone+"</div><div class='col-1 action-field'><span class='removeSpec' data-id='"+this.id+"' data-toggle='tooltip' data-placement='left' data-original-title='Click to deleted this line'><i class='la la-trash'></i></span></div></div>";
                            });
                            return '<form action="" id="editUsedbike-'+aData.id+'" multipart="" enctype="multipart/form-data" method="post" accept-charset="utf-8">'+
                                    '<nav>'+
                                    '<div class="nav nav-tabs" id="nav-tab" role="tablist">'+
                                        '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Accessory editor</a>'+
                                        '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Contact</a>'+
                                    '</div>'+
                                    '</nav>'+
                                    '<div class="tab-content" id="nav-tabContent" style="padding: 10px;">'+
                                      '<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">'+
                                            '<div class="row">'+
                                                '<div class="col-12">'+
                                                    '<div class="form-group">'+
                                                        '<input type="hidden" name="id" value="'+aData.id+'">'+
                                                        '<label for="fullname">Accessory</label>'+
                                                        '<input type="text" class="form-control input-field fullname-field" name="name" placeholder="Fullname" value="'+aData.bikeName+'">'+
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
                                                    '<div class="form-group">'+
                                                        '<label for="price">Price</label>'+
                                                        '<input type="text" class="form-control input-field" name="price" placeholder="Price" value="'+aData.price+'">'+
                                                    '</div>'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="make_id">Suitable model</label>'+
                                                        '<select class="form-control choose-type choose-make" data-target=".fullname-field" data-check=".name-field" name="make">'+
                                                            '<option value="" hidden>All models</option>'+_slMake+
                                                        '</select>'+
                                                    '</div>'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="type_id">category</label>'+
                                                        '<select class="form-control choose-type" name="category">'+
                                                            '<option value="" hidden>Choose category</option>'+_slCate+
                                                        '</select>'+
                                                    '</div>'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="user">User</label>'+
                                                        '<select class="form-control choose-type" name="user_id">'+
                                                            '<option value="" hidden>Choose user</option>'+_slUser+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-6">'+
                                                    '<div class="form-group floating-label">'+
                                                        '<label for="dealer">Dealer</label>'+
                                                        '<select class="form-control choose-type" name="dealer_id">'+
                                                            '<option value="" hidden>Choose dealer</option>'+_slDealer+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="paid_ad">Paid AD expiry date</label>'+
                                                        '<input type="text" class="form-control input-field date-field" placeholder="Paid AD expiry date" value="'+aData.paid_ad+'" name="paid_expiry">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                      '</div>'+
                                      '<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">'+
                                            '<div class="specification-detail" data-id="'+aData.id+'">'+
                                                '<div class="row spec-item bg-info"><div class="col-2"><input type="text" class="ct_name" placeholder="Input name"/></div><div class="col-4"><input type="text" class="ct_address" placeholder="Input address"/></div><div class="col-3"><input type="text" class="ct_email" placeholder="Input email"/></div><div class="col-2"><input type="text" class="ct_phone" placeholder="Input phone"/></div><div class="col-1 text-center"><span class="newSpec" data-id="'+aData.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Click to add new line"><i class="la la-send"></i></span></div></div>'+_contact+'</div>'+
                                      '</div>'+
                                    '</div>'+
                                    '<div class="popover-footer">'+                                
                                        '<button type="button" class="btn btn-save btn-new-usedbike">Save New</button>'+
                                        '<button type="button" class="btn btn-save btn-save-usedbike">Update</button>'+
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
                        $.post(_URL+'getAccImages',{id:_id,position:'accessory'},function (data) {
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
        $(document).on('click','.newSpec',function (e) {
            var _origin=$(this),_id=_origin.data('id'),
            _name=_origin.parent().siblings().find('input.ct_name').val()
            _address=_origin.parent().siblings().find('input.ct_address').val();
            _email=_origin.parent().siblings().find('input.ct_email').val();
            _phone=_origin.parent().siblings().find('input.ct_phone').val();
            if(_id!=''&&_name!=''){
                var check=confirm('Do you want to add new line?');
                if(check){
                    $.post(_URL+'addAContact',{'bike_id':_id,'name':_name,'address':_address,'email':_email,'phone':_phone},function(id) {
                        toastr.clear();
                        toastr.options.closeButton = true;
                        toastr.options.positionClass='toast-top-right'; 
                        toastr.success('You have been added specification successfully!');
                        $('.row.spec-item.bg-info').after("<div class='row spec-item' data-id='"+id+"'><div class='col-2' data-toggle='tooltip' data-placement='right' data-original-title='Drag this line to change order sorted'>"+_name+"</div><div class='col-4'>"+_address+"</div><div class='col-3'>"+_email+"</div><div class='col-2'>"+_phone+"</div><div class='col-1 action-field'><span class='removeSpec' data-id='"+id+"' data-toggle='tooltip' data-placement='left' data-original-title='Click to deleted this line'><i class='la la-trash'></i></span></div></div>");
                    });
                }
            }
        })   
        $(document).on('click','.removeSpec',function (e) {
            var _origin=$(this),_id=_origin.data('id');
            var check=confirm('Do you want to remove this line?');
            if(check){
                $.post(_URL+'removeAContact',{id:_id},function() {
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
                $.post(_URL+'removeAccImage',{id:_id},function() {
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.success('You have been deleted image successfully!');
                    _origin.parent().hide('slow',function () {
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
                $.post(_URL+'defaultAccimage',{id:_id},function() {
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
                    $.post(_URL+'sortAContact',{id:$(this).data('id'),items},function(o) {},'json');
                }
            });
            $('.date-field').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});
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
                question=confirm("Do you want to lock all selected items? ");
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
                    $.post(_URL+'lockItems',{items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been locked items successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(".multi-sold-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to sold out all selected items? ");
                if(question){
                    items=[];
                    $.each(checked,function () {
                        items.push($(this).val());
                        var _origin=$(this).parent().parent().parent();
                        _origin.addClass('bg-warning text-white')
                        $(this).trigger('click')
                    });
                    if($('.check-all').prop('checked')==true){
                        $('.check-all').trigger('click');
                    }                    
                    $.post(_URL+'soldItems',{items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been sold out items successfully!', '');
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
                question=confirm("Do you want to unlock all selected items? ");
                if(question){
                    items=[];
                    $.each(checked,function () {
                        items.push($(this).val());
                        var _origin=$(this).parent().parent().parent();
                        _origin.removeClass('bg-warning bg-danger text-white')
                        $(this).trigger('click')
                    });
                    if($('.check-all').prop('checked')==true){
                        $('.check-all').trigger('click');
                    }
                    $.post(_URL+'unlockItems',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been unlocked items successfully!', '');
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
                question=confirm("Do you want to delete all selected items? ");
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
                    $.post(_URL+'delItems',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been deleted items successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(document).on('click','.btn-save-usedbike',function (e) {
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
            if(_submit)_form.attr('action',_URL+'editAccessory').submit();
        })
        $(document).on('click','.btn-new-usedbike',function (e) {
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
            if(_submit)_form.attr('action',_URL+'newAccessory').submit();
        })
    });
})(jQuery, window);