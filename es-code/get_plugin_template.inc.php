<?PhP
function get_plugin_template($plugin, $template){
	global $bd;
	include(SERVER_ROOT."/es-code/plugins/" . $plugin . "/" . $template . ".php");
}
#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>
