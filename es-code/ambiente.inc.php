<?PhP

$bd	= new acbd();

if(reqvlr('p')){
	$esPage	= reqvlr('p');
}else{
	$esPage	= 'index';
}

$esMenu		= NULL;
$esPaginas	= NULL;
$esID		= NULL;
$esTitle	= NULL;
$esLink		= NULL;
$esTarget	= NULL;
$esContent	= NULL;

//Hooks
$esHooks			= array();
$esHooks['head']	= array();

$esJSInit			= array();
$esJSResize			= array();


plugins();

header("Content-Type: text/html; charset=" . config(4));

#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>
