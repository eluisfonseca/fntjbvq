<?PhP 
	echo '<h1>'.catalogo_get_name().'</h1>';
	echo '<h4 style="display:inline; clear:none;"> Referência: </h4>';
			echo catalogo_get_refencia();
			echo '<h4 style="display:inline; clear:none; margin-left:15px;"> Qualidade Fabrico: </h4>';
			echo catalogo_get_fabrico();
			echo '<h4 style="display:inline; clear:none; margin-left:15px;"> Tipo: </h4>';
			echo catalogo_get_tipo();
			echo '<h4 style="display:inline; clear:none; margin-left:15px;"> Modelo: </h4>';
			echo catalogo_get_modelo();
	echo '<div id="fcontainer">';
		echo '<div class="imagem">';
			echo '<div class="main_image_container">';
			echo '<img id="main_image" src="'.catalogo_get_main_img().'">';
			echo '</div>';
			echo '<div class="preview_area">';
				catalogo_get_imagens(catalogo_get_id());
				echo '<div style="margin:0px auto; padding:0; width:auto; display:inline-block">';
				while(catalogo_get_image_item()):
					echo '<div class="item">';
						echo '<a href="#">';
						echo '<img src="'.catalogo_get_sec_img().'" class="thumb">';
						echo '</a>';
					echo '</div>';
				endwhile;
				echo '<div style="clear: both;"></div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="texto">';
			echo '<h3>Descrição do Produto</h3>';
			echo '<p>'.catalogo_get_desc().'</p>';
			echo '<h3>Cores</h3>';
			catalogo_product_cores(catalogo_get_id());
			echo '<p>';
			while(catalogo_get_cor_item()):
				echo "   ".catalogo_get_cor().",";
			endwhile;
			echo '</p>';
			/*echo '<h2>Categorias</h2>';
			catalogo_get_tags(catalogo_get_id());
			echo '<p>';
			while(catalogo_get_tag_item()):
				echo "   ".catalogo_tag().",";
			endwhile;
			echo '</p>';*/
			echo '<h3>Estilos</h3>';
			catalogo_product_styles(catalogo_get_id());
			echo '<p>';
			while(catalogo_get_style_item()):
				echo "   ".catalogo_get_style().",";
			endwhile;
			echo '</p>';
			echo '<h3 style="display:inline; clear:none;">Colecção: </h3>';
			echo catalogo_get_estacao();
			echo '<p>';
			echo '<h3 style="display:inline; clear:none;">Tamanhos: </h3>';
			catalogo_product_tamanhos(catalogo_get_id());
			
			while(catalogo_get_tamanho_item()):
				echo catalogo_get_tamanho()." \\ ";
			endwhile;
			echo '</p>';
			echo '<h3 style="display:inline; clear:none;">Materiais: </h3>';
			catalogo_product_materiais(catalogo_get_id());
			
			while(catalogo_get_material_details()):
				echo "   ".catalogo_get_material()." (".catalogo_get_material_percentagem()."%)   ";
			endwhile;
			echo '</p>';
			
			echo '<p>';
			echo '<h3 style="display:inline; clear:none;">Disponibilidade: </h3>';
			if(catalogo_get_disp()) {echo 'Disponível';}
			else { echo 'Indisponível';}
			echo '</p>';
			echo '<p>';
			echo '<h3 style="display:inline; clear:none;">Preço: </h3>';
			echo catalogo_get_preco();
			echo '</p>';
		echo '</div>';
		echo '<div style="clear: both;"></div>';
	echo '</div>';
	
	echo '<script>
	
		$("img.thumb").click(imageClick);
		
		
    	$(document).ready(function() {
			replaceSrc(\'img.thumb\', \'#main_image\');
    	});
	</script>';
	
	/*echo '<script>
		$("img.thumb").click 
(
    	function (evt)
    	{
        //YOUR CODE HERE

        evt.preventDefault(); 
        return false;  
    	} 
		);
		
		
    	$(document).ready(function() {
        	$(\'img.thumb\').click(function() {
				$(\'#main_image\').attr(\'src\',this.src);
        });
    	});
	</script>';*/
?>