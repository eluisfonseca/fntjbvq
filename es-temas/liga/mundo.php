
<?PhP
get_header();
?>

<body id="mundo">

<?PhP
get_menu();
?>

<div id="mundo_area">
<div id="noticias">
  	<?PhP
		news();
			
	?>
    <p align="center"> <a href="?p=newslist"> Archive </a></p>
    </div>
    <div id="area1">
        <div id="area1-1">
            	<img src="es-temas/Leicil/img/logo_medio_branco.png">
   	  	</div>
        <div id="area1-2">
        	<?PhP
        	novidades();
			?>
            <p align="center"> <a href="?p=novslist"> Archive </a></p>
        </div>
  </div>
        <div style="clear:both"></div>
</div>

<?PhP
get_footer();
?>