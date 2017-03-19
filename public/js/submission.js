$(document).ready(function(){
	$("#form").submit(function(e){
		$("#form_submit_btn").hide();
		var img = "<img src='/loading.gif' width=50px />"
		$("#submission_result").html(img);
		$.ajax({
			type: 'POST',
			url: '/submission',
			data: $("#form").serialize(),
			success: function(data) {
				$("#form_submit_btn").show();
				$("#submission_result").html(data);
			},
			error: function(data){
				$("#form_submit_btn").show();
				$("#submission_result").html("Some Error Occured, Pls try again.");
			}
		});
		e.preventDefault();
	})
});