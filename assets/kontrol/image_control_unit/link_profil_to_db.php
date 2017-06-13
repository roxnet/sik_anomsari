<?php 
include_once"../../connt.php";

$do = $_POST['do'];

if($do == "add"){
		$id = $_POST['user'];
		$profil = $_POST['profil'];
		$date = date('y-m-d');
		
		$query = mysqli_query($koneksi,"UPDATE anggota SET profil='$profil' WHERE id_anggota = '$id'");
		$query2= mysqli_query($koneksi,"INSERT INTO image_anggota(id_anggota, link_img, add_at) VALUES ('$id','$profil','$date')");
		
		//echo $id ;
}

else if($do == "edit"){
		$id = $_POST['user'];
		$profil = $_POST['profil'];
		$date = date('y-m-d');
		
		$query = mysqli_query($koneksi,"UPDATE anggota SET profil='$profil' WHERE id_anggota = '$id'");
		$query2= mysqli_query($koneksi,"INSERT INTO image_anggota(id_anggota, link_img, add_at) VALUES ('$id','$profil','$date')");
		
		echo $id ;
}



?>