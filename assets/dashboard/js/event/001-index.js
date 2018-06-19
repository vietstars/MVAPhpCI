;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';           
        var _executive=$('#executive-list').DataTable( {
            "ajax": {                   
                "url": _URL+"eventList",
                "type": "POST",
                "data": function (d) {
                    d.search.value=$('#search-sender').val();
                }
            },
            "paging": true,
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 5,
            "searching": false,
            "info": false,
            "bSort": true,
            "order": [],
            "columns": [
                { "data": "text-name" },
                { "data": "text-description" },
                { "data": "sorted" },
                { "data": "created" }
            ],
            "aoColumnDefs": [
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true, className: "text-right"},
                { "aTargets": [ -1 ], "bSortable": true, className: "text-right"},
                { "aTargets": [ -2 ], "bSortable": true, className: "text-right"},
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
                        title:'Event editor',
                        template:'<div class="popover edit-executive" role="tooltip"><div class="arrow"></div><h3 class="popover-header pop-edit-header"></h3><div class="popover-body pop-edit-body"></div></div>',
                        'content': function (e) {
                            return'<form action="'+_URL+'editEvent'+'" id="executive-'+aData.id+'" enctype="multipart/form-data" method="post" accept-charset="utf-8">'+
                            '<div class="row">'+
                                '<div class="col-12">'+
                                    '<div class="form-group">'+
                                        '<input type="hidden" name="id" value="'+aData.id+'">'+
                                        '<label for="name">Name</label>'+
                                        '<input type="text" class="form-control input-field" name="name" placeholder="Name" value="'+aData.name+'">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-6">'+
                                    '<div class="form-group">'+
                                        '<label for="created">Event date</label>'+
                                        '<input type="text" class="form-control input-field date-event" name="created" placeholder="Event date" value="'+aData.created+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-6">'+
                                    '<div class="form-group">'+
                                        '<label for="sorted">Sort</label>'+
                                        '<input type="text" class="form-control input-field" name="sorted" placeholder="Sort" value="'+aData.sorted+'">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-12">'+
                                    '<div class="form-group">'+
                                        '<label for="telno">Description</label>'+
                                        '<textarea class="form-control event-description input-field required" name="description" id="event-'+aData.id+'-description">'+aData.description+'</textarea>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<button type="button" class="btn btn-save btn-save-executive">Save</button>'+
                            '<button type="button" class="btn btn-cancel">Cancel</button></form>';
                        }
                    });
                }   
            },
            "fnDrawCallback": function( oSettings ) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        })
        $('.new-event-date').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});//YYYY-MM-DD hh:mm A
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
            $(".event-description").slimScroll({
                width: '100%',
                height: 120,
                railVisible: false,
                alwaysVisible: false,
                color:'#26a69a',
                disableFadeOut: true
            });
            $('.date-event').bootstrapMaterialDatePicker({nowButton:true,time:false,format : 'YYYY-MM-DD'}).on('change', function(e,date){});//YYYY-MM-DD hh:mm A
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
                question=confirm("Do you want to lock all selected members? ");
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
                    $.post(_URL+'exLockMember',{items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been locked executive successfully!', '');
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
                question=confirm("Do you want to unlock all selected members? ");
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
                    $.post(_URL+'exUnlockMember',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been unlocked executive successfully!', '');
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
                question=confirm("Do you want to delete all selected members? ");
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
                    $.post(_URL+'exDelMember',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been deleted executive successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
        $(document).on('click','.btn-save-executive',function (e) {
            var _form=$(this).parent();
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
    });
})(jQuery, window);