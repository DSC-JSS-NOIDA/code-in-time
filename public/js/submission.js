$(document).ready(function(){
	$("#form").submit(function(e){
		$("#form_submit_btn").hide();
		$("#submission_result").html('<br><br>');
		$.ajax({
			type: 'POST',
			url: '/submission',
			data: $("#form").serialize(),
			success: function(data) {
				$("#form_submit_btn").show();
				$("#submission_result").html(data);
			}
		});
		e.preventDefault();
	})
});