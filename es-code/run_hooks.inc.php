<?PhP
function run_hooks($hook){
	global $esHooks;
	foreach($esHooks[$hook] as $funcao){
		$funcao();
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
