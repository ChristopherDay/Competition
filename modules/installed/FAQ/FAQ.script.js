$(".faq-item .panel-heading").bind("click", function () {
	if ($(this).parent().hasClass("faq-hidden")) {
		$(this).parent().removeClass("faq-hidden");
	} else {
		$(this).parent().addClass("faq-hidden");
	}
});