function copyAddress() {
	if (!active()) return; 
	$("[name='billStreet']").val($("[name='street']").val());
	$("[name='billLine2']").val($("[name='line2']").val());
	$("[name='billCity']").val($("[name='city']").val());
	$("[name='billCounty']").val($("[name='county']").val());
	$("[name='billPostcode']").val($("[name='postcode']").val());
}

function active() {
	return $("input[type='checkbox']").prop("checked");
}

$("input[type='checkbox']").on("change", function () {
	if (active()) {
		$(".billing [type='text']").attr("disabled", "disabled");
	} else {
		$(".billing [type='text']").removeAttr("disabled");
	}
});


$("input").on("keyUp", function () {
	copyAddress();
});