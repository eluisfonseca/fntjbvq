<?PhP
add_hook('admin_head','fuuu');

if(!function_exists('fuuu')){
	function fuuu(){
		echo '<script type="text/javascript" src="' . SITE_ROOT . '/es-code/plugins/catalogo/catalogo.js"></script>';
	}
}

if(!function_exists('catalogo')){
	function catalogo(){
		
		global $bd;
		echo '<h1>'.I_PRODUCTS.'</h1>';
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_PRODUCT.'</th>',
			'<th>'.I_MAINIMG.'</th>',
			'<th>'.I_STOCK.'</th>',
			'<th>'.I_VISIBILITY.'</th>',
			'<th>'.I_ACTIONS.'</th>',
		'</tr>';
		
		$noticias	= $bd->query("SELECT p.Nome, p.Descricao, i.Imagem, p.Disponibilidade, p.ID, p.Visibilidade FROM ".BD_PREFIXO."Catalogo as p INNER JOIN ".BD_PREFIXO."Catalogo_Produtos_Imagens as i ON p.ID = i.IDProduto WHERE i.Principal=1");
		
			while($row = $bd->dados($noticias)){
				echo '<tr>',
				'<td>'.$row[0].'</td>';
				echo '<td> <img src="'.SITE_ROOT.DATA_DIR.'/catalogo/'.$row[2].'" style="width:50px;"></td>';
				if($row[3] == 1){
					echo '<td><a href="?h=changeStockState&product_id='.$row[4].'" >'.I_INSTOCK.'</a></td>';
				}else{
					echo '<td><a href="?h=changeStockState&product_id='.$row[4].'" >'.I_OUTOFSTOCK.'</a></td>';
				}
				if($row[5] == 1){
					echo '<td><a href="?h=changeVisState&product_id='.$row[4].'" >'.I_VIS_STATE_ON.'</a></td>';
				}else{
					echo '<td><a href="?h=changeVisState&product_id='.$row[4].'" >'.I_VIS_STATE_HIDDEN.'</a></td>';
				}
				echo '<td><a href="?c=producteditor&product_id='.$row[0].'">'.I_EDIT.'</a> | <a href="?h=productDelete&product_id='.$row[0].'">'.I_DELETE.'</a></td>';
				echo '</tr>';
			}
			echo '<tr><td colspan="5" style="text-align: right; font-size:100%;"><a href="?c=product_criador">'.I_ADD.'</a></td></tr>';
			echo '</table>';
			//echo '$("#publica").click(function(){ execFunc(\'index.php?h=change_pubstate\', \'index.php?c=news\'); return false; });'; onclick="javascript:execFunc(\'index.php?h=change_pubstate&news_id='.$row[0].'\', \'index.php?c=news\');"
			
			echo '<br><h1 id="stl">'.I_STYLES.'</h1>';
			list_styles();

			echo '<br><h1 id="est">'.I_SEASONS.'</h1>';
			list_seasons();

			echo '<br><h1 id="cor">'.I_COLOURS.'</h1>';
			list_cores();
			
			echo '<br><h1 id="mat">'.I_MATERIALS.'</h1>';
			list_materiais();

			echo '<br><h1 id="mod">'.I_MODELS.'</h1>';
			list_modelos();

			echo '<br><h1 id="tam">'.I_SIZES.'</h1>';
			list_tamanhos();

			echo '<br><h1 id="tip">'.I_PIECES.'</h1>';
			list_tipos();

			if(reqvlr('pageloc')) {
				echo '<script type="text/javascript"> $(document).ready(gotolocation($(\'#'.reqvlr('pageloc').'\')));</script>'; //scrollToElement();
			}
	}
}



/*
FUNÇÕES REFERENTES AOS ESTILOS
*/

//LISTAS TABELA DOS ESTILOS
if(!function_exists('list_styles')){
	function list_styles() {
		global $bd;
		$estilos	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Estilos");
		if($bd->tem_Linhas($estilos)) {
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_STYLE.'</th>',
			'<th style="text-align:right;">'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($estilos)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td style="text-align:right;"><a href="?c=catalogo" class="unobtrusive" onclick="displayForm(\'styleeditform-'.$row[0].'\')" >'.I_EDIT.'</a>';
				echo ' | <a href="?h=style_delete&style_id='.$row[0].'">'.I_DELETE.'</a>';
				echo '<form method="post" onsubmit="return false;" action="" style=" margin-left:30px; display:none;" id="styleeditform-'.$row[0].'">';
				echo '<input type="text" name="editStyle">';
				echo '<input type="submit" value="'.I_OK.'" onclick="javascript:gravarNoticias(this.form, \'index.php?h=style_editor&style_id='.$row[0].'&\', \'index.php?c=catalogo&pageloc=stl\');">';
				echo '<input type="submit" value="'.I_CANCEL.'" onclick="javascript:hideForm(\'styleeditform-'.$row[0].'\');">';
				echo '</form></td>';
			echo '</tr>';
			}
			echo '</table>';
			echo '<form method="post" onsubmit="return false;" action="" style="text-align:right;">';
			echo I_NEW_STYLE.': <input type="text" name="newStyle">';
			echo '<input type="submit" value="'.I_ADD.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=add_style\', \'index.php?c=catalogo&pageloc=stl\');">';
			echo '</form>';
		}
	}
}

//CRIAR NOVO ESTILO
if(!function_exists('add_style')){
	function add_style(){
		global $bd;
		$titulo=reqvlr('newStyle');
		$saveQ;
		if(reqvlr('newStyle')) {
			$saveQ = $bd->query( "INSERT INTO ".BD_PREFIXO."Catalogo_Estilos (Descricao) VALUES('".$titulo."')" );
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}

//ELIMINAR ESTILO
if(!function_exists('style_delete')){
	function style_delete(){
		global $bd;
		if(reqvlr('style_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Catalogo_Estilos WHERE ID =".reqvlr('style_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=catalogo&pageloc=stl");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=catalogo&pageloc=stl");
			}
		}
	}
}

//EDITAR ESTILO
if(!function_exists('style_editor')){
	function style_editor(){
		global $bd;
		$saveQ;
		if(reqvlr('editStyle')) {
			$titulo=reqvlr('editStyle');
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Catalogo_Estilos SET Descricao = '".$titulo."' WHERE ID =".reqvlr('style_id'));
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}


/*
FUNÇÕES REFERENTES ÀS ESTAÇÕES
*/

//LISTA TABELA DAS ESTAÇÕES
if(!function_exists('list_seasons')){
	function list_seasons() {
		global $bd;
		$estacoes	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Estacao");
		if($bd->tem_Linhas($estacoes)) {
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_STYLE.'</th>',
			'<th style="text-align:right;">'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($estacoes)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td style="text-align:right;"><a href="?c=catalogo" class="unobtrusive" onclick="displayForm(\'seasoneditform-'.$row[0].'\')" >'.I_EDIT.'</a>';
				echo ' | <a href="?h=season_delete&season_id='.$row[0].'">'.I_DELETE.'</a>';
				echo  '<form method="post" onsubmit="return false;" action="" style=" margin-left:30px; display:none;" id="seasoneditform-'.$row[0].'">';
				echo '<input type="text" name="editSeason">';
				echo '<input type="submit" value="'.I_OK.'" onclick="javascript:gravarNoticias(this.form, \'index.php?h=season_editor&season_id='.$row[0].'&\', \'index.php?c=catalogo&pageloc=est\');">';
				echo '<input type="submit" value="'.I_CANCEL.'" onclick="javascript:hideForm(\'seasoneditform-'.$row[0].'\');">';
				echo '</form></td>';
			echo '</tr>';
			}
			echo '</table>';
			echo '<form method="post" onsubmit="return false;" action="" style="text-align:right;">';
			echo I_NEW_SEASON.': <input type="text" name="newSeason">';
			echo '<input type="submit" value="'.I_ADD.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=add_season\', \'index.php?c=catalogo&pageloc=est\');">';
			echo '</form>';
		}
	}
}

//CRIAR NOVO ESTAÇÃO
if(!function_exists('add_season')){
	function add_season(){
		global $bd;
		$titulo=reqvlr('newSeason');
		$saveQ;
		if(reqvlr('newSeason')) {
			$saveQ = $bd->query( "INSERT INTO ".BD_PREFIXO."Catalogo_Estacao (Descricao) VALUES('".$titulo."')" );
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}

//ELIMINAR ESTAÇÃO
if(!function_exists('season_delete')){
	function season_delete(){
		global $bd;
		if(reqvlr('season_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Catalogo_Estacao WHERE ID =".reqvlr('season_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=catalogo&pageloc=est");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=catalogo&pageloc=est");
			}
		}
	}
}

//EDITAR ESTAÇÃO
if(!function_exists('season_editor')){
	function season_editor(){
		global $bd;
		$saveQ;
		if(reqvlr('editSeason')) {
			$titulo=reqvlr('editSeason');
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Catalogo_Estacao SET Descricao = '".$titulo."' WHERE ID =".reqvlr('season_id'));
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}

/*
FUNÇÕES REFERENTES ÀS CORES
*/
//LISTAR CORES
if(!function_exists('list_cores')){
	function list_cores() {
		global $bd;
		$cores	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Cores");
		if($bd->tem_Linhas($cores)) {
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_COLOUR.'</th>',
			'<th style="text-align:right;">'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($cores)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td style="text-align:right;"><a href="?c=catalogo" class="unobtrusive" onclick="displayForm(\'editform-'.$row[0].'\')" >'.I_EDIT.'</a> | <a href="?h=colour_delete&cor_id='.$row[0].'">'.I_DELETE.'</a>';
				echo  '<form method="post" onsubmit="return false;" action="" style=" margin-left:30px; display:none;" id="editform-'.$row[0].'">';
				echo ': <input type="text" name="editColour">';
				echo '<input type="submit" value="'.I_OK.'" onclick="javascript:gravarNoticias(this.form, \'index.php?h=colour_editor&cor_id='.$row[0].'&\', \'index.php?c=catalogo&pageloc=cor\');">';
				echo '<input type="submit" value="'.I_CANCEL.'" onclick="javascript:hideForm(\'editform-'.$row[0].'\');">';
				echo '</form></td>';
			echo '</tr>';
			}
			echo '</table>';
			echo '<form method="post" onsubmit="return false;" style="text-align:right;">';
			echo I_NEW_COLOUR.': <input type="text" name="newColour" >';
			echo '<input type="submit" value="'.I_ADD.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=add_colour\', \'index.php?c=catalogo&pageloc=cor\');">';
			echo '</form>';
		}
	}
}
//CRIAR CORES
if(!function_exists('add_colour')){
	function add_colour(){
		global $bd;
		$titulo=reqvlr('newColour');
		$saveQ;
		if(reqvlr('newColour')) {
			$saveQ = $bd->query( "INSERT INTO ".BD_PREFIXO."Catalogo_Cores (Descricao) VALUES('".$titulo."')" );
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}
//ELIMINAR CORES
if(!function_exists('colour_delete')){
	function colour_delete(){
		global $bd;
		if(reqvlr('cor_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Catalogo_Cores WHERE ID =".reqvlr('cor_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=catalogo&pageloc=cor");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=catalogo&pageloc=cor");
			}
		}
	}
}
//EDITAR CORES
if(!function_exists('colour_editor')){
	function colour_editor(){
		global $bd;
		$titulo=reqvlr('editColour');
		$saveQ;
		if(reqvlr('editColour')) {
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Catalogo_Cores SET Descricao = '".$titulo."' WHERE ID =".reqvlr('cor_id'));
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}

/*
FUNÇÕES REFERENTES AOS MATERIAIS
*/
//LISTAR MATERIAIS
if(!function_exists('list_materiais')){
	function list_materiais() {
		global $bd;
		$materiais	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Materiais");
		if($bd->tem_Linhas($materiais)) {
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_MATERIAL.'</th>',
			'<th style="text-align:right;">'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($materiais)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td style="text-align:right;"><a href="?c=catalogo" class="unobtrusive" onclick="displayForm(\'materialeditform-'.$row[0].'\')" >'.I_EDIT.'</a>';
				echo ' | <a href="?h=material_delete&material_id='.$row[0].'">'.I_DELETE.'</a>';
				echo  '<form method="post" onsubmit="return false;" action="" style=" margin-left:30px; display:none;" id="materialeditform-'.$row[0].'">';
				echo '<input type="text" name="editMaterial">';
				echo '<input type="submit" value="'.I_OK.'" onclick="javascript:gravarNoticias(this.form, \'index.php?h=material_editor&material_id='.$row[0].'&\', \'index.php?c=catalogo&pageloc=mat\');">';
				echo '<input type="submit" value="'.I_CANCEL.'" onclick="javascript:hideForm(\'materialeditform-'.$row[0].'\');">';
				echo '</form></td>';
			echo '</tr>';
			}
			echo '</table>';
			echo '<form method="post" onsubmit="return false;" style="text-align:right;">';
			echo I_NEW_MATERIAL.': <input type="text" name="newMaterial" >';
			echo '<input type="submit" value="'.I_ADD.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=add_material\', \'index.php?c=catalogo&pageloc=mat\');">';
			echo '</form>';
		}
	}
}
//CRIAR MATERIAIS
if(!function_exists('add_material')){
	function add_material(){
		global $bd;
		$saveQ;
		if(reqvlr('newMaterial')) {
			$titulo=reqvlr('newMaterial');
			$saveQ = $bd->query( "INSERT INTO ".BD_PREFIXO."Catalogo_Materiais (Descricao) VALUES('".$titulo."')" );
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}
//ELIMINAR MATERIAIS
if(!function_exists('material_delete')){
	function material_delete(){
		global $bd;
		if(reqvlr('material_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Catalogo_Materiais WHERE ID =".reqvlr('material_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=catalogo&pageloc=mat");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=catalogo&pageloc=mat");
			}
		}
	}
}
//EDITAR MATERIAIS
if(!function_exists('material_editor')){
	function material_editor(){
		global $bd;
		$saveQ;
		if(reqvlr('editMaterial')) {
			$titulo=reqvlr('editMaterial');
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Catalogo_Materiais SET Descricao = '".$titulo."' WHERE ID =".reqvlr('material_id'));
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}


/*
FUNÇÕES REFERENTES AOS MODELOS*/
//LISTAR MODELOS
if(!function_exists('list_modelos')){
	function list_modelos() {
		global $bd;
		$modelos	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Modelos");
		if($bd->tem_Linhas($modelos)) {
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_MODEL.'</th>',
			'<th style="text-align:right;">'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($modelos)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td style="text-align:right;"><a href="?c=catalogo" class="unobtrusive" onclick="displayForm(\'modeloeditform-'.$row[0].'\')" >'.I_EDIT.'</a>';
				echo ' | <a href="?h=modelo_delete&model_id='.$row[0].'">'.I_DELETE.'</a>';
				echo  '<form method="post" onsubmit="return false;" action="" style=" margin-left:30px; display:none;" id="modeloeditform-'.$row[0].'">';
				echo '<input type="text" name="editModel">';
				echo '<input type="submit" value="'.I_OK.'" onclick="javascript:gravarNoticias(this.form, \'index.php?h=modelo_editor&model_id='.$row[0].'&\', \'index.php?c=catalogo&pageloc=mod\');">';
				echo '<input type="submit" value="'.I_CANCEL.'" onclick="javascript:hideForm(\'modeloeditform-'.$row[0].'\');">';
				echo '</form></td>';
			echo '</tr>';
			}
			echo '</table>';
			echo '<form method="post" onsubmit="return false;" style="text-align:right;">';
			echo I_NEW_MODEL.': <input type="text" name="newModel" >';
			echo '<input type="submit" value="'.I_ADD.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=add_modelo\', \'index.php?c=catalogo&pageloc=mod\');">';
			echo '</form>';
		}
	}
}
//CRIAR MODELOS
if(!function_exists('add_modelo')){
	function add_modelo(){
		global $bd;
		$saveQ;
		if(reqvlr('newModel')) {
			$titulo=reqvlr('newModel');
			$saveQ = $bd->query( "INSERT INTO ".BD_PREFIXO."Catalogo_Modelos (Descricao) VALUES('".$titulo."')" );
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}
//ELIMINAR MODELOS
if(!function_exists('modelo_delete')){
	function modelo_delete(){
		global $bd;
		if(reqvlr('model_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Catalogo_Modelos WHERE ID =".reqvlr('model_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=catalogo&pageloc=mod");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=catalogo&pageloc=mod");
			}
		}
	}
}
//EDITAR MODELOS
if(!function_exists('modelo_editor')){
	function modelo_editor(){
		global $bd;
		$saveQ;
		if(reqvlr('editModel')) {
			$titulo=reqvlr('editModel');
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Catalogo_Modelos SET Descricao = '".$titulo."' WHERE ID =".reqvlr('model_id'));
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}

/*
FUNÇÕES REFERENTES AOS TAMANHOS
*/
//LISTAR TAMANHOS
if(!function_exists('list_tamanhos')){
	function list_tamanhos() {
		global $bd;
		$tamanhos	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Tamanhos");
		if($bd->tem_Linhas($tamanhos)) {
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_MODEL.'</th>',
			'<th style="text-align:right;">'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($tamanhos)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td style="text-align:right;"><a href="?c=catalogo" class="unobtrusive" onclick="displayForm(\'tamanhoeditform-'.$row[0].'\')" >'.I_EDIT.'</a>';
				echo ' | <a href="?h=tamanho_delete&tamanho_id='.$row[0].'">'.I_DELETE.'</a>';
				echo  '<form method="post" onsubmit="return false;" action="" style=" margin-left:30px; display:none;" id="tamanhoeditform-'.$row[0].'">';
				echo '<input type="text" name="editTamanho">';
				echo '<input type="submit" value="'.I_OK.'" onclick="javascript:gravarNoticias(this.form, \'index.php?h=tamanho_editor&tamanho_id='.$row[0].'&\', \'index.php?c=catalogo&pageloc=tam\');">';
				echo '<input type="submit" value="'.I_CANCEL.'" onclick="javascript:hideForm(\'tamanhoeditform-'.$row[0].'\');">';
				echo '</form></td>';
			echo '</tr>';
			}
			echo '</table>';
			echo '<form method="post" onsubmit="return false;" style="text-align:right;">';
			echo I_NEW_MODEL.': <input type="text" name="newTamanho" >';
			echo '<input type="submit" value="'.I_ADD.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=add_tamanho\', \'index.php?c=catalogo&pageloc=tam\');">';
			echo '</form>';
		}
	}
}
//CRIAR TAMANHOS
if(!function_exists('add_tamanho')){
	function add_tamanho(){
		global $bd;
		$saveQ;
		if(reqvlr('newTamanho')) {
			$titulo=reqvlr('newTamanho');
			$saveQ = $bd->query( "INSERT INTO ".BD_PREFIXO."Catalogo_Tamanhos (Descricao) VALUES('".$titulo."')" );
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}
//ELIMINAR TAMANHOS
if(!function_exists('tamanho_delete')){
	function tamanho_delete(){
		global $bd;
		if(reqvlr('tamanho_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Catalogo_Tamanhos WHERE ID =".reqvlr('tamanho_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=catalogo&pageloc=tam");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=catalogo&pageloc=tam");
			}
		}
	}
}
//EDITAR TAMANHOS
if(!function_exists('tamanho_editor')){
	function tamanho_editor(){
		global $bd;
		$saveQ;
		if(reqvlr('editTamanho')) {
			$titulo=reqvlr('editTamanho');
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Catalogo_Tamanhos SET Descricao = '".$titulo."' WHERE ID =".reqvlr('tamanho_id'));
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}


/*
FUNÇÕES REFERENTE AOS TIPOS DE PEÇAS
*/
//LISTAR TIPOS
if(!function_exists('list_tipos')){
	function list_tipos() {
		global $bd;
		$tipos	= $bd->query("SELECT ID, Descricao FROM ".BD_PREFIXO."Catalogo_Tipos");
		if($bd->tem_Linhas($tipos)) {
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_MODEL.'</th>',
			'<th style="text-align:right;">'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($tipos)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td style="text-align:right;"><a href="?c=catalogo" class="unobtrusive" onclick="displayForm(\'tipoeditform-'.$row[0].'\')" >'.I_EDIT.'</a>';
				echo ' | <a href="?h=tipo_delete&tipo_id='.$row[0].'">'.I_DELETE.'</a>';
				echo  '<form method="post" onsubmit="return false;" action="" style=" margin-left:30px; display:none;" id="tipoeditform-'.$row[0].'">';
				echo '<input type="text" name="editTipo">';
				echo '<input type="submit" value="'.I_OK.'" onclick="javascript:gravarNoticias(this.form, \'index.php?h=tipo_editor&tipo_id='.$row[0].'&\', \'index.php?c=catalogo&pageloc=tip\');">';
				echo '<input type="submit" value="'.I_CANCEL.'" onclick="javascript:hideForm(\'tipoeditform-'.$row[0].'\');">';
				echo '</form></td>';
			echo '</tr>';
			}
			echo '</table>';
			echo '<form method="post" onsubmit="return false;" style="text-align:right;">';
			echo I_NEW_MODEL.': <input type="text" name="newTipo" >';
			echo '<input type="submit" value="'.I_ADD.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=add_tipo\', \'index.php?c=catalogo&pageloc=tip\');">';
			echo '</form>';
		}
	}
}
//CRIAR TIPOS
if(!function_exists('add_tipo')){
	function add_tipo(){
		global $bd;
		$saveQ;
		if(reqvlr('newTipo')) {
			$titulo=reqvlr('newTipo');
			$saveQ = $bd->query( "INSERT INTO ".BD_PREFIXO."Catalogo_Tipos (Descricao) VALUES('".$titulo."')" );
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}
//ELIMINAR TIPOS
if(!function_exists('tipo_delete')){
	function tipo_delete(){
		global $bd;
		if(reqvlr('tipo_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Catalogo_Tipos WHERE ID =".reqvlr('tipo_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=catalogo&pageloc=tip");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=catalogo&pageloc=tip");
			}
		}
	}
}
//EDITAR TIPOS
if(!function_exists('tipo_editor')){
	function tipo_editor(){
		global $bd;
		$saveQ;
		if(reqvlr('editTipo')) {
			$titulo=reqvlr('editTipo');
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Catalogo_Tipos SET Descricao = '".$titulo."' WHERE ID =".reqvlr('tipo_id'));
			if($saveQ) {
				echo "a";
			}else {
				echo '0';
			}
		}
	}
}




if(!function_exists('editor')){
	function editor(){
		global $bd;
		if (reqvlr('news_id')) { //DATE_FORMAT(Data, \'%Y/%m/%d\')
			$slDados	= $bd->query("SELECT Titulo, Data, Resumo, Imagem, ID, Texto, Publicada, Tipo, Autor FROM ".BD_PREFIXO."News WHERE ID =".reqvlr('news_id'));
			if($bd->tem_linhas($slDados)){
			$row = $bd->dados($slDados);
			$rawText = str_replace(array("\n","\r"), "", $row[5]);
			$rawText = str_replace(array("<br>"), "<br />", $rawText);
			//preg_replace("/(<+)([a-zA-Z0-9]+)(>+)/", "$1BANANAN$2$3", $input_lines);
			$rawText = preg_replace("/(&lt;+)([a-zA-Z0-9]+)(&gt;+)/", "$1 $2$3", $rawText);
			//$rawText = str_replace(array("\""), "\'", $rawText);
			$cleanTitle = str_replace(array("\""), "''", $row[0]);
			
			echo '<h1>'.$row[0].'</h1>'; //&news_id='.reqvlr('news_id').'
			echo '<form method="post" action="">
				Titulo: <input type="text" id="titulo" name="titulo" size="100" value="'.$cleanTitle.'"><br><br>
				Autor: <input type="text" id="autor" name="autor" value="'.$row[8].'">
				Data de Publicação: <input type="text" id="dataP" name="dataP" value="'.$row[1].'">';
				
			
			if($row[6]==1) {
				echo 'Estado: Publicada';
			}
			else {
				echo 'Estado: Não Publicada';
			}
			
			echo '<h3> Resumo </h3>';
			echo '<div style="width:60%; margin:10px auto;">';
			echo '<textarea name="resumo" rows="4" cols="97" id="resumo">'.$row[2].'</textarea></div>';
			echo '<script type="text/javascript"> $(document).ready(function(){
				setTextLimit("resumo", 200);
				});</script>';
				
			echo '<h3>'.I_CONTENT.'</h3>';
			/*echo '<script type="text/javascript">alert("'.$rawText.'");</script>';*/
			echo '<div style="width:60%; margin:10px auto;">
			<textarea id="texto" name="texto" rows="4" cols="100" class="mceEditor">'.$rawText.'</textarea>
				<input type="button" name="gravar" value="Gravar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=newsSave&news_id='.$row[4].'\',null);"/>
				<input type="button" name="saveandpub" value="Gravar e Publicar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=newsPublish&news_id='.$row[4].'\', \'index.php?c=news\');"/>
				<button type="button" id="cancelar">Cancelar</button> 
				
				
			</div>
			
			</form>';
				
			echo '<script type="text/javascript"> 
				document.getElementById("cancelar").addEventListener("click", 
					function() {
    					if(checkChanges("titulo")||checkChanges("autor")||checkChanges("dataP")||checkChanges("resumo")||checkEditorChanges("texto", "'.str_replace(array("\""), "\'", $rawText).'")){
							var a = confirm("Se fez alterações sem gravar poderá perder dados.\nDeseja continuar?");
							if (a) {
								window.location.replace("?c=news");
							}
							else {
    						// Do nothing!
							}
						}
						else { 
							window.location.replace("?c=news");}
					}, false);
			</script>';
			} //window.location.replace("?c=news"); var name = document.getElementById("texto");
		}
	}
}


if(!function_exists('product_criador')){
	function product_criador(){
		global $bd;
		require(SERVER_ROOT."/es-code/plugins/catalogo/catalogo.php");

		echo '<h1>'.I_NEW_PRODUCT.'BANANASSSSSSS</h1>';
		
		// echo '<form method="post" action="index.php?h=saves"> gravar(form)
		echo '<form method="post" action="">';
		echo I_NOME.': <input type="text" id="titulo" name="nome" size="50"><br><br>';
		echo I_REF.': <input type="text" id="referencia" name="referencia" size="25" >';
		echo I_FABRIC.': <input type="text" id="tecido" name="tecido" size="20" ><br>';
		echo '<h3>'.I_DESCRIPTION.'</h3>';
		echo '<div style="width:60%; margin:10px auto;">';
		echo '<textarea name="descricao" rows="4" id="descricao" style="width:100%;"></textarea></div>';
		echo '<script type="text/javascript"> $(document).ready(function(){
				setTextLimit("descricao", 200);
				});</script>';
		echo '<h3>Estilo</h3>';

			catalogo_list_estilos(); 
			while(catalogo_get_estilos_item()):
					echo '<input type="checkbox" name="estilo-'.catalogo_get_estilo_id().'" value="';
					echo catalogo_get_estilo_id();
					if(!reqvlr('clear') && reqvlr('estilo-'.catalogo_get_estilo_id())) {
						echo '" checked>';
					}
					else{
						echo '">';
					}
					echo catalogo_get_estilo();
				endwhile;

		
		echo '<input type="button" value="Gravar" name="gravar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=newsSave\', \'index.php?c=editor&news_id=\');" />';
		echo '<input type="button" name="saveandpub" value="Gravar e Publicar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=newsPublish\', \'index.php?c=news\');"/>';
		echo '<button type="button" id="cancelar">Cancelar</button> 
			</div>
			</form>';
			//<input type="submit" name="gravar" value="Gravar" class="botao" onclick="javascript:gravar(this.form);"/>
		echo '<script type="text/javascript"> 
				document.getElementById("cancelar").addEventListener("click", 
					function() {
    					if(checkChanges("titulo")||checkChanges("autor")||checkChanges("dataP")||checkChanges("resumo")||checkEditorChanges("texto")){
							var a = confirm("Perderá alterações se sair sem gravar. Deseja continuar?");
							if (a) {
								window.location.replace("?c=news");
							}
							else {
    						// Do nothing!
							}
						}
						else { window.location.replace("?c=news");}
					}, false);
			</script>';
	}
}

if(!function_exists('newsDelete')){
	function newsDelete(){
		global $bd;
		if(reqvlr('news_id')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."News WHERE ID =".reqvlr('news_id'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=news");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=news");
			}
		}
	}
}

if(!function_exists('changePubstate')){
	function changePubstate(){
		global $bd;
		if(reqvlr('news_id')) {
			$slDados	= $bd->query("SELECT Publicada FROM ".BD_PREFIXO."News WHERE ID =".reqvlr('news_id'));
			if($bd->tem_linhas($slDados)){
				$row = $bd->dados($slDados);
				if($row[0]==0){
					$chState = $bd->query("UPDATE ".BD_PREFIXO."News SET Publicada = 1 WHERE ID =".reqvlr('news_id'));
					if($chState) {
						$_SESSION["ERR_A"]	= 1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
						header("location: ?c=news");
					}else {
						$_SESSION["ERR_A"]	= -1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
						header("location: ?c=news");
					}
				}
				else {
					/*echo '<script type="text/javascript">alert("noticia já publicada.");</script>';*/
					$chState = $bd->query("UPDATE ".BD_PREFIXO."News SET Publicada = 0 WHERE ID =".reqvlr('news_id'));
					if($chState) {
						$_SESSION["ERR_A"]	= 1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
						header("location: ?c=news");
					}else {
						$_SESSION["ERR_A"]	= -1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
						header("location: ?c=news");
					}
				}
			}
			
		}
	}
}

if(!function_exists('newsSave')){
	function newsSave() {
		global $bd;
		$titulo=reqvlr('titulo');
		$autor=reqvlr('autor');
		$data=reqvlr('dataP');
		$resumo=reqvlr('resumo');
		$texto = reqvlr('texto');
		$saveQ;
		if(reqvlr('news_id')) {
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."' WHERE ID =".reqvlr('news_id'));
			if($saveQ) {
				echo 'a';
			}else {
				echo '0';
			}
				//header("location: ?c=editor&news_id=".reqvlr('news_id'));
		}
		else {
			$saveQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto, Tipo) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."', 1)");
			if($saveQ) {
				echo $bd->ultimo_id();
			}else {
				echo '0';
			}
			
		}
	}
}

if(!function_exists('novsSave')){
	function novsSave() {
		global $bd;
		$titulo=reqvlr('titulo');
		$autor=reqvlr('autor');
		$data=reqvlr('dataP');
		$resumo=reqvlr('resumo');
		$texto = reqvlr('texto');
		$saveQ;
		if(reqvlr('news_id')) {
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."' WHERE ID =".reqvlr('news_id'));
			if($saveQ) {
				echo 'a';
			}else {
				echo '0';
			}
				//header("location: ?c=editor&news_id=".reqvlr('news_id'));
		}
		else {
			$saveQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto, Tipo) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."' , 2)");
			if($saveQ) {
				echo $bd->ultimo_id();
			}else {
				echo '0';
			}
			
		}
	}
}



if(!function_exists('newsPublish')){
	function newsPublish() {
		global $bd;
		$titulo=reqvlr('titulo');
		$autor=reqvlr('autor');
		$data=reqvlr('dataP');
		$resumo=reqvlr('resumo');
		$texto = reqvlr('texto');
		$pubQ;
		
		if(reqvlr('news_id')) {
			$pubQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."', Publicada = 1 WHERE ID =".reqvlr('news_id'));
			if($pubQ) {
				echo 'a';
			}else {
				echo '0';
			}
				//header("location: ?c=editor&news_id=".reqvlr('news_id'));
		}
		else {
			$pubQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto, Publicada, Tipo) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."', 1, 1)");
			if($pubQ) {
				echo 'a';
			}else {
				echo '0';
			}
			
		}
	}
}

if(!function_exists('novsPublish')){
	function novsPublish() {
		global $bd;
		$titulo=reqvlr('titulo');
		$autor=reqvlr('autor');
		$data=reqvlr('dataP');
		$resumo=reqvlr('resumo');
		$texto = reqvlr('texto');
		$pubQ;
		if(reqvlr('news_id')) {
			$pubQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."', Publicada = 1 WHERE ID =".reqvlr('news_id'));
			if($pubQ) {
				echo 'a';
			}else {
				echo '0';
			}
				//header("location: ?c=editor&news_id=".reqvlr('news_id'));
		}
		else {
			$pubQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto, Publicada, Tipo) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."', 1, 2)");
			if($pubQ) {
				echo 'a';
			}else {
				echo '0';
			}
			
		}
	}
}
/*if(!function_exists('saves')){
	function saves() {
		global $bd;
		$titulo=reqvlr('titulo');
		$autor=reqvlr('autor');
		$data=reqvlr('dataP');
		$resumo=reqvlr('resumo');
		$texto = reqvlr('texto');
		$saveQ;
		$pubQ;
		if(reqvlr('saveandpub')) {
			if(reqvlr('news_id')) {
				$pubQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."', Publicada = 1 WHERE ID =".reqvlr('news_id'));
			}
			else {
				$pubQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto, Publicada) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."', 1)");;
			}
			if($pubQ) {
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
			}
			//header("location: ?c=news");
		}
		elseif (reqvlr('gravar')){
			if(reqvlr('news_id')) {
				$saveQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."' WHERE ID =".reqvlr('news_id'));
				if($saveQ) {
					$_SESSION["ERR_A"]	= 1;
					$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				}else {
					$_SESSION["ERR_A"]	= -1;
					$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				}
				//header("location: ?c=editor&news_id=".reqvlr('news_id'));
			}
			else {
				$saveQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."')");
				if($saveQ) {
					$_SESSION["ERR_A"]	= 1;
					$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
					//header("location: ?c=editor&news_id=".$bd->ultimo_id());
				}else {
					$_SESSION["ERR_A"]	= -1;
					$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
					//header("location: ?c=criador");
				}
				
			}
			
		}
		//header('location: para onde') - só funciona antes de echo's e coisas que vão para o body
	}
}*/
#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>
