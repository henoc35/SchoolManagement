window.setTimeout(function() {
    $("#card-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);

jQuery(document).ready(function($){
	$('#card-alert .close').on('click', function(){
		$("#card-alert").fadeTo(500, 0).slideUp(500, function(){
        	$(this).remove(); 
    	});
	});
	$('#card-alert').on('click', function(){
		$("#card-alert").fadeTo(500, 0).slideUp(500, function(){
        	$(this).remove(); 
    	});
    });	
});


