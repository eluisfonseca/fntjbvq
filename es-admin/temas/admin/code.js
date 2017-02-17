function teste(){
	alert("JAMBALAYAAAAAA!!!!");
}

function preventLinks() {
    $(".unobtrusive").click(function(e) {
      e.preventDefault();
    });
    return false;
  }

function displayForm(thingID){
	//alert(thingID);
	$( "#"+thingID ).css("display","inline");
	//document.getElementById(thingID).css("display","inline");
}

function hideForm(thingID){
	//alert(thingID);
	$( "#"+thingID ).css("display","none");
	//document.getElementById(thingID).css("display","inline");
}

function gotolocation(ele){
	$(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
}