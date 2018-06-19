;(function ($, window, undefined) {

    $(document).ready(function () {  
    	$(document).on('click',function(e){
            if(!$(e.target).closest('div.notify.container').length) {
                if($('div.notify.container').is(":visible")) {
                    $('div.notify.container').slideUp('slow',function(){$(this).remove()});
                }
            } 
        })      
        $('[data-toggle="tooltip"]').tooltip()
    });
})(jQuery, window);