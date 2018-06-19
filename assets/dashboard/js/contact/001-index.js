;(function ($, window, undefined) {

    $(document).ready(function () { 
        var _URL='http://'+window.location.hostname+'/dashboard/';           
        var _executive=$('#executive-list').DataTable( {
            "ajax": {                   
                "url": _URL+"contactList",
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
                { "data": "email" },
                { "data": "text-message" },
                { "data": "created" },
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
                        title:'Message detail',
                        template:'<div class="popover edit-executive" role="tooltip"><div class="arrow"></div><h3 class="popover-header pop-edit-header"></h3><div class="popover-body pop-edit-body"></div></div>',
                        'content': function (e) {
                            return'<form action="'+_URL+'editMember'+'" id="executive-'+aData.id+'" enctype="multipart/form-data" method="post" accept-charset="utf-8">'+
                            '<div class="row">'+
                                '<div class="col-6">'+
                                    '<div class="form-group">'+
                                        '<input type="hidden" name="id" value="'+aData.id+'">'+
                                        '<label for="name">Name</label>'+
                                        '<input type="text" class="form-control input-field" name="name" placeholder="Name" value="'+(aData.name?aData.name:'')+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-6">'+
                                    '<div class="form-group">'+
                                        '<label for="created">Email</label>'+
                                        '<input type="text" class="form-control input-field" name="email" placeholder="Email" value="'+(aData.email?aData.email:'')+'">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-12">'+
                                    '<div class="form-group">'+
                                        '<label for="name">Address</label>'+
                                        '<textarea class="form-control input-field contact-message" name="message" placeholder="Message">'+(aData.message?aData.message:'')+'</textarea>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
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
        $(document).on('shown.bs.popover','[data-toggle="popover"]',function () {
            $('[data-toggle="popover"]').not(this).popover('hide');
            $(".contact-message").slimScroll({
                width: '100%',
                height: 300,
                railVisible: false,
                alwaysVisible: false,
                color:'#26a69a',
                disableFadeOut: true
            });
        })
        $(document).on('click','.btn-cancel',function(){
            $('[data-toggle="popover"]').popover('hide');
        })
        $(document).on('click','.btn-update-contact',function (e) {
            var _form=$(this).parent().parent();
            var _input=_form.find('input[type=text]');
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
        $(".multi-del-btn").click(function(){
            var _form=$(this).parent().data('target');
            var checked=$(_form).find("input[type='checkbox'].check-id:checked");
            if(checked.length){
                question=confirm("Do you want to delete all selected contact? ");
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
                    $.post(_URL+'delContact',{items:items},function (o) {
                        if(!o)location.reload();else{
                            toastr.clear();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass='toast-top-right'; 
                            toastr.success('You have been deleted contact successfully!', '');
                            _submit=false;
                        }
                    });
                }
            }
        })
    });
})(jQuery, window);