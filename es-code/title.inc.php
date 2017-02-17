<?PhP
function title($des = FALSE, $sep = ' - '){
	global $bd;
	$string		= '<title>' . config(3);
	if($des){
		if(reqvlr('news_id')) {
			$slquery	= $bd->query("SELECT ID, Titulo FROM ".BD_PREFIXO."News WHERE ID=".reqvlr('news_id'));
			if ($row = $bd->dados($slquery)) {
				$string	.= $sep . $row[1];
			}
			else {$string	.= $sep . config(5);}
		}
		else {
			$string	.= $sep . config(5);
		}
		
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
