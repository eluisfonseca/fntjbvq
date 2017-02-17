<html>
<?PhP
get_header();
?>

<body id="catalogo">

<?PhP
get_menu();
?>

<div class="content">
<?PhP
catalogo_get_one(reqvlr('productID'));
?>
</div>

<?PhP
get_footer();
?>
