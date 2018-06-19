;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';
        $('.birthdate').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});          
        var _executive=$('#executive-list').DataTable( {
            "ajax": {                   
                "url": _URL+"userList",
                "type": "POST",
                "data": function (d) {
                    d.search.value=$('#search-sender').val();
                }
            },
            "paging": true,
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 30,
            "searching": false,
            "info": false,
            "bSort": true,
            "order": [],
            "columns": [
                { "data": "text-name" },
                { "data": "text-phone" },
                { "data": "text-birthday" },
                { "data": "created" },
            ],
            "aoColumnDefs": [
                { "aTargets": [ -2 ], className: "text-right" },
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
                        title:'User detail',
                        template:'<div class="popover edit-executive" role="tooltip"><div class="arrow"></div><h3 class="popover-header pop-edit-header"></h3><div class="popover-body pop-edit-body"></div></div>',
                        'content': function (e) {
                            return'<form action="'+_URL+'editUser'+'" id="user-'+aData.id+'" enctype="multipart/form-data" method="post" accept-charset="utf-8">'+
                            '<div class="row">'+
                                '<div class="col-6">'+
                                    '<div style="background:url('+aData.avatar+')" class="img-view" data-toggle="tooltip" data-placement="top" data-original-title="Click to change image">'+
                                        '<input type="file" name="avatar" class="update-person-img" data-responsive=".img-view"/>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-6">'+
                                    '<div class="form-group">'+
                                        '<input type="hidden" name="id" value="'+aData.id+'">'+
                                        '<label for="name">Full name</label>'+
                                        '<input type="text" class="form-control input-field" name="fullname" placeholder="Input name" value="'+(aData.fullname?aData.fullname:'')+'">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="created">Email</label>'+
                                        '<input type="text" class="form-control input-field" name="email" placeholder="Input email" value="'+(aData.email?aData.email:'')+'">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="name">Password</label>'+
                                        '<input type="hidden" name="password">'+
                                        '<input class="form-control input-field password-form" onkeyup=\'$(this).val!=\"\"?$(this).attr(\"type\",\"password\"):$(this).attr(\"type\",\"text\");\' placeholder="Input password">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<select class="form-control choose-type" name="gender" onchange="this.className=\'form-control choose-type selected\'">'+
                                            '<option value="male" '+(aData.gender=='male'?'selected':null)+'>Male</option>'+
                                            '<option value="female" '+(aData.gender=='female'?'selected':null)+'>Female</option>'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-6">'+
                                    '<div class="form-group">'+
                                        '<input type="text" class="form-control input-field birthdate" name="birthday" placeholder="Input birthday" value="'+(aData.birthday?aData.birthday:'')+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-6">'+
                                    '<div class="form-group">'+
                                        '<input type="text" class="form-control input-field" name="telno" placeholder="Input phone" value="'+(aData.telno?aData.telno:'')+'">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-12">'+
                                    '<div class="form-group">'+
                                        '<input type="text" class="form-control input-field" name="address" placeholder="Input address" value="'+(aData.address?aData.address:'')+'">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<button type="button" class="btn btn-save btn-save-user">Save</button>'+
                            '<button type="button" class="btn btn-cancel">Close</button></form>';
                        }
                    });
                }   
            },
            "fnDrawCallback": function( oSettings ) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        })
        $(document).on('keyup','#search-sender',function(){
            _executive.ajax.reload();
        }) 
        $(document).on('click','.btn-save-user',function (e) {
            var _form=$(this).parent();
            var _input=_form.find('input[type=text]');
            var _submit=true;                
            $.each(_input,function () {
                if(($(this).attr('name')=='fullname'||$(this).attr('name')=='email')&&$(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields!', '');
                    _submit=false;
                }
            })
            if(_submit){
                var _val=_form.find('input.password-form').val();                
                if(_val!=''){_form.find('input[name="password"]').val(md5(_val,true));}
                _form.submit();
            }
        })
        $(document).on('change','input[type=file].update-person-img',function () {
            var _orign=$(this);
            var _responsive=_orign.data('responsive');
            var reader = new FileReader();
            reader.onload = function (e) {
                _orign.parent().attr('style','background:url('+e.target.result+')');
            }
            reader.readAsDataURL(this.files[0]);
        })
        $(document).on('shown.bs.popover','[data-toggle="popover"]',function () {
            $('[data-toggle="popover"]').not(this).popover('hide');
            $('.birthdate').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});
        })
        $(document).on('click','.btn-cancel',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('click','.btn-new-user',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type="text"]');
            var _submit=true;
            $.each(_input,function () {
                if(($(this).attr('name')!="gender"&&$(this).attr('name')!="birthday"&&$(this).attr('name')!="telno"&&$(this).attr('name')!="address")&&$(this).val()==''){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.options.positionClass='toast-top-right'; 
                    toastr.error('Please key all fields! '+$(this).attr('name'), '');
                    _submit=false;
                }
            })
            if(_submit){
                var _val=_form.find('input[type="password"]').val();                
                _form.find('input[type="hidden"]').val(md5(_val,true));
                _form.submit();
            }
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
        $(".multi-del-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to delete all selected user? ");
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
                    $.post(_URL+'delUser',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been deleted user successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(".multi-lock-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to lock all selected users? ");
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
                    $.post(_URL+'lockUser',{items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been locked users successfully!', '');
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
                question=confirm("Do you want to unlock all selected users? ");
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
                    $.post(_URL+'unlockUser',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been unlocked users successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
    });
})(jQuery, window);