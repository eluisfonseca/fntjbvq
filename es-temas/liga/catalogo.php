
<?PhP
get_header();
?>

<body id="catalogo" class="no-touch">

<?PhP
get_menu();
?>

<div id="catalogo_container">
<h1 style="text-align:center"> CATÁLOGO DE PRODUTOS</h1>
<hr>
    <div class="content">
    <h1 style="text-align:center"> Search Terms</h1>
    <form style="text-align:justify;" method ="POST" ACTION = "?p=catalogo">
    	
		<p><b>Separar por:</b>
        <?PhP
        echo '<input type="radio" name="crit" value="all"';
		if((reqvlr('crit')=="all") || !reqvlr('crit') || reqvlr('clear')) {
			echo ' checked>';
			}
		else{
			echo '>';
			}
		echo 'All';
		echo '<input type="radio" name="crit" value="style"';
		if(!reqvlr('clear') && (reqvlr('crit')=="style")) {
			echo ' checked>';
			}
		else{
			echo '>';
			}
		echo 'Estilo';
		echo '<input type="radio" name="crit" value="model"';
		if(!reqvlr('clear') && (reqvlr('crit')=="model")) {
			echo ' checked>';
			}
		else{
			echo '>';
			}
		echo 'Modelos';
		echo '<input type="radio" name="crit" value="colection"';
		if(!reqvlr('clear') && (reqvlr('crit')=="colection")) {
			echo ' checked>';
			}
		else{
			echo '>';
			}
		echo 'Colecção';
		?>
                </p>
        <p><b>Tamanhos:</b>
        <?PhP catalogo_list_tamanhos(); 
			while(catalogo_get_tamanho_item()):
					echo '<input type="checkbox" name="tamanho-'.catalogo_get_tamanho_id().'" value="';
					echo catalogo_get_tamanho_id();
					if(!reqvlr('clear') && reqvlr('tamanho-'.catalogo_get_tamanho_id())) {
						echo '" checked>';
					}
					else{
						echo '">';
					}
					echo catalogo_get_tamanho();
				endwhile;?>
                </p>
        <p> <b>Peças: </b>
        <?PhP catalogo_list_tipos(); 
			while(catalogo_get_tipo_item()):
					echo '<input type="checkbox" name="tipo-'.catalogo_get_tipo_id().'" value="';
					echo catalogo_get_tipo_id();
					if(reqvlr('tipo-'.catalogo_get_tipo_id()) && !reqvlr('clear')) {
						echo '" checked>';
					}
					else{
						echo '">';
					}
					echo catalogo_get_tipo();
				endwhile;?>
        </p>
        <p> <b>Cor: </b>
        <?PhP catalogo_list_cores(); 
			while(catalogo_get_cor_item()):
					echo '<input type="checkbox" name="cor-'.catalogo_get_cor_id().'" value="';
					echo catalogo_get_cor_id();
					if(reqvlr('cor-'.catalogo_get_cor_id()) && !reqvlr('clear')) {
						echo '" checked>';
					}
					else{
						echo '">';
					}
					echo catalogo_get_cor();
				endwhile;?>
        </p>
        <p> <b>Material: </b>
        <?PhP catalogo_list_materiais(); 
			while(catalogo_get_material_item()):
					echo '<input type="checkbox" name="material-'.catalogo_get_material_id().'" value="';
					echo catalogo_get_material_id();
					if(reqvlr('material-'.catalogo_get_material_id()) && !reqvlr('clear')) {
						echo '" checked>';
					}
					else{
						echo '">';
					}
					echo catalogo_get_material();
				endwhile;?>
        </p>
        <p><b>Produtos por página:</b>
        <?PhP
			if(reqvlr('numero')==10) {
				echo '<input type="radio" name="numero" value="10" checked>10
				<input type="radio" name="numero" value="25">25
            	<input type="radio" name="numero" value="50">50';
			}
			if(reqvlr('numero')==25) {
				echo '<input type="radio" name="numero" value="10">10
				<input type="radio" name="numero" value="25" checked>25
            	<input type="radio" name="numero" value="50">50';
			}
			if(reqvlr('numero')==50) {
				echo '<input type="radio" name="numero" value="10">10
				<input type="radio" name="numero" value="25">25
            	<input type="radio" name="numero" value="50" checked>50';
			}
			if(!reqvlr('numero')){
				echo '<input type="radio" name="numero" value="10" checked>10
				<input type="radio" name="numero" value="25">25
            	<input type="radio" name="numero" value="50">50';
			}
		?>
        	
            
        </p>
        <!-- <p> <b>Cor Produto 1: 
        ?PhP catalogo_product_materiais(1); 
			while(catalogo_get_material_item()):
					echo catalogo_get_material_id();
					echo ' - ';
					echo catalogo_get_material();
				endwhile;?>
        </p> -->
        <input type="submit" name="apply" value="Aplicar Filtro">
        <input type="submit" name="clear" value="Limpar Filtro">


    </div>
  <hr>
   <?PhP
		catalobyclass();
			
	?>
    
  
  </form>
  
  </div>
 <!-- Add some JavaScript to enable toggling the descriptions when an image is tapped on a touchscreen device -->
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
  <script type="text/javascript">
    $(function(){
      // See if this is a touch device
      if ('ontouchstart' in window)
      {
        // Set the correct body class
        $('body').removeClass('no-touch').addClass('touch');
        
        // Add the touch toggle to show text
        $('div.boxInner img').click(function(){
          $(this).closest('.boxInner').toggleClass('touchFocus');
        });
      }
    });
  </script>
<?PhP
get_footer();
?>