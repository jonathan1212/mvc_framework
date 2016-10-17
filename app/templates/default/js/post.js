(function(){

	"use strict"

	$.fn.postId;

	$('.comment').on('click',function(e){
		//e.preventDefault();
		var $me = $(this);
		$('#openModal').html('<i class="fa fa-spinner"></i>');

		$.fn.postId = $me.data('id');

		$.get('post/comment/' + $me.data('id'),{},function(data){
			
			$('#openModal').html(data['form']);	
			var $form = $.parseHTML(data['form']);			
			//submit form
			//console.log( $($form[1]).find('form#comment') );
			//var $x = $($form[1]).find('form#comment');
		});


	});

	$(document).on('submit', '#comment',function(e){
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		
		$.ajax({
	        url: 'post/comment/'+ $.fn.postId,
	        type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {},
	        complete: function (jqXHR, textStatus) {},
	        success: function(response){
	        	$('#openModal').html(response['form']);	
	        	if (response.isSuccess) {
	        		window.location.href = "/post";
	        	}
	        }
	    });

		console.log(formData);
	
	});

})()