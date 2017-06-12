<?php
	include_once "../connt.php";
	session_start();
	

	if(isset($_POST['login'])){
		$login=$_POST['login'];
		
		
		//Bagian auth login
		if($login=="in"){
			$email= mysqli_real_escape_string($koneksi,$_POST['email_login']);
			$password=mysqli_real_escape_string($koneksi,$_POST['password_login']);
			$cekpass=md5($password);
			$query="SELECT * FROM anggota WHERE email='$email' and password='$cekpass'";
			$value=mysqli_query($koneksi,$query);
			
			if(mysqli_num_rows($value)==1){
				$ambil=mysqli_fetch_array($value);
				$_SESSION['id_user'] = $ambil['id_anggota'];
				$online = mysqli_query($koneksi,"UPDATE anggota SET status = 'online' WHERE id_anggota='".$ambil['id_anggota']."'");
				
				echo "true";
			}
			else{
				die("<div class='alert alert-danger' role='alert'>emil atau password yang anda masukkan salah!!</div>");
				}
		}
		
		//Bagian pendaftaran !!!!
		else if($login=="daftar"){
				$email		     = mysqli_real_escape_string($koneksi,$_POST['email']);
				$pass1	         = mysqli_real_escape_string($koneksi,$_POST['pass1']);
				$pass2           = mysqli_real_escape_string($koneksi,$_POST['pass2']);
				$phonenumber	 = mysqli_real_escape_string($koneksi,$_POST['phonenumber']);
				$job		     = mysqli_real_escape_string($koneksi,$_POST['job']);
				
				$ayah	 			= mysqli_real_escape_string($koneksi,$_POST['ayah']);
				$ibu	 			= mysqli_real_escape_string($koneksi,$_POST['ibu']);
				$id_keluarga	 = mysqli_real_escape_string($koneksi,$_POST['id_keluarga']);
				$nickname		 = mysqli_real_escape_string($koneksi,$_POST['nickname']);
				$name		     = mysqli_real_escape_string($koneksi,$_POST['name']);
				$gender			 = mysqli_real_escape_string($koneksi,$_POST['gender']);
				$bloodtype		 = mysqli_real_escape_string($koneksi,$_POST['bloodtype']);
				$birthplace		 = mysqli_real_escape_string($koneksi,$_POST['birthplace']);
				$birthdate 		 = mysqli_real_escape_string($koneksi,$_POST['birthdate']);
				$adress			 = mysqli_real_escape_string($koneksi,$_POST['adress']);
				$life		="life";
				
				$namapasangan			 = mysqli_real_escape_string($koneksi,$_POST['namapasangan']);
				
						
				
					if($pass1 == $pass2){ 									
						$password = $pass1; 

						
						$insert = mysqli_query($koneksi, "INSERT INTO pendaftar(email, password, nickname, name, gender, bloodtype, birthplace, birthdate, adress, phonenumber, id_keluarga, job) 
															VALUES('$email','$password', '$nickname', '$name', '$gender', '$bloodtype', '$birthplace', '$birthdate', '$adress', '$phonenumber', '$id_keluarga', '$job')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						$idpendaftarnya = mysqli_insert_id($koneksi);
						$insert2 = mysqli_query($koneksi, "INSERT INTO data_diri(id_anggota, ayah, ibu, pasangan, life) 
															VALUES('$idpendaftarnya', '$ayah', '$ibu', '$namapasangan', '$life')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						
						//$_SESSION['idpendaftarnya'] = $idpendaftarnya;
					 echo $idpendaftarnya;
					} else{ // mengecek jika password yang diinput tidak sama
							echo "failed";//die("<div class='alert alert-danger' role='alert'>emil atu password salah!!</div>");
					}
		}
		else if($login=="profile"){
			if(isset($_POST['user'])){
				$pndftr		     = $_POST['user'];
			}else echo "failed pdftr";
			
			if(isset($_POST['profil'])){			
				$proffl	         = $_POST['profil'];
			}else echo "failed prffl";
			
													//UPDATE `pendaftar` SET `profil`= "58eea60eabd5c.jpg" WHERE id_anggota = 6 ;
				$savess = mysqli_query($koneksi, "UPDATE pendaftar SET profil='$proffl' WHERE id_anggota='$pndftr' ");
			if($savess)	{
				echo "ok";
			}else echo "ggl querynya";
			
		}
	}
?>