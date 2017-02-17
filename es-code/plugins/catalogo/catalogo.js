	
function imageClick(evt) {
     	evt.preventDefault(); 
        return false;  
}

function replaceSrc(thumbnailclass, target){
	$(thumbnailclass).click(function() {
				$(target).attr('src',this.src);
        });
}

function imalive() {
	alert("IM ALIVE!!!");
}