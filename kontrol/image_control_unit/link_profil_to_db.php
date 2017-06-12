<?php 
include_once"../../connt.php";
session_start();

$do = $_POST['do'];

if($do == "add"){
		$id = $_POST['user'];
		$profil = $_POST['profil'];
		$by = $_POST['by'];
		$date = date('y-m-d');
		
		//$trueimg = $_SESSION['the_true'];
		$query = mysqli_query($koneksi,"UPDATE anggota SET profil='$profil' WHERE id_anggota = '$id'");
		$query2= mysqli_query($koneksi,"INSERT INTO image_anggota(id_anggota, link_img, add_at) VALUES ('$id','$profil','$date')");
		
		
			$all_temp = mysqli_query($koneksi,"SELECT * FROM img_tmp WHERE id_user_or_admin = '$by'");
				while($temp = mysqli_fetch_assoc($all_temp)){
							$path = "../../images/profil/".$temp['the_temp'];
							unlink($path);
				
				}
		
		$clearing = mysqli_query($koneksi,"DELETE FROM img_tmp WHERE id_user_or_admin = '$by'");
		unset($_SESSION['the_true']);
		//echo $id ;
}

else if($do == "edit"){
		$id = $_POST['user'];
		$profil = $_POST['profil'];
		$by = $_POST['by'];
		$date = date('y-m-d');
		//$trueimg = $_SESSION['the_true'];
		$query = mysqli_query($koneksi,"UPDATE anggota SET profil='$profil' WHERE id_anggota = '$id'");
		$query2= mysqli_query($koneksi,"INSERT INTO image_anggota(id_anggota, link_img, add_at) VALUES ('$id','$profil','$date')");
		
		
		
		
			$all_temp = mysqli_query($koneksi,"SELECT * FROM img_tmp WHERE id_user_or_admin = '$by'");
				while($temp = mysqli_fetch_assoc($all_temp)){
							$path = "../../images/profil/".$temp['the_temp'];
							unlink($path);
				}
		
		$clearing = mysqli_query($koneksi,"DELETE FROM img_tmp WHERE id_user_or_admin = '$by'");
		unset($_SESSION['the_true']);
		echo $id ;
}

///Hapus profil yg gk jadi di pake padahal dah di upload pas klik batal
if($_POST['do'] == "batalprofil"){
	$by = $_POST['id'];
	
	$all_temp = mysqli_query($koneksi,"SELECT * FROM img_tmp WHERE id_user_or_admin = '$by'");
	while($temp = mysqli_fetch_assoc($all_temp)){
		$path = "../../images/profil/".$temp['the_temp'];
		unlink($path);
	}
	
	$clearing = mysqli_query($koneksi,"DELETE FROM img_tmp WHERE id_user_or_admin = '$by'");
}
if($_POST['do'] == "lewat_ja"){
	$id = $_POST['user'];
	$by = $_POST['id'];
	$profil = "../../images/profil/default_avatar.png";
	
	$all_temp = mysqli_query($koneksi,"SELECT * FROM img_tmp WHERE id_user_or_admin = '$by'");
	while($temp = mysqli_fetch_assoc($all_temp)){
		$path = "../../images/profil/".$temp['the_temp'];
		unlink($path);
	}
	$query = mysqli_query($koneksi,"UPDATE anggota SET profil='$profil' WHERE id_anggota = '$id'");
	$clearing = mysqli_query($koneksi,"DELETE FROM img_tmp WHERE id_user_or_admin = '$by'");
}


?>