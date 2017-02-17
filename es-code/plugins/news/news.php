<?PhP
//Nome: Notícias
//Descrição: Cria uma área de notícias
if(!isset($slDados)){
	$slDados	= NULL;
	$slID		= NULL;
	$slTitle	= NULL;
	$slDate		= NULL;
	$slResumo	= NULL;
	$slFoto		= NULL;
	$slTexto	= NULL;
}
//
if(!function_exists('news')){
	function news($news = 0){
		if(news_getfive($news)):
			while(news_get_item()):
				get_plugin_template('news', 'item');
			endwhile;
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}

if(!function_exists('newsall')){
	function newsall($news = 0){
		if(news_get($news)):
			while(news_get_item()):
				get_plugin_template('news', 'item');
			endwhile;
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}

//NOVIDADES

if(!function_exists('novidades')){
	function novidades($novs = 0){
		if(novs_getfive($novs)):
			while(news_get_item()):
				get_plugin_template('news', 'item');
			endwhile;
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}

if(!function_exists('novsall')){
	function novsall($novs = 0){
		if(novs_get($novs)):
			while(news_get_item()):
				get_plugin_template('news', 'item');
			endwhile;
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}

if(!function_exists('novs_get')){
	function novs_get($novs = 0){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT Titulo, Data, Resumo, Imagem, ID, Texto FROM ".BD_PREFIXO."News WHERE Publicada = '1' AND Tipo = '2' ORDER BY Data DESC");
		if($bd->tem_linhas($slDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('novs_getfive')){
	function novs_getfive($novs = 0){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT Titulo, Data, Resumo, Imagem, ID, Texto FROM ".BD_PREFIXO."News WHERE Publicada = '1' AND Tipo = '2' ORDER BY Data DESC LIMIT 5");
		if($bd->tem_linhas($slDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

//////

if(!function_exists('news_get')){
	function news_get($news = 0){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT Titulo, Data, Resumo, Imagem, ID, Texto FROM ".BD_PREFIXO."News WHERE Publicada = '1' AND Tipo = '1' ORDER BY Data DESC");
		if($bd->tem_linhas($slDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('news_getfive')){
	function news_getfive($news = 0){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT Titulo, Data, Resumo, Imagem, ID, Texto FROM ".BD_PREFIXO."News WHERE Publicada = '1' AND Tipo = '1' ORDER BY Data DESC LIMIT 5");
		if($bd->tem_linhas($slDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('news_get_one')){
	function news_get_one($news){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT Titulo, Data, Resumo, Imagem, ID, Texto FROM ".BD_PREFIXO."News WHERE Publicada = '1' AND ID = ".$news);
		if($bd->tem_linhas($slDados)){
			news_get_item();
			get_plugin_template('news', 'noticia');
			return TRUE;
		}else{
			return FALSE;
		}
	}
}



if(!function_exists('news_get_item')){
	function news_get_item(){
		global $bd;
		global $slDados;
		global $slID;
		global $slTitle;
		global $slDate;
		global $slResumo;
		global $slFoto;
		global $slTexto;
		if($row = $bd->dados($slDados)){
			$slID		= $row[4];
			$slTitle	= $row[0];
			$slResumo	= $row[2];
			$slDate		= $row[1];
			$slFoto		= $row[3];
			$slTexto	= $row[5];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('news_get_id')){
	function news_get_id(){
		global $bd;
		global $slID;
		return $slID;
	}
}
if(!function_exists('news_get_title')){
	function news_get_title(){
		global $bd;
		global $slTitle;
		return $slTitle;
	}
}
if(!function_exists('news_get_resumo')){
	function news_get_resumo(){
		global $bd;
		global $slResumo;
		return $slResumo;
	}
}
if(!function_exists('news_get_date')){
	function news_get_date(){
		global $bd;
		global $slDate;
		return $slDate;
	}
}
if(!function_exists('news_get_image')){
	function news_get_image(){
		global $bd;
		global $slFoto;
		return SITE_ROOT.DATA_DIR.'/'.$slFoto;
	}
}
if(!function_exists('news_get_text')){
	function news_get_text(){
		global $bd;
		global $slTexto;
		return $slTexto;
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
