
<?PhP
get_header();
?>
<link href="es-temas/liga/css/3-col-portfolio.css" rel="stylesheet">
</head>

<body>

<?PhP
get_menu();
?>


<div class="container">

     <?PhP 
            paginas();
            pagina();
            echo theContent();
  ?>
    </div>
    <!-- /container -->
  
<script src="es-code/js/jquery-1.10.2.js"></script>
<script src="es-code/js/bootstrap.js"></script>


<?PhP
get_footer();
?>

