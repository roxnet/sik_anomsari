<?php 
include("../layout/layoutmember.php"); // memanggil file header.php
include("../connt.php"); // memanggil file koneksi.php untuk koneksi ke database
include ('../kontrol/session_cekker.php');
?>
	<div class="container">
		<div class="content">
			<h2>Data Anggota &raquo; Ganti Password</h2>
			<hr />
			
			<p>Ganti password  <?php echo '<b>'.$_GET['id'].'</b>'; // mengambil nilai nim dari data yang dipilih ?></p> 
			
			<?php
			if(isset($_POST['ganti'])){ // jika tombol 'Simpan' dengan properti name="ganti" pada baris 64 ditekan
				$id		= $_GET['id'];
				$pass 	= md5($_POST['pass']); // assigment password dengan enkripsi md5
				$pass1 	= $_POST['pass1'];
				$pass2 	= $_POST['pass2'];
				
				$cek = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota='$id' AND password='$pass'"); // query memilih nim dan password
				if(mysqli_num_rows($cek) == 0){ // mengecek query $cek jika password yang dimasukkan tidak sesuai dengan nim
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password salah masukan password yang benar</div>'; // maka tampilkan 'Password salah masukan password yang benar'
				}else{
					if($pass1 == $pass2){ // jika nilai password1 dan password2 bernilai sama
						if(strlen($pass1) >= 6){ // mengecek panjang password minimal 6 karakter
							$passup = md5($pass1); // enkripsi password dengan md5
							$update = mysqli_query($koneksi, "UPDATE anggota SET password='$passup' WHERE id_anggota='$id'"); // query update password dari nim yang dipilih
							if($update){ // jika query update berhasil dieksekusi
								echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password berhasil dirubah.</div>'; // maka tampilkan 'Password berhasil dirubah.'
							}else{ // jika query update gagal dieksekusi
								echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password gagal dirubah.</div>'; // maka tampilkan 'Password gagal dirubah.'
							}
						}else{ // jika panjang password kurang dari 6 karakter 
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Panjang karakter Password minimal 6 karakter.</div>'; // maka tampilkan 'Panjang karakter Password minimal 6 karakter.'
						}
					}else{ // jika password1 dan password2 bernilai berbeda
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pasword tidak sama</div>'; // maka tampilkan 'Pasword tidak sama'
					}
				}
			}
			?>
			<!-- bagian ini merupakan bagian form untuk mengupdate password baru yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Password Lama</label>
					<div class="col-sm-4">
						<input type="password" name="pass" class="form-control" placeholder="Password Lama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password Baru</label>
					<div class="col-sm-4">
						<input type="password" name="pass1" class="form-control" placeholder="Password Baru" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Ulangi Password Baru</label>
					<div class="col-sm-4">
						<input type="password" name="pass2" class="form-control" placeholder="Ulangi Password baru" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="ganti" class="btn btn-sm btn-info" value="Simpan" data-toggle="tooltip" title="Simpan Password Baru">
						<a href="data.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal"><b>Batal</b></a>
					</div>
				</div>
			</form>
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("plug.php"); // memanggil file footer.php
?>