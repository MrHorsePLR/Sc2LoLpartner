$(function() {
	$("#ProfileGameId").change(function() {
		var game_id = $("#ProfileGameId").val();
		$.ajax({
			url: '/leagues/list',
			method: 'POST',
			data: { game_id: game_id },
			dataType: 'json',
			success: function(data) {
				var element = "";
				for (i in data) {
					element += "<option value="+data.id+">"+data.name+"</option>";
				}
				$("#ProfileLeagueId").append(element);
			}
		});
	});
});