<?php
	include_once "../connt.php";
	session_start();
	

	if(isset($_POST['login'])){
		$login=$_POST['login'];
		
		
		//Bagian auth login
		if($login=="in"){
			$email=$_POST['email_login'];
			$password=$_POST['password_login'];
			$cekpass=md5($password);
			$query="SELECT * FROM anggota WHERE email='$email' and password='$cekpass'";
			$value=mysqli_query($koneksi,$query);
			
			if(mysqli_num_rows($value)==1){
				$ambil=mysqli_fetch_assoc($value);

				/*id anggota telah disimpan di session*/

				$_SESSION['id_user'] = $ambil['id_anggota'];
				$online = mysqli_query($koneksi,"UPDATE anggota SET status = 'online' WHERE id_anggota='".$ambil['id_anggota']."'");
				
				echo "true";
			}
			else{
				die("<div class='alert alert-danger' role='alert'>email atau password yang anda masukkan salah!!</div>");
				}
		}
		
		//Bagian pendaftaran !!!!
		else if($login=="daftar"){
				$email		     = $_POST['email'];
				$pass1	         = $_POST['pass1'];
				$pass2           = $_POST['pass2'];
				$phonenumber	 = $_POST['phonenumber'];
				$job		     = $_POST['job'];
				
				$ayah	 		= $_POST['ayah'];
				$ibu	 		= $_POST['ibu'];
				$id_keluarga	 = $_POST['id_keluarga'];
				$nickname		 = $_POST['nickname'];
				$name		     = $_POST['name'];
				$gender			 = $_POST['gender'];
				$bloodtype		 = $_POST['bloodtype'];
				$birthplace		 = $_POST['birthplace'];
				$birthdate 		 = $_POST['birthdate'];
				$adress			 = $_POST['adress'];
				$life		="life";
				$level		="user";
				$konfirm	="notyet";
				$status		="offline";
				$profil		="../../images/profil/default_avatar.png";
				
				$namapasangan			 = $_POST['namapasangan'];
				
						
				
					if($pass1 == $pass2){ 									
						$password = md5($pass1);
					}
					 else{ // mengecek jika password yang diinput tidak sama
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>'; // maka tampilkan 'Password Tidak sama!'
					}
						
						$insert = mysqli_query($koneksi, "INSERT INTO anggota(email, password, nickname, name, profil, gender, bloodtype, birthplace, birthdate, address, id_keluarga, job, level_user, status, konfirmasi) 
															VALUES('$email','$password', '$nickname', '$name', '$profil','$gender', '$bloodtype', '$birthplace', '$birthdate', '$adress', '$id_keluarga', '$job', '$level', '$status','$konfirm')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						$idpendaftarnya = mysqli_insert_id($koneksi);
						$userid = mysqli_insert_id($koneksi);
						//$_SESSION['anggotanya']=$userid;
						
						$phonenumberinsrt=mysqli_query($koneksi,"INSERT INTO phone_number(id_anggota,phone_number) VALUES('$userid','$phonenumber')");
						$datadir=mysqli_query($koneksi,"INSERT INTO data_diri(id_anggota,ayah,ibu,pasangan,life) VALUES('$userid','$ayah','$ibu','$pasangan','$life')");
						
	
					 echo "ok";
		}
		else if($login=="profile"){
			if(isset($_POST['pndaftar'])){
				$pndftr		     = $_POST['pndaftar'];
			}else echo "failed pdftr";
			
			if(isset($_POST['proffl'])){			
				$proffl	         = $_POST['proffl'];
			}else echo "failed prffl";
			
													//UPDATE `pendaftar` SET `profil`= "58eea60eabd5c.jpg" WHERE id_anggota = 6 ;
				$savess = mysqli_query($koneksi, "UPDATE pendaftar SET profil='$proffl' WHERE id_anggota=6 ");
			if($savess)	{
				echo "ok";
			}else echo "ggl querynya";
			
		}
	}
?>