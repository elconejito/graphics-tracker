function removeDOMObject($id) {
	$("#" + $id).hide("slow");
	setTimeout(function() { $("#" + $id).remove(); }, 1000);
}

// Alert Message Functions
function displayAlert($type,$message,$location) {
	$location = typeof $location !== 'undefined' ? $location : '.content';

	switch ( $type ) {
		case 'danger':
			$icon = '<i class="fa fa-exclamation-triangle"></i>';
			break;
		case 'success':
			$icon = '<i class="fa fa-check-circle"></i>';
			break;
		case 'info':
			$icon = '<i class="fa fa-info-circle"></i>';
			break;
		default:
			$icon = '';
	}

	$string = '<div class="alert alert-' + $type + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + $icon + ' ' + $message + '</div>';

	$($location).prepend($string);
}

$( document ).ready(function() {
	// make sure to remove data from modals when closed
	$(document).on('hidden.bs.modal', function (e) {
		$(e.target).removeData('bs.modal');
		$(e.target).find(".modal-content").html('<div class="modal-header"><h4 class="modal-title">Loading...</h4></div><div class="modal-body"></div>');
		console.log('modal data removed');
	});

	// ignore keypress of 'enter' key from forms in modals. needs to only accept clicking proper buttons
	$('#defaultModal').on('keydown', 'form', function(e){
		if(e.keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});

	$('.modal').on('click', 'button.post', function(e) {
		var $button = $(this);
		$button.button('loading');
		var $formData = $( $(this).data('target') ).serializeArray();
		var $formURL = $( $(this).data('target') ).attr('action');

		$.post( $formURL, $formData, "json" )
			.done(function(response) {
				if ( response.status === 1 ) {
					$('#defaultModal').modal('hide');

					switch ( response.data.action ) {
						case "create":
							// show message
							displayAlert('success', response.message);
							break;
						case "update":
							// show message
							displayAlert('success', response.message);
							break;
						case "delete":
							removeDOMObject(response.data.id);
							// show message
							displayAlert('success', response.message);
							break;
						case "reload":
							location.reload(true);
							break;
						case "redirect":
							location.replace(response.data.url);
							break;
					}
				} else {
					// show error message
					displayAlert('danger', response.message, '.modal .modal-body');
					$button.button('reset');
				}
			})
			.fail()
			.always();	// END $.post(
	});
});
