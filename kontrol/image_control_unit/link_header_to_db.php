<?php 
include_once"../../connt.php";

$do = $_POST['do'];

if($do == "add"){
		$id = $_POST['post'];
		$header = $_POST['header'];
		//$date = date('y-m-d');
		
		$query = mysqli_query($koneksi,"UPDATE blog SET header='$header' WHERE id_artikel = '$id'");
		
		//echo $id ;
}

/*else if($do == "edit"){
		$id = $_POST['user'];
		$profil = $_POST['profil'];
		//$date = date('y-m-d');
		
		$query = mysqli_query($koneksi,"UPDATE anggota SET profil='$profil' WHERE id_anggota = '$id'");
		
		echo $id ;
}*/



?>