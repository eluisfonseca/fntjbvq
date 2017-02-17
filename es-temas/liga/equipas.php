<?PhP
addJSinit('resizeQuem();');
addJSresize('resizeQuem();');
get_header();
?>
<link href="es-temas/liga/css/1-col-portfolio.css" rel="stylesheet">
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

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Company 2013</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

<?PhP
get_footer();
?>