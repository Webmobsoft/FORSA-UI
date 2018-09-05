function changeLanguage(language) {
	$.ajax({
		url: $("#base_url").val() + "login/changeLanguage/" + language,
		method: "post",
		cache: false,
		success: function() {
			window.location.href = window.location.href;
		}
	});
}