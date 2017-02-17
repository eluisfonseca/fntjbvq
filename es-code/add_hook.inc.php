<?PhP
function add_hook($hook, $funcao){
	global $esHooks;
	array_push($esHooks[$hook], $funcao);
}
#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>
