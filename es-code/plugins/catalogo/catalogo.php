<?PhP
//Nome: Notícias
//Descrição: Cria uma área de notícias


if(!isset($slDados)){
	$slDados	= NULL;
	$slID		= NULL;
	$slNome	= NULL;
	$slDescricao		= NULL;
	$slDisp	= NULL;
	$slImg		= NULL;
	$slMImg		= NULL;
	$slImgDados = NULL;
	$slVis		= NULL;
	$slRef		= NULL;
	$slFab		= NULL;
	$slPrec		= NULL;
	$slTagDados		= NULL;
	$slTag		= NULL;
	$slStyle	= NULL;
	$slEstilosQuery = NULL;
	$slStyleID = NULL;
	$slEstacao	= NULL;
	$slEstacaoQuery = NULL;
	$slEstacaoID = NULL;
	$slTipo	= NULL;
	$slTipoQuery = NULL;
	$slTipoID = NULL;
	$slModelo	= NULL;
	$slModeloQuery = NULL;
	$slModeloID = NULL;
	$slCor	= NULL;
	$slCorQuery = NULL;
	$slCorID = NULL;
	$slMaterial	= NULL;
	$slMaterialQuery = NULL;
	$slMaterialID = NULL;
	$slMaterialPercent=NULL;
	$slTamanhosQuery=NULL;
	$slTamanho=NULL;
	$slTamanhoID=NULL;
	$num_results = NULL;
}

if(!function_exists('fuuu')){
	function fuuu(){
		echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/plugins/catalogo/catalogo.js"></script>';
	}
}
//
if(!function_exists('catalogo')){
	add_hook('head','fuuu');
	function catalogo($catalogo = 0){
		if(catalogo_getfive($catalogo)):
		echo '<div class="wrap">';
			while(catalogo_get_item()):
				get_plugin_template('catalogo', 'item');
			endwhile;
		echo '</div>';
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}

if(!function_exists('catalogoall')){
	function catalogoall($catalogo = 0){
		global $bd;
		global $slDados;
		if(reqvlr('apply')) {
			if(catalogo_filters($catalogo)):
			echo '<div class="wrap">';
					while(catalogo_get_item_filter()):
						get_plugin_template('catalogo', 'item');
					endwhile;
			echo '</div>';
			$pages;
			global $num_results;
			if(reqvlr('numero')) {
					$itemppage = reqvlr('numero');
				}
				else {
					$itemppage = 10;
				}
				if(round($num_results/$itemppage)>($num_results/$itemppage)) {
					$pages=round($num_results/$itemppage);
				}
				else {
					$pages=round($num_results/$itemppage)+1;
				}
				for ($i = 1; $i <= $pages; $i++) {
    				echo ' - <button type="submit" name="apply" value="'.$i.'" style="background:none!important;
     border:none;
     text-decoration:none;
	color:#0B6666;
	font-weight:bold;
	cursor:pointer;
	margin: 10px;">'.$i.'</button>';
				}
				echo ' - ';
				return TRUE;
			else:
				return FALSE;
			endif;
		}
		else {
			if(reqvlr('clear') || !reqvlr('apply')){
				if(catalogo_get($catalogo)):
				echo '<div class="wrap">';
					while(catalogo_get_item()):
						get_plugin_template('catalogo', 'item');
					endwhile;
				echo '</div>';
				$pages;
				global $num_results;
			if(reqvlr('numero')) {
					$itemppage = reqvlr('numero');
				}
				else {
					$itemppage = 10;
				}
				if(round($num_results/$itemppage)>($num_results/$itemppage)) {
					$pages=round($num_results/$itemppage);
				}
				else {
					$pages=round($num_results/$itemppage)+1;
				}
				for ($i = 1; $i <= $pages; $i++) {
    				echo ' - <button type="submit" name="apply" value="'.$i.'" style="background:none!important;
     border:none;
     text-decoration:none;
	color:#0B6666;
	font-weight:bold;
	cursor:pointer;
	margin: 10px;">'.$i.'</button>';
				}
				echo ' - ';
				return TRUE;
			else:
				return FALSE;
			endif;
			}
		}
	}
}

if(!function_exists('catalobyclass')){
	function catalobyclass($catalogo = 0){
		global $bd;
		global $slDados;
		if(reqvlr('apply')) {
			if(reqvlr('crit')=="all") {
				if(catalogo_class_filters(0,null)):
					echo '<div class="wrap">';
					while(catalogo_get_item_filter()):
						get_plugin_template('catalogo', 'item');
					endwhile;
					echo '</div>';
					$pages;
				global $num_results;
			if(reqvlr('numero')) {
					$itemppage = reqvlr('numero');
				}
				else {
					$itemppage = 10;
				}
				if(round($num_results/$itemppage)>($num_results/$itemppage)) {
					$pages=round($num_results/$itemppage);
				}
				else {
					$pages=round($num_results/$itemppage)+1;
				}
				for ($i = 1; $i <= $pages; $i++) {
    				echo ' - <button type="submit" name="apply" value="'.$i.'" style="background:none!important;
     border:none;
     text-decoration:none;
	color:#0B6666;
	font-weight:bold;
	cursor:pointer;
	margin: 10px;">'.$i.'</button>';
				}
				echo ' - ';
				return TRUE;
			else:
				return FALSE;
			endif;
			}
			if(reqvlr('crit')=="style") {
				catalogo_list_styles();
				while(catalogo_get_style_item()):
					echo '<h2 style="text-align:left; margin-left:20px;">'.catalogo_get_style().'</h2><hr>';
					if(catalogo_class_filters(1, catalogo_get_style_id())):
					global $num_results;
					if($num_results==0) {
						echo '<h4>Não existem resultados</h4>';
					}
					echo '<div class="wrap">';
					while(catalogo_get_item_filter()):
						get_plugin_template('catalogo', 'item');
					endwhile;
					echo '</div>';
					else:
						echo '<h4>Não existem resultados</h4>';
					endif;
					
				endwhile;
			}
			if(reqvlr('crit')=="model") {
				catalogo_list_modelos();
				while(catalogo_get_modelo_item()):
				echo '<h2 style="text-align:left; margin-left:20px;">'.catalogo_get_modelo().'</h2><hr>';
					if(catalogo_class_filters(2, catalogo_get_modelo_id())):
					global $num_results;
					if($num_results==0) {
						echo '<h4>Não existem resultados</h4>';
					}
					echo '<div class="wrap">';
					while(catalogo_get_item_filter()):
						get_plugin_template('catalogo', 'item');
					endwhile;
					echo '</div>';
					else:
						echo '<h4>Não existem resultados</h4>';
					endif;
				endwhile;
			}
			/*if(reqvlr('crit')=="model") {
				if(catalogo_class_filters(2)):
					echo '<div class="wrap">';
					while(catalogo_get_item_filter()):
						get_plugin_template('catalogo', 'item');
					endwhile;
					echo '</div>';
					return TRUE;
				else:
					return FALSE;
				endif;
			}*/
			if(reqvlr('crit')=="colection") {
				catalogo_list_estacoes();
				while(catalogo_get_estacao_item()):
				echo '<h2 style="text-align:left; margin-left:20px;">'.catalogo_get_estacao().'</h2><hr>';
					if(catalogo_class_filters(3, catalogo_get_estacao_id())):
					global $num_results;
					if($num_results==0) {
						echo '<h4>Não existem resultados</h4>';
					}
					echo '<div class="wrap">';
					while(catalogo_get_item_filter()):
						get_plugin_template('catalogo', 'item');
					endwhile;
					echo '</div>';
					else:
						echo '<h4>Não existem resultados</h4>';
					endif;
				endwhile;
			}
		}
		else {
			if(reqvlr('clear') || !reqvlr('apply')){
				if(catalogo_get($catalogo)):
				echo '<div class="wrap">';
					while(catalogo_get_item()):
						get_plugin_template('catalogo', 'item');
					endwhile;
				echo '</div>';
				$pages;
				global $num_results;
			if(reqvlr('numero')) {
					$itemppage = reqvlr('numero');
				}
				else {
					$itemppage = 10;
				}
				if(round($num_results/$itemppage)>($num_results/$itemppage)) {
					$pages=round($num_results/$itemppage);
				}
				else {
					$pages=round($num_results/$itemppage)+1;
				}
				for ($i = 1; $i <= $pages; $i++) {
    				echo ' - <button type="submit" name="apply" value="'.$i.'" style="background:none!important;
     border:none;
     text-decoration:none;
	color:#0B6666;
	font-weight:bold;
	cursor:pointer;
	margin: 10px;">'.$i.'</button>';
				}
				echo ' - ';
				return TRUE;
			else:
				return FALSE;
			endif;
			}
		}
	}
}

if(!function_exists('count_items')){
	function count_items(){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT COUNT(DISTINCT ID) FROM ".BD_PREFIXO."Catalogo_Search_Terms WHERE Visibilidade=1");
		$row = $bd->dados($slDados);
		return $row[0];
	}
}


/*
Aplicação de Filtros separados por critérios de organização
*/
if(!function_exists('catalogo_class_filters')){
	function catalogo_class_filters($criteria, $critID){
		global $bd;
		global $query_filter;
		global $num_results;
		$ORflag = 0;
		$flag = 0;
		$query_filter = "SELECT DISTINCT Nome, Imagem, ID FROM ".BD_PREFIXO."Catalogo_Search_Terms WHERE Visibilidade = '1'";
		if($criteria==1){
			$query_filter = $query_filter." AND IDEstilo=".$critID;
		}
		if($criteria==2){
			$query_filter = $query_filter." AND Modelo=".$critID;
		}
		if($criteria==3){
			$query_filter = $query_filter." AND Estacao=".$critID;
		}
		//TAMANHOS
		catalogo_list_tamanhos();
		while(catalogo_get_tamanho_item()):
					if(reqvlr('tamanho-'.catalogo_get_tamanho_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR IDTamanho=".catalogo_get_tamanho_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (IDTamanho=".catalogo_get_tamanho_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//TIPO
		catalogo_list_tipos();
		while(catalogo_get_tipo_item()):
					if(reqvlr('tipo-'.catalogo_get_tipo_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR Tipo=".catalogo_get_tipo_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (Tipo=".catalogo_get_tipo_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//COR
		catalogo_list_cores();
		while(catalogo_get_cor_item()):
					if(reqvlr('cor-'.catalogo_get_cor_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR IDCor=".catalogo_get_cor_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (IDCor=".catalogo_get_cor_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//MATERIAL
		catalogo_list_materiais();
		while(catalogo_get_material_item()):
					if(reqvlr('material-'.catalogo_get_material_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR IDMaterial=".catalogo_get_material_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (IDMaterial=".catalogo_get_material_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		$slDados	= $bd->query($query_filter);
		if($bd->tem_linhas($slDados)){
			$num_results = $bd->num_linhas($slDados);
		}
		if(reqvlr('numero')) {
			//echo "*** ".reqvlr('apply')." ***";
			if(reqvlr('apply')!= "Aplicar Filtro") {
				if(reqvlr('apply')==1) {
					$query_filter = $query_filter." LIMIT ".reqvlr('numero');
				}
				else {
					$p=reqvlr('apply')-1;
					$n = reqvlr('numero');
					$query_filter = $query_filter." LIMIT ".($n*$p).", ".$n;
				}
			}
			else {$query_filter = $query_filter." LIMIT ".reqvlr('numero');}
		}
		else{
				$query_filter = $query_filter." LIMIT 10";
		}
		//echo $query_filter;
		$slDados	= $bd->query($query_filter);
		if($bd->tem_linhas($slDados)){
			//$num_results = $bd->num_linhas($slDados);
			return TRUE;
		}else{
			return FALSE;
		}
	}
}


/*
Aplicação de Filtros
*/
if(!function_exists('catalogo_filters')){
	function catalogo_filters($catalogo = 0){
		global $bd;
		global $query_filter;
		global $num_results;
		$ORflag = 0;
		$flag = 0;
		$query_filter = "SELECT DISTINCT Nome, Imagem, ID FROM ".BD_PREFIXO."Catalogo_Search_Terms WHERE Visibilidade = '1'";
		//ESTILOS
		catalogo_list_styles();
		while(catalogo_get_style_item()):
					if(reqvlr('estilos-'.catalogo_get_style_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR IDEstilo=".catalogo_get_style_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (IDEstilo=".catalogo_get_style_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		/*echo $query_filter;*/
		//ESTAÇÕES
		catalogo_list_estacoes();
		while(catalogo_get_estacao_item()):
					if(reqvlr('colecao-'.catalogo_get_estacao_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR Estacao=".catalogo_get_estacao_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (Estacao=".catalogo_get_estacao_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//MODELOS
		catalogo_list_modelos();
		while(catalogo_get_modelo_item()):
					if(reqvlr('modelo-'.catalogo_get_modelo_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR Modelo=".catalogo_get_modelo_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (Modelo=".catalogo_get_modelo_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//TAMANHOS
		catalogo_list_tamanhos();
		while(catalogo_get_tamanho_item()):
					if(reqvlr('tamanho-'.catalogo_get_tamanho_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR IDTamanho=".catalogo_get_tamanho_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (IDTamanho=".catalogo_get_tamanho_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//TIPO
		catalogo_list_tipos();
		while(catalogo_get_tipo_item()):
					if(reqvlr('tipo-'.catalogo_get_tipo_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR Tipo=".catalogo_get_tipo_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (Tipo=".catalogo_get_tipo_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//COR
		catalogo_list_cores();
		while(catalogo_get_cor_item()):
					if(reqvlr('cor-'.catalogo_get_cor_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR IDCor=".catalogo_get_cor_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (IDCor=".catalogo_get_cor_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		//MATERIAL
		catalogo_list_materiais();
		while(catalogo_get_material_item()):
					if(reqvlr('material-'.catalogo_get_material_id())) {
						if ($ORflag) {
							$query_filter = $query_filter." OR IDMaterial=".catalogo_get_material_id();
							$flag = 1;
						}
						else {
							$query_filter = $query_filter." AND (IDMaterial=".catalogo_get_material_id();
							$ORflag = 1;
							$flag = 1;
						}
					}
				endwhile;
		if ($flag) {$query_filter = $query_filter.")";}
		$flag = 0;
		$ORflag = 0;
		$slDados	= $bd->query($query_filter);
		if($bd->tem_linhas($slDados)){
			$num_results = $bd->num_linhas($slDados);
		}
		if(reqvlr('numero')) {
			//echo "*** ".reqvlr('apply')." ***";
			if(reqvlr('apply')!= "Aplicar Filtro") {
				if(reqvlr('apply')==1) {
					$query_filter = $query_filter." LIMIT ".reqvlr('numero');
				}
				else {
					$p=reqvlr('apply')-1;
					$n = reqvlr('numero');
					$query_filter = $query_filter." LIMIT ".($n*$p).", ".$n;
				}
			}
			else {$query_filter = $query_filter." LIMIT ".reqvlr('numero');}
		}
		else{
				$query_filter = $query_filter." LIMIT 10";
		}
		//echo $query_filter;
		$slDados	= $bd->query($query_filter);
		if($bd->tem_linhas($slDados)){
			//$num_results = $bd->num_linhas($slDados);
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_item_filter')){
	function catalogo_get_item_filter(){
		global $bd;
		global $slDados;
		global $slID;
		global $slNome;
		global $slMImg;
		if($row = $bd->dados($slDados)){
			$slID		= $row[2];
			$slNome	= $row[0];
			$slMImg		= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

/**********************************/
if(!function_exists('catalogo_get')){
	function catalogo_get($catalogo = 0){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT p.Nome, p.Descricao, i.Imagem, p.Disponibilidade, p.ID, p.Visibilidade FROM ".BD_PREFIXO."Catalogo as p INNER JOIN ".BD_PREFIXO."Catalogo_Produtos_Imagens as i ON p.ID = i.IDProduto WHERE Visibilidade = '1' AND i.Principal=1");
		if($bd->tem_linhas($slDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_getfive')){
	function catalogo_getfive($catalogo = 0){
		global $bd;
		global $slDados;
		$slDados	= $bd->query("SELECT p.Nome, p.Descricao, i.Imagem, p.Disponibilidade, p.ID, p.Visibilidade FROM ".BD_PREFIXO."Catalogo as p INNER JOIN ".BD_PREFIXO."Catalogo_Produtos_Imagens as i ON p.ID = i.IDProduto WHERE Visibilidade = '1' AND i.Principal=1 LIMIT 5");
		if($bd->tem_linhas($slDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_one')){
	function catalogo_get_one($productID){
		global $bd;
		global $slDados;
		add_hook('head','fuuu');
		$slDados	= $bd->query("SELECT p.Nome, p.Descricao, i.Imagem, p.Disponibilidade, p.ID, p.Visibilidade, p.Referencia, p.Fabrico, p.Preco, e.Descricao, t.Descricao, m.Descricao FROM ".BD_PREFIXO."Catalogo as p INNER JOIN ".BD_PREFIXO."Catalogo_Produtos_Imagens as i ON p.ID = i.IDProduto INNER JOIN ".BD_PREFIXO."Catalogo_Estacao as e ON p.Estacao=e.ID INNER JOIN ".BD_PREFIXO."Catalogo_Modelos as m ON p.Modelo=m.ID INNER JOIN ".BD_PREFIXO."Catalogo_Tipos as t ON p.Tipo=t.ID WHERE p.ID = ".$productID." AND i.Principal=1");

		/*$slTags	= $bd->query("SELECT p.Nome, p.Descricao, p.Imagem, p.Disponibilidade, p.ID, p.Visibilidade, cat.IDCat, c.Descricao FROM ".BD_PREFIXO."Catalogo AS p INNER JOIN ".BD_PREFIXO."ProdutosCategorias as cat ON p.ID=cat.IDProd INNER JOIN ".BD_PREFIXO."CatCategorias as c ON cat.IDCat=c.ID WHERE ID = ".$productID);*/
		/*$slTagDados	= $bd->query("SELECT cat.IDCat, c.Descricao FROM ".BD_PREFIXO."Catalogo AS p INNER JOIN ".BD_PREFIXO."ProdutosCategorias as cat ON p.ID=cat.IDProd INNER JOIN ".BD_PREFIXO."CatCategorias as c ON cat.IDCat=c.ID WHERE ID = ".$productID);*/
		if($bd->tem_linhas($slDados) /*&& $bd->tem_linhas($slTagDados)*/){
			catalogo_get_product();
			get_plugin_template('catalogo', 'produto');
			return TRUE;
		}else{
			return FALSE;
		}
	}
}


if(!function_exists('catalogo_get_item')){
	function catalogo_get_item(){
		global $bd;
		global $slDados;
		global $slID;
		global $slNome;
		global $slDescricao;
		global $slMImg;
		global $slDisp;
		global $slVis;
		global $slVis;
		if($row = $bd->dados($slDados)){
			$slID		= $row[4];
			$slNome	= $row[0];
			$slDescricao	= $row[1];
			$slMImg		= $row[2];
			$slDisp		= $row[3];
			$slVis		= $row[5];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_product')){
	function catalogo_get_product(){
		global $bd;
		global $slDados;
		global $slID;
		global $slNome;
		global $slDescricao;
		global $slMImg;
		global $slDisp;
		global $slVis;
		global $slRef;
		global $slEstacao;
		global $slTipo;
		global $slModelo;
		global $slFab;
		global $slPrec;
		if($row = $bd->dados($slDados)){
			$slID		= $row[4];
			$slNome	= $row[0];
			$slDescricao	= $row[1];
			$slMImg		= $row[2];
			$slDisp		= $row[3];
			$slVis		= $row[5];
			$slRef = $row[6];
			$slFab = $row[7];
			$slPrec = $row[8];
			$slEstacao= $row[9];
			$slTipo= $row[10];
			$slModelo= $row[11];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}


if(!function_exists('catalogo_get_id')){
	function catalogo_get_id(){
		global $bd;
		global $slID;
		return $slID;
	}
}
if(!function_exists('catalogo_get_name')){
	function catalogo_get_name(){
		global $bd;
		global $slNome;
		return $slNome;
	}
}
if(!function_exists('catalogo_get_desc')){
	function catalogo_get_desc(){
		global $bd;
		global $slDescricao;
		return $slDescricao;
	}
}
if(!function_exists('catalogo_get_main_img')){
	function catalogo_get_main_img(){
		global $bd;
		global $slMImg;
		return SITE_ROOT.DATA_DIR.'/catalogo/'.$slMImg;
	}
}
if(!function_exists('catalogo_get_disp')){
	function catalogo_get_disp(){
		global $bd;
		global $slDisp;
		return $slDisp;
	}
}
if(!function_exists('catalogo_get_visibility')){
	function catalogo_get_visibility(){
		global $bd;
		global $slVis;
		return $slVis;
	}
}

if(!function_exists('catalogo_get_imagens')){
	function catalogo_get_imagens($productID){
		global $bd;
		global $slImgDados;
		$slImgDados	= $bd->query("SELECT i.Imagem FROM ".BD_PREFIXO."Catalogo_Produtos_Imagens AS i INNER JOIN ".BD_PREFIXO."Catalogo as p ON i.IDProduto=p.ID WHERE p.ID = '".$productID."' ORDER BY Principal DESC");
		if($bd->tem_linhas($slImgDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_image_item')){
	function catalogo_get_image_item(){
		global $bd;
		global $slImgDados;
		global $slImg;
		if($row = $bd->dados($slImgDados)){
			$slImg	= $row[0];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_sec_img')){
	function catalogo_get_sec_img(){
		global $bd;
		global $slImg;
		return SITE_ROOT.DATA_DIR.'/catalogo/'.$slImg;
	}
}


/*
Métodos de obter Categorias
*/
if(!function_exists('catalogo_get_tags')){
	function catalogo_get_tags($productID){
		global $bd;
		global $slTagDados;
		$slTagDados	= $bd->query("SELECT c.Descricao FROM ".BD_PREFIXO."Catalogo AS p INNER JOIN ".BD_PREFIXO."Catalogo_Produtos_Categorias as cat ON p.ID=cat.IDProd INNER JOIN ".BD_PREFIXO."Catalogo_Categorias as c ON cat.IDCat=c.ID WHERE p.ID = '".$productID."'");
		if($bd->tem_linhas($slTagDados)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_tag_item')){
	function catalogo_get_tag_item(){
		global $bd;
		global $slTagDados;
		global $slTag;
		if($row = $bd->dados($slTagDados)){
			$slTag	= $row[0];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('catalogo_tag')){
	function catalogo_tag(){
		global $slTag;
		return $slTag;
	}
}

/*
Obter Estilos para procura
*/

if(!function_exists('catalogo_list_styles')){
	function catalogo_list_styles(){
		global $bd;
		global $slEstilosQuery;
		$slEstilosQuery	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Estilos");
		if($bd->tem_linhas($slEstilosQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_product_styles')){
	function catalogo_product_styles($productID){
		global $bd;
		global $slEstilosQuery;
		$slEstilosQuery	= $bd->query("SELECT e.ID, e.Descricao FROM ".BD_PREFIXO."Catalogo_Produtos_Estilos as p INNER JOIN ".BD_PREFIXO."Catalogo_Estilos as e ON p.IDEstilo=e.ID WHERE p.IDProduto = '".$productID."'");
		if($bd->tem_linhas($slEstilosQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_style_item')){
	function catalogo_get_style_item(){
		global $bd;
		global $slEstilosQuery;
		global $slStyle;
		global $slStyleID;
		if($row = $bd->dados($slEstilosQuery)){
			$slStyleID	= $row[0];
			$slStyle	= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('catalogo_get_style')){
	function catalogo_get_style(){
		global $slStyle;
		return $slStyle;
	}
}

if(!function_exists('catalogo_get_style_id')){
	function catalogo_get_style_id(){
		global $slStyleID;
		return $slStyleID;
	}
}

/*
Obter Estações par procura
*/

if(!function_exists('catalogo_list_estacoes')){
	function catalogo_list_estacoes(){
		global $bd;
		global $slEstacaoQuery;
		$slEstacaoQuery	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Estacao");
		if($bd->tem_linhas($slEstacaoQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_estacao_item')){
	function catalogo_get_estacao_item(){
		global $bd;
		global $slEstacaoQuery;
		global $slEstacao;
		global $slEstacaoID;
		if($row = $bd->dados($slEstacaoQuery)){
			$slEstacaoID	= $row[0];
			$slEstacao	= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('catalogo_get_estacao')){
	function catalogo_get_estacao(){
		global $slEstacao;
		return $slEstacao;
	}
}

if(!function_exists('catalogo_get_estacao_id')){
	function catalogo_get_estacao_id(){
		global $slEstacaoID;
		return $slEstacaoID;
	}
}

/*
Obter Tipos para procura
*/

if(!function_exists('catalogo_list_tipos')){
	function catalogo_list_tipos(){
		global $bd;
		global $slTiposQuery;
		$slTiposQuery	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Tipos");
		if($bd->tem_linhas($slTiposQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_tipo_item')){
	function catalogo_get_tipo_item(){
		global $bd;
		global $slTiposQuery;
		global $slTipo;
		global $slTipoID;
		if($row = $bd->dados($slTiposQuery)){
			$slTipoID	= $row[0];
			$slTipo	= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('catalogo_get_tipo')){
	function catalogo_get_tipo(){
		global $slTipo;
		return $slTipo;
	}
}

if(!function_exists('catalogo_get_tipo_id')){
	function catalogo_get_tipo_id(){
		global $slTipoID;
		return $slTipoID;
	}
}

/*
Obter Modelos para procura
*/

if(!function_exists('catalogo_list_modelos')){
	function catalogo_list_modelos(){
		global $bd;
		global $slModelosQuery;
		$slModelosQuery	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Modelos");
		if($bd->tem_linhas($slModelosQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_modelo_item')){
	function catalogo_get_modelo_item(){
		global $bd;
		global $slModelosQuery;
		global $slModelo;
		global $slModeloID;
		if($row = $bd->dados($slModelosQuery)){
			$slModeloID	= $row[0];
			$slModelo	= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('catalogo_get_modelo')){
	function catalogo_get_modelo(){
		global $slModelo;
		return $slModelo;
	}
}

if(!function_exists('catalogo_get_modelo_id')){
	function catalogo_get_modelo_id(){
		global $slModeloID;
		return $slModeloID;
	}
}

/*
Obter Cores para procura
*/

if(!function_exists('catalogo_list_cores')){
	function catalogo_list_cores(){
		global $bd;
		global $slCoresQuery;
		$slCoresQuery	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Cores");
		if($bd->tem_linhas($slCoresQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_product_cores')){
	function catalogo_product_cores($productID){
		global $bd;
		global $slCoresQuery;
		$slCoresQuery	= $bd->query("SELECT c.ID, c.Descricao FROM ".BD_PREFIXO."Catalogo_Produtos_Cores as p INNER JOIN ".BD_PREFIXO."Catalogo_Cores as c ON p.IDCor=c.ID WHERE p.IDProduto = '".$productID."'");
		if($bd->tem_linhas($slCoresQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_cor_item')){
	function catalogo_get_cor_item(){
		global $bd;
		global $slCoresQuery;
		global $slCor;
		global $slCorID;
		if($row = $bd->dados($slCoresQuery)){
			$slCorID	= $row[0];
			$slCor	= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('catalogo_get_cor')){
	function catalogo_get_cor(){
		global $slCor;
		return $slCor;
	}
}

if(!function_exists('catalogo_get_cor_id')){
	function catalogo_get_cor_id(){
		global $slCorID;
		return $slCorID;
	}
}

/*
Obter Materiais para procura
*/

if(!function_exists('catalogo_list_materiais')){
	function catalogo_list_materiais(){
		global $bd;
		global $slMaterialQuery;
		$slMaterialQuery	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Materiais");
		if($bd->tem_linhas($slMaterialQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_product_materiais')){
	function catalogo_product_materiais($productID){
		global $bd;
		global $slMaterialQuery;
		$slMaterialQuery	= $bd->query("SELECT m.ID, m.Descricao, p.Percentagem FROM ".BD_PREFIXO."Catalogo_Produtos_Materiais as p INNER JOIN ".BD_PREFIXO."Catalogo_Materiais as m ON p.IDMaterial=m.ID WHERE p.IDProduto = '".$productID."' ORDER BY p.Percentagem DESC");
		if($bd->tem_linhas($slMaterialQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_material_item')){
	function catalogo_get_material_item(){
		global $bd;
		global $slMaterialQuery;
		global $slMaterial;
		global $slMaterialID;
		if($row = $bd->dados($slMaterialQuery)){
			$slMaterialID	= $row[0];
			$slMaterial	= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_material_details')){
	function catalogo_get_material_details(){
		global $bd;
		global $slMaterialQuery;
		global $slMaterial;
		global $slMaterialID;
		global $slMaterialPercent;
		if($row = $bd->dados($slMaterialQuery)){
			$slMaterialID	= $row[0];
			$slMaterial	= $row[1];
			$slMaterialPercent = $row[2];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_material')){
	function catalogo_get_material(){
		global $slMaterial;
		return $slMaterial;
	}
}

if(!function_exists('catalogo_get_material_percentagem')){
	function catalogo_get_material_percentagem(){
		global $slMaterialPercent;
		return $slMaterialPercent;
	}
}

if(!function_exists('catalogo_get_material_id')){
	function catalogo_get_material_id(){
		global $slMaterialID;
		return $slMaterialID;
	}
}


/*
Obter Tamanhos para procura
*/

if(!function_exists('catalogo_list_tamanhos')){
	function catalogo_list_tamanhos(){
		global $bd;
		global $slTamanhosQuery;
		$slTamanhosQuery	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Tamanhos");
		if($bd->tem_linhas($slTamanhosQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_product_tamanhos')){
	function catalogo_product_tamanhos($productID){
		global $bd;
		global $slTamanhosQuery;
		$slTamanhosQuery	= $bd->query("SELECT t.ID, t.Descricao FROM ".BD_PREFIXO."Catalogo_Produtos_Tamanhos as p INNER JOIN ".BD_PREFIXO."Catalogo_Tamanhos as t ON p.IDTamanho=t.ID WHERE p.IDProduto = '".$productID."'");
		if($bd->tem_linhas($slTamanhosQuery)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('catalogo_get_tamanho_item')){
	function catalogo_get_tamanho_item(){
		global $bd;
		global $slTamanhosQuery;
		global $slTamanho;
		global $slTamanhoID;
		if($row = $bd->dados($slTamanhosQuery)){
			$slTamanhoID	= $row[0];
			$slTamanho	= $row[1];
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
if(!function_exists('catalogo_get_tamanho')){
	function catalogo_get_tamanho(){
		global $slTamanho;
		return $slTamanho;
	}
}

if(!function_exists('catalogo_get_tamanho_id')){
	function catalogo_get_tamanho_id(){
		global $slTamanhoID;
		return $slTamanhoID;
	}
}

//OUTROS

if(!function_exists('catalogo_get_refencia')){
	function catalogo_get_refencia(){
		global $bd;
		global $slRef;
		return $slRef;
	}
}

if(!function_exists('catalogo_get_fabrico')){
	function catalogo_get_fabrico(){
		global $bd;
		global $slFab;
		return $slFab;
	}
}

if(!function_exists('catalogo_get_preco')){
	function catalogo_get_preco(){
		global $bd;
		global $slPrec;
		return $slPrec;
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
