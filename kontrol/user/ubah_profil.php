<?php
include_once "../../connt.php";
session_start();


if(isset($_POST['do'])){
	if($_POST['do']=="edit"){
				$id				 = mysqli_real_escape_string($koneksi,$_POST['id']);
				$email		     = mysqli_real_escape_string($koneksi,$_POST['email']);
				//$pass1	         = $_POST['pass1'];
				//$pass2           = $_POST['pass2'];
				$phonenumber	 = mysqli_real_escape_string($koneksi,$_POST['phonenumber']);
				//$level   		 = mysqli_real_escape_string($koneksi,$_POST['level']);
				
				$id_keluarga	 = mysqli_real_escape_string($koneksi,$_POST['id_keluarga']);
				$nickname		 = mysqli_real_escape_string($koneksi,$_POST['nickname']);
				$name		     = mysqli_real_escape_string($koneksi,$_POST['name']);
				$gender			 = mysqli_real_escape_string($koneksi,$_POST['gender']);
				$bloodtype		 = mysqli_real_escape_string($koneksi,$_POST['bloodtype']);
				$birthplace		 = mysqli_real_escape_string($koneksi,$_POST['birthplace']);
				$birthdate 		 = mysqli_real_escape_string($koneksi,$_POST['birthdate']);
				$adress			 = mysqli_real_escape_string($koneksi,$_POST['adress']);
				$job		     = mysqli_real_escape_string($koneksi,$_POST['job']);
				//$status		     = "offline";

				$ayah		=mysqli_real_escape_string($koneksi,$_POST['ayah']);
				$ibu		=mysqli_real_escape_string($koneksi,$_POST['ibu']);
				$pasangan	=mysqli_real_escape_string($koneksi,$_POST['namapasangan']);
				//$life		=mysqli_real_escape_string($koneksi,$_POST['deathlife']);

					
						$update = mysqli_query($koneksi, "UPDATE anggota SET email='$email', nickname='$nickname', name='$name', gender='$gender', bloodtype='$bloodtype', birthplace='$birthplace', birthdate='$birthdate', address='$adress', id_keluarga='$id_keluarga', job='$job' 
															WHERE id_anggota ='$id'") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						$userid = mysqli_insert_id($koneksi);
						
						$cekphone = mysqli_query($koneksi,"SELECT * FROM phone_number WHERE id_anggota = '$id'");
						$hasil = mysqli_num_rows($cekphone);
							
							if($hasil >= 1){
								$phonenumberx=mysqli_query($koneksi,"UPDATE phone_number SET phone_number='$phonenumber' WHERE id_anggota='$id'");
								}
							else if($hasil == 0 ){
									$phonenumber2=mysqli_query($koneksi,"INSERT INTO phone_number(id_anggota,phone_number) VALUES('$id','$phonenumber')");
								}
						
						
									$setddir=mysqli_query($koneksi,"UPDATE data_diri SET ayah='$ayah',ibu='$ibu',pasangan='$pasangan' WHERE id_anggota='$id'");
								
			
					
					//echo "OK"; 
		}
		else if($_POST['do']=="changepass"){
				$id				 = mysqli_real_escape_string($koneksi,$_POST['id']);
				$old_pass				 = mysqli_real_escape_string($koneksi,$_POST['old_pass']);
				$new_pass				 = mysqli_real_escape_string($koneksi,$_POST['new_pass']);
				
				$old_password = md5($old_pass);
				$new_password = md5($new_pass);
				
				
				$take_pass = mysqli_query($koneksi,"SELECT password FROM anggota WHERE id_anggota = '$id'");
				$the_passIS = mysqli_fetch_array($take_pass);
				
				if($old_password == $the_passIS['password']){
						$change_pass = mysqli_query($koneksi,"UPDATE anggota SET password = '$new_password' WHERE id_anggota = '$id	'");
						echo '<h4 style="color:green"><b>Password anda berhasil diubah</b></h4>';
				}else echo '<h4 style="color:red"><b>Password anda gagal diubah, periksa kembali password lama yang anda gunakan!!</b></h4>';

		}		
		else if($_POST['do']=="changeprofl"){
				$id_user				 = mysqli_real_escape_string($koneksi,$_POST['id_user']);
				$for_use				 = mysqli_real_escape_string($koneksi,$_POST['for_use']);
				
				$use_imgtoproffl = mysqli_query($koneksi,"UPDATE anggota SET profil = '$for_use' WHERE id_anggota = '$id_user' ");
				
				if($use_imgtoproffl){
					echo "OK";
					
				}else echo '<h4 style="color:red"><b>Gagal</b></h4>';
		}
}

?>