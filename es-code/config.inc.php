<?PhP
function config($config){
	global $bd;
	$config	= $bd->query("SELECT Valor FROM ". BD_PREFIXO ."Config WHERE ID = '".$config."'");
	if($bd->tem_linhas($config)){
		$config	= $bd->dados($config);
		return $config[0];
	}else{
		return FALSE;
	}
}

#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		digama.net			    					#
#		evenSimpler@digama.net		    			#
#						    						#
#####################################################
?>
