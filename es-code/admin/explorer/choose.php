<?PhP
require_once("../../../es-admin/config.inc.php");
require_once(SERVER_ROOT. "/es-code/idiomas/" . IDIOMA . ".inc.php");

echo "<script type=\"text/javascript\" src=\"../../js/tinymce/tiny_mce_popup.js\"></script>";
echo "<script type=\"text/javascript\" src=\"explorer.js\"></script>";
echo "<link href=\"explorer.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "<body>";
echo "<div id=\"explorer\">";
	if(isset($_REQUEST["c"])){
		$caminho	= str_replace("../", "", $_REQUEST["c"]);
	}else{
		$caminho	= DATA_DIR;
	}
	echo "<div id=\"caminho\">" . $caminho . "</div>";
	echo "<div id=\"upload\">" . L_SELECTFILE . " ";
		echo "<form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\" name=\"upform\" target=\"_self\">";
		echo "<input name=\"Upload\" type=\"file\" size=\"40\">";
		echo "</form>";
	echo "</div>";
	/*if(is_file(SERVER_ROOT . DATA_DIR . "/" . $item)){
		echo "<div class=\"ficheiro\">" . $item . "</div>";
	}*/
	
	echo "<a href=\"javascript:enviar();\" target=\"_self\"><div id=\"botao1\">" . L_UPLOAD . "</div></a>";
	echo "<a href=\"explorer.php\" target=\"_self\"><div id=\"botao2\">" . L_BACK . "</div></a>";
	
echo "</div>";
echo "</body>";
#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>
