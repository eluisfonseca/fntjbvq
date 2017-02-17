<?PhP
function item(){
	global $bd;
	global $esMenu;
	global $esID;
	global $esTitle;
	global $esLink;
	global $esTarget;
	if($Row = $bd->dados($esMenu)){
		$esID		= $Row[0];
		$esTitle	= $Row[1];
		$esLink		= $Row[2];
		$esTarget	= $Row[3];
		return TRUE;
	}else{
		return FALSE;
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