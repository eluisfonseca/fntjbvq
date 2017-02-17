function resizePages() {
	var bodyheight = $(window).height();
	$('#welcome').css('min-height', bodyheight);
	$('.logo_welcome').css('max-height', bodyheight-140);
}

function resizeQuem() {

	// Formatação das áreas de texto
	$("#box1").css('min-height','0');
	$("#box2").css('min-height','0');
	$("#box3").css('min-height','0');
	
	$("#box1").css('height','auto');
	$("#box2").css('height','auto');
	$("#box3").css('height','auto');
	
	var size1 = $("#box1").height();
	var size2 = $("#box2").height();
	var size3 = $("#box3").height();
	
	var sameheight;
	
	if (size1>=size2 && size1>=size3) {
		sameheight = $("#box1").height();
	}
	else if (size2>=size1 && size2>=size3) {
		sameheight = $("#box2").height();
	}
	else if (size3>=size1 && size3>=size2) {
		sameheight = $("#box3").height();
	}
	
    $("#box1").css('min-height',sameheight);
	$("#box2").css('min-height',sameheight);
	$("#box3").css('min-height',sameheight);
}
