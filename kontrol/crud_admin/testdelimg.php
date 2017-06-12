
<?php
	//session_start();
	
	//session_unset($_SESSION['gold']);
	//$_SESSION['gold']='avatar58ef344d03708.jpg';
	if(file_exists("../images/profil/58ee2072dbcd6.jpg")){
		//echo '<img src="../images/profil/58ee2072dbcd6.jpg" width="250" height="250">' ;
		unlink("../images/profil/58ee2072dbcd6.jpg");
		unlink("../images/profil/_58ee2072dbcd6.jpg");
		
		echo "Beres";
	}else echo "free";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
					/*
											//unlink("../images/profil/");
											//unlink("../images/profil/_58ee2072dbcd6.jpg");
											echo "ketemu kapten" ;

					}else echo "gk ketemu kapten";*/
?>
