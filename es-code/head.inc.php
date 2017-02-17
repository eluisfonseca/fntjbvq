<?PhP
function head(){
	global $bd;
	global $esJSInit;
	global $esJSResize;
	echo '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
	
	echo '<link href="' . SITE_ROOT . '/es-temas/' . config(1) . '/css/style.css" rel="stylesheet" type="text/css" />';
	echo '<link href="' . SITE_ROOT . '/es-temas/' . config(1) . '/css/bootstrap.css" rel="stylesheet" type="text/css" />';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/jquery-1.10.2.js"></script>';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/bootstrap.min.js"></script>';
	echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/js/code.js"></script>';
	if(file_exists(SERVER_ROOT . '/es-temas/' . config(1) . '/code.js')){
		echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-temas/' . config(1) . '/code.js"></script>';
	}
	run_hooks('head');
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
