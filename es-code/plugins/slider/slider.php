<?PhP
//Nome: Slider
//Descrição: Cria um Slider de imagens.
if(!isset($slDados)){
	$slDados	= NULL;
	$slID		= NULL;
	$slTitle	= NULL;
	$slContent	= NULL;
	$slFoto		= NULL;
}
//
if(!function_exists('slider')){
	function slider($slider = 0){
		if(slider_get($slider)):
			echo '<div id="slider">';
			while(slider_get_item()):
				get_plugin_template('slider', 'item');
			endwhile;
			echo '</div>';
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}
if(!function_exists('slider_js')){
	function slider_js(){
		//global $esHooks;
		echo '<link href="' . PLUGIN_ROOT . '/slider/slider.css" rel="stylesheet" type="text/css" />';
		echo '<script type="text/javascript" src="' . PLUGIN_ROOT . '/slider/slider.js"></script>';
	}
	addJSinit('slider();');
	addJSresize('sliderResize();');
	add_hook('head', 'slider_js');
}
if(!function_exists('slider_get')){
	function slider_get($slider = 0){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT Titulo, Descricao, Foto, ID FROM ".BD_PREFIXO."Slider WHERE Activo = '1' AND Slider = '".$slider."' ORDER BY Pos ASC");
		if($bd->tem_linhas($slDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('slider_get_item')){
	function slider_get_item(){
		global $bd;
		global $slDados;
		global $slID;
		global $slTitle;
		global $slContent;
		global $slFoto;
		if($row = $bd->dados($slDados)){
			$slID		= $row[3];
			$slTitle	= $row[0];
			$slContent	= $row[1];
			$slFoto		= $row[2];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('slider_get_id')){
	function slider_get_id(){
		global $bd;
		global $slID;
		return $slID;
	}
}
if(!function_exists('slider_get_title')){
	function slider_get_title(){
		global $bd;
		global $slTitle;
		return $slTitle;
	}
}
if(!function_exists('slider_get_content')){
	function slider_get_content(){
		global $bd;
		global $slContent;
		return $slContent;
	}
}
if(!function_exists('slider_get_image')){
	function slider_get_image(){
		global $bd;
		global $slFoto;
		return SITE_ROOT.DATA_DIR.'/'.$slFoto;
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
