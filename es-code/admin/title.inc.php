<?PhP
function title($des = FALSE, $sep = ' - '){
	global $bd;
	$string		= '<title>' . config(3);
	if($des){
		$string	.= $sep . I_ADMIN_PANEL;
	}
	$string		.= '</title>';
	return $string;
}
#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>
