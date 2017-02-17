<?PhP
function menu($menu = 0){
	global $bd;
	global $esMenu;
	$esMenu	= $bd->query("SELECT ID, Descricao, Link, Target FROM " . BD_PREFIXO . "Menu WHERE Activo = '1' AND Menu = '".$menu."' ORDER BY Pos ASC");
	if($bd->tem_linhas($esMenu)){
		return true;
	}else{
		return false;
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