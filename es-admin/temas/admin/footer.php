<?PhP
if((isset($_SESSION["ERR_A"])) && ($_SESSION["ERR_A"] != 0)){
	if($_SESSION["ERR_A"] == 1){
		echo '<div id="err1">'.$_SESSION["ERR_B"].'</div>';
	}elseif($_SESSION["ERR_A"] == -1){
		echo '<div id="err2">'.$_SESSION["ERR_B"].'</div>';
	}
	$_SESSION["ERR_A"]	= 0;
}
#####################################################
#						    						#
#		2013 CopyRight - evenSimpler        		#
#		evenSimpler.net		    					#
#		evenSimpler@evenSimpler.net	    			#
#						    						#
#####################################################
?>

</body>
</html>
