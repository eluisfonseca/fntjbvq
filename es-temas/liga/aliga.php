
<?PhP
get_header();
?>
<link href="es-temas/liga/css/business-frontpage.css" rel="stylesheet">
</head>

<body>

<?PhP
get_menu();
?>


    <div class="business-header">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <!-- The background image is set in the custom CSS -->
                    <h1 class="tagline">Federação Nacional de Tipos que Jogam à Bola de Vez em Quando</h1>
                </div>
            </div>

        </div>

    </div>

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

