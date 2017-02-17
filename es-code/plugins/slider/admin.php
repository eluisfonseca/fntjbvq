<?PhP
if(!function_exists('slider')){
	function slider(){
		global $bd;
		
		echo '<h1>'.I_SLIDER.'</h1>'; //SITE_ROOT.DATA_DIR.'/'.$slFoto;
		
		echo '<table align="center" border="0" cellpadding="2" cellspacing="0" style="width:80%">';
		echo '<tr>',
			'<th>'.I_DESCRIPTION.'</th>',
			'<th>'.I_IMAGEM.'</th>',
			'<th>'.I_PUBLISHED.'</th>',
			'<th>'.I_ACTIONS.'</th>',
		'</tr>';
		
		$slides	= $bd->query("SELECT ID, Titulo, Activo, Foto FROM ".BD_PREFIXO."Slider");
		
			while($row = $bd->dados($slides)){
				echo '<tr>',
				'<td>'.$row[1].'</td>';
				echo '<td> <img src="'.SITE_ROOT.DATA_DIR.'/'.$row[3].'" style="width:50px;"></td>';
				if($row[2] == 1){
					echo '<td><a href="?h=changeslidestate&slideid='.$row[0].'" >'.I_REMOVEPUB.'</a></td>';
				}else{
					echo '<td><a href="?h=changeslidestate&slideid='.$row[0].'" >'.I_PUBLICA.'</a></td>';
				}
				echo '<td><a href="?c=sleditor&slideid='.$row[0].'">'.I_EDIT.'</a> | <a href="?h=slDelete&slideid='.$row[0].'">'.I_DELETE.'</a></td>';
				echo '</tr>';
			}
			echo '<tr><td colspan="4" style="text-align: right;"><a href="?c=slcriador">'.I_ADD.'</a></td></tr>';
			echo '</table>';
	}
}

if(!function_exists('sleditor')){
	function sleditor(){
		global $bd;
		if (reqvlr('slideid')) {
			$slDados	= $bd->query("SELECT Titulo, Descricao, Foto, Pos, ID, Activo FROM ".BD_PREFIXO."Slider WHERE ID =".reqvlr('slideid'));
			if($bd->tem_linhas($slDados)){
			$row = $bd->dados($slDados);
			$desc = str_replace(array("\""), "''", $row[1]);
			$cleanTitle = str_replace(array("\""), "''", $row[0]);
			echo '<h1>'.$cleanTitle.'</h1>'; 
			echo '<form method="post" action="">
				'.I_TITLE.': <input type="text" id="titulo" name="titulo" size="100" value="'.$cleanTitle.'"><br><br>';
			if($row[5]==1) {
				echo I_STATE.': '.I_PUB;
			}
			else {
				echo I_STATE.': '.I_NOTPUB;
			}
			echo I_ORDER.': <input type="text" id="order" name="order" size="100" value="'.$row[3].'"><br><br>';

			echo '<h3>'.I_IMAGE.'</h3>';
			echo '<img src="'.SITE_ROOT.DATA_DIR.'/'.$row[2].'" style="margin:10px auto; width=50%; max-width=300px;" id="sliderimg"><br>';
			echo I_PATH.': <input type="text" id="image" name="image" size="50" value="'.$row[2].'">
			<button type="button" id="banana" class="search">'.I_SEARCH.'</button> <br><br>';
			
			echo '<h3>'.I_CONTENT.'</h3>';
			echo '<div style="width:60%; margin:10px auto;">';
			echo '<textarea name="descricao" rows="7" cols="97" id="descricao" class="mceEditor">'.$desc.'</textarea></div>';	
			echo '<input type="button" name="gravar" value="'.I_SAVE.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=slideSave&slideid='.$row[4].'\',null);"/>
				<input type="button" name="saveandpub" value="'.I_SAVEPUB.'" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=slidePublish&slideid='.$row[4].'\', \'index.php?c=slider\');"/>
				<button type="button" id="cancelar">'.I_CANCEL.'</button> 
				
				
			</div>
			<script type="text/javascript"> 
				document.getElementById("banana").addEventListener("click", 
					function() {
    					ExpAbrir("image", "sliderimg");
					}, false);
			</script>';
			
			echo '</form>';
				
			echo '<script type="text/javascript"> 
				document.getElementById("cancelar").addEventListener("click", 
					function() {
    					if(checkChanges("titulo")||checkEditorChanges("descricao")||checkChanges("image")||checkChanges("order")){
							var a = confirm("Perderá alterações se sair sem gravar. Deseja continuar?");
							if (a) {
								window.location.replace("?c=slider");
							}
							else {
    						// Do nothing!
							}
						}
						else { 
							window.location.replace("?c=slider");}
					}, false);
			</script>';
			} 
		}
		else {echo '<script type="text/javascript"> alert("BANANAS");</script>';}
	}
}


if(!function_exists('slcriador')){
	function slcriador(){
		global $bd;
		echo '<h1>'.I_NEWSLIDE.'</h1>';
		
		echo '<form method="post" action="">'.I_TITLE.'<input type="text" id="titulo" name="titulo" size="100" "><br><br>';	
		echo I_ORDER.': <input type="text" id="order" name="order" size="5" value=""><br><br>';
			echo '<h3>'.I_IMAGE.'</h3>';
			echo '<img src="" style="margin:10px auto; width=50%; max-width=300px;" id="sliderimg"><br>';
			echo I_PATH.': <input type="text" id="image" name="image" size="50" value="">
			<button type="button" id="banana" class="search">'.I_SEARCH.'</button> <br><br>';
			echo '<h3>'.I_CONTENT.'</h3>';
			echo '<div style="width:60%; margin:10px auto;">';
			echo '<textarea name="descricao" rows="7" cols="97" id="descricao"></textarea></div>';	
		
			echo '<input type="button" value="'.I_SAVE.'" name="gravar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=slideSave\', \'index.php?c=sleditor&slideid=\');" />
			<input type="button" name="'.I_SAVEPUB.'" value="Gravar e Publicar" class="botao" onclick="javascript:gravarNoticias(this.form, \'index.php?h=slidePublish\', \'index.php?c=slider\');"/>';
	
		
		echo '<button type="button" id="cancelar">'.I_CANCEL.'</button> 
			</div>
			</form>
			
			<script type="text/javascript"> 
				document.getElementById("banana").addEventListener("click", 
					function() {
    					ExpAbrir("image", "sliderimg");
					}, false);
			</script>
			';
			
			//<input type="submit" name="gravar" value="Gravar" class="botao" onclick="javascript:gravar(this.form);"/>
		echo '<script type="text/javascript"> 
				document.getElementById("cancelar").addEventListener("click", 
					function() {
    					if(checkChanges("titulo")||checkChanges("descricao")||checkChanges("image")||checkChanges("order")){
							var a = confirm("Perderá alterações se sair sem gravar. Deseja continuar?");
							if (a) {
								window.location.replace("?c=slider");
							}
							else {
    						// Do nothing!
							}
						}
						else { window.location.replace("?c=slider");}
					}, false);
			</script>';
	}
}

if(!function_exists('slDelete')){
	function slDelete(){
		global $bd;
		if(reqvlr('slideid')) {
			
			$slDados = $bd->query("DELETE FROM ".BD_PREFIXO."Slider WHERE ID =".reqvlr('slideid'));
			if($slDados){
				$_SESSION["ERR_A"]	= 1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
				header("location: ?c=slider");
			}else {
				$_SESSION["ERR_A"]	= -1;
				$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
				header("location: ?c=slider");
			}
		}
	}
}

if(!function_exists('changeslidestate')){
	function changeslidestate(){
		global $bd;
		echo '<script type="text/javascript">alert("noticia já publicada.");</script>';
		if(reqvlr('slideid')) {
			
			$slDados	= $bd->query("SELECT Activo FROM ".BD_PREFIXO."Slider WHERE ID =".reqvlr('slideid'));
			if($bd->tem_linhas($slDados)){
				$row = $bd->dados($slDados);
				if($row[0]==0){
					$chState = $bd->query("UPDATE ".BD_PREFIXO."Slider SET Activo = 1 WHERE ID =".reqvlr('slideid'));
					if($chState) {
						$_SESSION["ERR_A"]	= 1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
						header("location: ?c=slider");
					}else {
						$_SESSION["ERR_A"]	= -1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
						header("location: ?c=slider");
					}
				}
				else {
					/*echo '<script type="text/javascript">alert("noticia já publicada.");</script>';*/
					$chState = $bd->query("UPDATE ".BD_PREFIXO."Slider SET Activo = 0 WHERE ID =".reqvlr('slideid'));
					if($chState) {
						$_SESSION["ERR_A"]	= 1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_S;
						header("location: ?c=slider");
					}else {
						$_SESSION["ERR_A"]	= -1;
						$_SESSION["ERR_B"]	= I_DATA_SAVE_F;
						header("location: ?c=slider");
					}
				}
			}
			
		}
	}
}

if(!function_exists('slideSave')){
	function slideSave() {
		global $bd;
		$titulo=reqvlr('titulo');
		$descricao=reqvlr('descricao');
		$foto=reqvlr('image');
		$order=reqvlr('order');
		$saveQ;
		if(reqvlr('slideid')) {
			$saveQ = $bd->query("UPDATE ".BD_PREFIXO."Slider SET Titulo='".$titulo."', Descricao ='".$descricao."', Foto ='".$foto."', Pos =".$order." WHERE ID =".reqvlr('slideid'));
			if($saveQ) {
				echo 'a';
			}else {
				echo '0';
			}
		}
		else {
			$saveQ = $bd->query("INSERT INTO ".BD_PREFIXO."Slider (Titulo, Descricao, Foto, Pos) VALUES( '".$titulo."', '".$descricao."', '".$foto."', ".$order.")");
			if($saveQ) {
				echo $bd->ultimo_id();
			}else {
				echo '0';
			}
			
		}
	}
}

if(!function_exists('slidePublish')){
	function slidePublish() {
		global $bd;
		$titulo=reqvlr('titulo');
		$descricao=reqvlr('descricao');
		$foto=reqvlr('image');
		$order=reqvlr('order');
		$pubQ;
		
		if(reqvlr('slideid')) {
			$pubQ = $bd->query("UPDATE ".BD_PREFIXO."Slider SET Titulo='".$titulo."', Descricao ='".$descricao."', Foto ='".$foto."', Pos =".$order.", Activo = 1 WHERE ID =".reqvlr('slideid'));
			if($pubQ) {
				echo 'a';
			}else {
				echo '0';
			}
		}
		else {
			$pubQ = $bd->query("INSERT INTO ".BD_PREFIXO."Slider (Titulo, Descricao, Foto, Pos, Activo) VALUES( '".$titulo."', '".$descricao."', '".$foto."', ".$order.", 1)");
			if($pubQ) {
				echo 'a';
			}else {
				echo '0';
			}
			
		}
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
