
//toggle the proceed button on the initial landing page for the users.
$(document).ready(function() {
	var $submit = $("#submit_prog").hide(),
	$agree_check = $('input[name="agree"]').click(function() {
    $submit.toggle( $agree_check.is(":checked") );
	});    
});