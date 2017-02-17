<?PhP
function head(){
	global $bd;
	global $esJSInit;
	global $esJSResize;

	echo '<link href="' . SITE_ROOT . '/es-admin/temas/' . config(7) . '/style.css" rel="stylesheet" type="text/css" />';
	echo '<link href="' . SITE_ROOT . '/es-code/admin/explorer/explorer.css" rel="stylesheet" type="text/css" />';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/tinymce/tinymce.min.js"></script>';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/admin.js"></script>';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/jquery.maxlength-min.js"></script>';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/explorador.js"></script>';
	addJSinit('preventLinks();');
	run_hooks('admin_head');
	echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
	foreach($esJSInit as $funcJS){
		echo $funcJS;
	}
	echo '});';
	
	echo '$(window).resize(function(){';
	foreach($esJSResize as $funcJS){
		echo $funcJS;
	}
	echo '});</script>';
}
#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>
