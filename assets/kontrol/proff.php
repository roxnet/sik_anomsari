<?php
	include_once "../connt.php";
	session_start();
	

	if(isset($_POST['do'])){
		$login=$_POST['do'];
		if($login=="profile"){
			if(isset($_POST['pndaftar'])){
				$pndftr		     = $_POST['pndaftar'];
			}else echo "failed pdftr";
			
			if(isset($_POST['proffl'])){			
				$proffl	         = $_POST['proffl'];
			}else echo "failed prffl";
			
													//UPDATE `pendaftar` SET `profil`= "58eea60eabd5c.jpg" WHERE id_anggota = 6 ;
				$savess = mysqli_query($koneksi, "UPDATE pendaftar SET profil='$proffl' WHERE id_anggota='$pndftr' ");
			
				//echo "ok";
				
				unset($_POST['pndaftar']);
				unset($_POST['proffl']);
				
			
		}
		else if($login=="profileAnggota"){
			if(isset($_POST['anggotanya'])){
				$anggotanya		     = $_POST['anggotanya'];
			}else echo "failed pdftr";
			
			if(isset($_POST['proffl'])){			
				$proffl	         = $_POST['proffl'];
				$date 			 = date("Y-m-d");
			}else echo "failed prffl";
			
			
													//UPDATE `pendaftar` SET `profil`= "58eea60eabd5c.jpg" WHERE id_anggota = 6 ;
				$savess = mysqli_query($koneksi, "UPDATE anggota SET profil='$proffl' WHERE id_anggota='$anggotanya' ");
				
				$save_img_user = mysqli_query($koneksi, "INSERT INTO image_anggota (id_anggota, link_img, add_at)
																	VALUES ('$anggotanya','$proffl','$date')");
			
				//echo "ok";
				unset($_POST['anggotanya']);
				unset($_POST['proffl']);
			
		}
	}echo "deep failed";
?>