var slide_cItem	= '';
var sliderTime	= 5000;

function sliderImg(size, element){
	$(element).find('img').each(function(index, element) {
        $(this).css({'height': size + 'px'});
    });
}
function slider(){
	var hidePos	= $('#slider').width() + 10;
	var hidden	= true;
	var maxH	= $('#slider').parent().height();
	$('#slider').css({'height': maxH + 'px'});
	$('#slider').children('div').each(function(index, element) {
		sliderImg((maxH * 0.6), this);
		$(this).css({'height': maxH + 'px'});
		if(hidden){
			slide_cItem	= $(this).attr('id');
			$(this).css({'left': '0px', 'right': '0px', 'top': '0px'});
			hidden	= false;
		}else{
			$(this).css({'left': hidePos + 'px', 'right': '-' + hidePos + 'px', 'top': '0px'});
		}
    });
	setTimeout(sliderNext, sliderTime);
}
function sliderNext(){
	var next	= false;
	var first	= '';
	var hidePos	= $('#slider').width() + 10;
	$('#slider').children('div').each(function(index, element) {
		if(first == ''){
			first	= $(this).attr('id');
		}
		if($(this).attr('id') == slide_cItem){
			$(this).animate({'left': '-=' + hidePos + 'px', 'right': '+=' + hidePos + 'px'}, 600, 'swing', function(){
				$(this).css({'left': hidePos + 'px', 'right': '-' + hidePos + 'px'});
			});
			next	= true;
		}else if(next == true){
			$(this).animate({'left': '0px', 'right': '0px'}, 600, 'swing');
			//$(this).animate({ "left": '-=' + hidePos + 'px' }, "slow" );
			//$(this).css({'left': '0px', 'right': '0px'});
			slide_cItem	= $(this).attr('id');
			next	= false;
		}
    });
	if(next == true){
		$('#' + first).animate({'left': '0px', 'right': '0px'}, 600, 'swing');
		//$(this).animate({ "left": '-=' + hidePos + 'px' }, "slow" );
		//$('#' + first).css({'left': '0px', 'right': '0px'});
		slide_cItem	= first;
		next	= false;
	}
	setTimeout(sliderNext, sliderTime);
}
function sliderResize(){
	var hidePos	= $('#slider').width() + 10;
	$('#slider').children('div').each(function(index, element) {
		if($(this).attr('id') != slide_cItem){
			$(this).css({'left': hidePos + 'px', 'right': '-' + hidePos + 'px', 'top': '0px'});
		}
    });
}