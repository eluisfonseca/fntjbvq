<?PhP
if(!function_exists('news')){
	function news(){
		global $bd;
		
		echo '<h1>'.I_NEWS.'</h1>';
		
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_DESCRIPTION.'</th>',
			'<th>'.I_PUBLISHED.'</th>',
			'<th>'.I_ACTIONS.'</th>',
		'</tr>';
		
		$noticias	= $bd->query("SELECT ID, Titulo, Publicada FROM ".BD_PREFIXO."News WHERE Tipo=1 ORDER BY Data DESC");
		
			while($row = $bd->dados($noticias)){
				echo '<tr>',
				'<td>'.$row[1].'</td>';
				if($row[2] == 1){
					echo '<td><a href="?h=changePubstate&news_id='.$row[0].'" >'.I_REMOVEPUB.'</a></td>';
				}else{
					echo '<td><a href="?h=changePubstate&news_id='.$row[0].'" >'.I_PUBLICA.'</a></td>';
				}
				echo '<td><a href="?c=editor&news_id='.$row[0].'">'.I_EDIT.'</a> | <a href="?h=newsDelete&news_id='.$row[0].'">'.I_DELETE.'</a></td>';
				echo '</tr>';
			}
			echo '<tr><td colspan="3" style="text-align: right;"><a href="?c=criador">'.I_ADD.'</a></td></tr>';
			echo '</table>';
			//echo '$("#publica").click(function(){ execFunc(\'index.php?h=change_pubstate\', \'index.php?c=news\'); return false; });'; onclick="javascript:execFunc(\'index.php?h=change_pubstate&news_id='.$row[0].'\', \'index.php?c=news\');"
		
		
		$novidades	= $bd->query("SELECT ID, Titulo, Publicada FROM ".BD_PREFIXO."News WHERE Tipo=2 ORDER BY Data DESC");
		if($bd->tem_Linhas($novidades)) {
			echo '<br><h1>'.I_NOVIDADES.'</h1>';
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_DESCRIPTION.'</th>',
			'<th>'.I_PUBLISHED.'</th>',
			'<th>'.I_ACTIONS.'</th>',
		'</tr>';
		
		
		while($row = $bd->dados($novidades)){
			echo '<tr>',
				'<td>'.$row[1].'</td>';
				if($row[2] == 1){
					echo '<td><a href="?h=changePubstate&news_id='.$row[0].'" >'.I_REMOVEPUB.'</a></td>';
				}else{
					echo '<td><a href="?h=changePubstate&news_id='.$row[0].'" >'.I_PUBLICA.'</a></td>';
				}
				echo '<td><a href="?c=editor&news_id='.$row[0].'">'.I_EDIT.'</a> | <a href="?h=newsDelete&news_id='.$row[0].'">'.I_DELETE.'</a></td>';
			echo '</tr>';
			}
			echo '<tr><td colspan="3" style="text-align: right;"><a href="?c=criador&nov=1">'.I_ADD.'</a></td></tr>';
			echo '</table>';
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
				

			echo '<h3>'.I_IMAGE.'</h3>';
			echo '<img src="'.SITE_ROOT.DATA_DIR.'/'.$row[3].'" style="margin:10px auto; width=50%; max-width=300px;" id="sliderimg"><br>';
			echo I_PATH.': <input type="text" id="image" name="image" size="50" value="'.$row[3].'">
			<button type="button" id="banana" class="search">'.I_SEARCH.'</button> <br><br>';

			echo '<script type="text/javascript"> 
				document.getElementById("banana").addEventListener("click", 
					function() {
    					ExpAbrir("image", "sliderimg");
					}, false);
			</script>';

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


if(!function_exists('criador')){
	function criador(){
		global $bd;
		
		date_default_timezone_set('Europe/Lisbon');
		$date = date('Y/m/d H:i:s', time());
		if (reqvlr('nov')){echo '<h1> Nova Novidade </h1>';}
		else {echo '<h1> Nova Notícia </h1>';}
		
		// echo '<form method="post" action="index.php?h=saves"> gravar(form)
		echo '<form method="post" action="">
				Titulo: <input type="text" id="titulo" name="titulo" size="100" "><br><br>
				Autor: <input type="text" id="autor" name="autor" value="'.$_SESSION["S02"].'" ">
				Data de Publicação: <input type="text" id="dataP" name="dataP" value="'.$date.'"><br>
				';	
		echo '<h3> Resumo </h3>';
		echo '<div style="width:60%; margin:10px auto;">';
		echo '<textarea name="resumo" rows="4" cols="97" id="resumo"></textarea></div>';
		echo '<script type="text/javascript"> $(document).ready(function(){
				setTextLimit("resumo", 200);
				});</script>';

		echo '<h3>'.I_IMAGE.'</h3>';
			echo '<img src="" style="margin:10px auto; width=50%; max-width=300px;" id="sliderimg"><br>';
			echo I_PATH.': <input type="text" id="image" name="image" size="50" value="">
			<button type="button" id="banana" class="search">'.I_SEARCH.'</button> <br><br>';

			echo '<script type="text/javascript"> 
				document.getElementById("banana").addEventListener("click", 
					function() {
    					ExpAbrir("image", "sliderimg");
					}, false);
			</script>
			';

		echo '<h3> Conteúdo </h3>';
		echo '<div style="width:60%; margin:10px auto;">
			<textarea id="texto" name="texto" rows="4" cols="100" class="mceEditor"></textarea>';
		if (reqvlr('nov')) { //CASO SEJA UMA NOVIDADE
			echo '<input type="button" value="Gravar" name="gravar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=novsSave\', \'index.php?c=editor&news_id=\');" />
			<input type="button" name="saveandpub" value="Gravar e Publicar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=novsPublish\', \'index.php?c=news\');"/>';
		}
		else { //CASO SEJA UMA NOTICIA
			echo '<input type="button" value="Gravar" name="gravar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=newsSave\', \'index.php?c=editor&news_id=\');" />
			<input type="button" name="saveandpub" value="Gravar e Publicar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=newsPublish\', \'index.php?c=news\');"/>';
		}
		
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
		$banner = reqvlr('image');
		$saveQ;
		if(reqvlr('news_id')) {
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."', Imagem ='".$banner."' WHERE ID =".reqvlr('news_id'));
			if($saveQ) {
				echo 'a';
			}else {
				echo '0';
			}
				//header("location: ?c=editor&news_id=".reqvlr('news_id'));
		}
		else {
			$saveQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto, Tipo, Imagem) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."', 1, '".$banner."')");
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
		$banner = reqvlr('image');
		$pubQ;
		
		if(reqvlr('news_id')) {
			$pubQ = $bd->query("UPDATE ".BD_PREFIXO."News SET Titulo='".$titulo."', Autor ='".$autor."', Data ='".$data."', Resumo ='".$resumo."', Texto ='".$texto."', Publicada = 1, Imagem ='".$banner."' WHERE ID =".reqvlr('news_id'));
			if($pubQ) {
				echo 'a';
			}else {
				echo '0';
			}
				//header("location: ?c=editor&news_id=".reqvlr('news_id'));
		}
		else {
			$pubQ = $bd->query("INSERT INTO ".BD_PREFIXO."News (Titulo, Autor, Data, Resumo, Texto, Publicada, Tipo, Imagem) VALUES( '".$titulo."', '".$autor."', '".$data."', '".$resumo."', '".$texto."', 1, 1, '".$banner."')");
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
