<?PhP
if(!function_exists('adminT_head')){
	function adminT_head(){
		echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-admin/temas/admin/code.js"></script>';
	}
	add_hook('admin_head', 'adminT_head');
}
addJSinit("$('nav').height($(document).height() - 81);");
addJSinit("$('#main').width($(document).width() - 200);");
addJSresize("$('#main').width($(document).width() - 200);");
addJSinit("$('#err1').fadeOut(3000);");
addJSinit("$('#err2').fadeOut(3000);");

if(!function_exists('main')){
	function main(){
		echo 'Página Principal';
	}
}
	

#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>