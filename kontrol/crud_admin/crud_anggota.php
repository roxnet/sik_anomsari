<?php
include_once "../../connt.php";
session_start();

	if(isset($_POST['do'])){
		if($_POST['do']=="tambah"){
				$email		     = mysqli_real_escape_string($koneksi,$_POST['email']);
				$pass1	         = mysqli_real_escape_string($koneksi,$_POST['pass1']);
				$pass2           = mysqli_real_escape_string($koneksi,$_POST['pass2']);
				$phonenumber	 = mysqli_real_escape_string($koneksi,$_POST['phonenumber']);
				$level   		 = mysqli_real_escape_string($koneksi,$_POST['level']);
				
				$id_keluarga	 = mysqli_real_escape_string($koneksi,$_POST['id_keluarga']);
				$nickname		 = mysqli_real_escape_string($koneksi,$_POST['nickname']);
				$name		     = mysqli_real_escape_string($koneksi,$_POST['name']);
				$gender			 = mysqli_real_escape_string($koneksi,$_POST['gender']);
				$bloodtype		 = mysqli_real_escape_string($koneksi,$_POST['bloodtype']);
				$birthplace		 = mysqli_real_escape_string($koneksi,$_POST['birthplace']);
				$birthdate 		 = mysqli_real_escape_string($koneksi,$_POST['birthdate']);
				$adress			 = mysqli_real_escape_string($koneksi,$_POST['adress']);
				$job		     = mysqli_real_escape_string($koneksi,$_POST['job']);
				$status		     = "offline";
				$konfirm 		 = "ok"; 
				
				$ayah		= mysqli_real_escape_string($koneksi,$_POST['ayah']);
				$ibu		= mysqli_real_escape_string($koneksi,$_POST['ibu']);
				$pasangan	= mysqli_real_escape_string($koneksi,$_POST['namapasangan']);
				$life		= mysqli_real_escape_string($koneksi,$_POST['deathlife']);

				
					if($pass1 == $pass2){ 									
						$password = md5($pass1);
					}
					 else{ // mengecek jika password yang diinput tidak sama
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>'; // maka tampilkan 'Password Tidak sama!'
					}
						$insert = mysqli_query($koneksi, "INSERT INTO anggota(email, password, nickname, name, gender, bloodtype, birthplace, birthdate, address, id_keluarga, job, level_user, status, konfirmasi) 
															VALUES('$email','$password', '$nickname', '$name', '$gender', '$bloodtype', '$birthplace', '$birthdate', '$adress', '$id_keluarga', '$job', '$level', '$status','$konfirm')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						$userid = mysqli_insert_id($koneksi);
						//$_SESSION['anggotanya']=$userid;
						
						$phonenumberinsrt=mysqli_query($koneksi,"INSERT INTO phone_number(id_anggota,phone_number) VALUES('$userid','$phonenumber')");
						$datadir=mysqli_query($koneksi,"INSERT INTO data_diri(id_anggota,ayah,ibu,pasangan,life) VALUES('$userid','$ayah','$ibu','$pasangan','$life')");
	
					echo $userid;
		}else if($_POST['do']=="edit"){
				$id				 = mysqli_real_escape_string($koneksi,$_POST['id']);
				$email		     = mysqli_real_escape_string($koneksi,$_POST['email']);
				$pass1	         = $_POST['pass1'];
				$pass2           = $_POST['pass2'];
				$phonenumber	 = mysqli_real_escape_string($koneksi,$_POST['phonenumber']);
				$level   		 = mysqli_real_escape_string($koneksi,$_POST['level']);
				
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
				$life		=mysqli_real_escape_string($koneksi,$_POST['deathlife']);

					if($pass1 == $pass2){ 									
						$password = $pass1; 
					} else{ // mengecek jika password yang diinput tidak sama
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>'; // maka tampilkan 'Password Tidak sama!'
					}
						$update = mysqli_query($koneksi, "UPDATE anggota SET email='$email', nickname='$nickname', name='$name', gender='$gender', bloodtype='$bloodtype', birthplace='$birthplace', birthdate='$birthdate', address='$adress', id_keluarga='$id_keluarga', job='$job', level_user='$level' 
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
						
						$cekddir=mysqli_query($koneksi,"SELECT * FROM data_diri WHERE id_anggota = '$id'");
						
						$hasilddir = mysqli_num_rows($cekddir);
							
							if($hasilddir == 1 ){
									$setddir=mysqli_query($koneksi,"UPDATE data_diri SET ayah='$ayah',ibu='$ibu',pasangan='$pasangan',life='$life' WHERE id_anggota='$id'");
								}else if($hasilddir == 0 ){
									$addddir=mysqli_query($koneksi,"INSERT INTO data_diri(id_anggota,ayah,ibu,pasangan,life) VALUES('$id','$ayah','$ibu','$pasangan','$life')");
								}
			
					

		}else if($_POST['do']=="view"){
			$id = $_POST["id"];
			$del=isset($_POST["del"]);
			$viewa = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = $id");
					while($rows= mysqli_fetch_assoc($viewa)){
						

					$Ynow = date('Y');
					$Ybirth=date("Y", strtotime($rows['birthdate']));
					$Mnow = date('m');
					$Mbirth=date("m", strtotime($rows['birthdate']));
					$Yfg = $Ynow - $Ybirth;					
					$mfg = $Mnow - $Mbirth;
					$min = $mfg / 12;
					$age = $Yfg + $min;
					$set3 = mysqli_query($koneksi, "SELECT * FROM data_diri WHERE id_anggota = $id");
						while($dir = mysqli_fetch_assoc($set3)){
							$ayah = $dir['ayah'];
							$ibu = $dir['ibu'];
							$pasangan = $dir['pasangan'];
							$life = $dir['life'];
						}
						
						
			echo'
						<div class="modal-body">
							<table class="table table-hover">
							
							<tr>
								<td colspan="2" align="">';
							echo '<img src="../images/profil/'.$rows["profil"].'" width="250">'; ////<------------

			echo'				</td>
							</tr>
							<tr>
								<td>Nama panggilan <text class="pull-right">:</text></td>
								<td>'.$rows["nickname"].'</td>
							</tr>
							<tr>
								<td>Nama lengkap <text class="pull-right">:</text></td>
								<td>'.$rows["name"].'</td>
							</tr>
							<tr>
								<td>Jenis kelamin <text class="pull-right">:</text></td>
								<td>';
								if ($rows["gender"]=="L"){
									echo 'Laki-laki';
								}else echo 'Perempuan';
								
			echo				'</td>
							</tr>
							<tr>
								<td>Golongan darah <text class="pull-right">:</text></td>
								<td>'.$rows["bloodtype"].'</td>
							</tr>
							<tr>
								<td>Tempat/Tanggal lahir <text class="pull-right">:</text></td>
								<td>'.$rows["birthplace"].' / '.date("d F Y", strtotime($rows["birthdate"])).' ('.floor($age).' tahun)</td>
							</tr>
							<tr>
								<td colspan="2"><br/></td>
							</tr>
							<tr>
								<td>Nama Ayah <text class="pull-right">:</text></td>
								<td>'.$ayah.'</td>
							</tr>
							<tr>
								<td>Nama Ibu <text class="pull-right">:</text></td>
								<td>'.$ibu.'</td>
							</tr>';
					if($pasangan == null){
						
					}
					else if($pasangan != null){
			echo'			<tr>
								<td>Nama Suami/Istri <text class="pull-right">:</text></td>
								<td>'.$pasangan.'</td>
							</tr>';
					$selectanakayah = mysqli_query($koneksi,"SELECT * FROM data_diri WHERE ayah='".$rows["name"]."'");
					$hasilselectanakayah= mysqli_num_rows($selectanakayah);
					if($hasilselectanakayah == 0){
						$selectanakibu = mysqli_query($koneksi,"SELECT * FROM data_diri WHERE ibu='".$rows["name"]."'");
						$hasilselectselectanakibu= mysqli_num_rows($selectanakibu);
							if($hasilselectselectanakibu > 0){
								$n2 = $hasilselectselectanakibu;
								
			echo'						<tr>
											<td>Nama Anak <text class="pull-right">:</text></td>
											<td>';					
						//for($i=0;$i<$n2;$i++){
							$i=0;	
								while($anakibu=mysqli_fetch_assoc($selectanakibu)){
									$dataanakibu = mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota='".$anakibu["id_anggota"]."'");
									while($anakibunya=mysqli_fetch_assoc($dataanakibu))
									{
			//echo'						
										//<li>	 '.$anakibunya['name'].'</li>';
										$snks[$i]['bd']=$anakibunya['birthdate'];
										$snks[$i]['nama']=$anakibunya['name'];
										
									}
									$i++;
								}
								sort($snks);
								for($z=0;$z<$n2;$z++){
									$no=$z+1;
									echo $no; echo "). "; echo $snks[$z]['nama']; echo "<br/>";
								}
			echo'							</td>;
										</tr>';						
							}
						
					}else {
						$n1=$hasilselectanakayah;

			echo'						<tr>
											<td>Nama Anak  <text class="pull-right">:</text></td>
												<td>';					
					//for($i=0;$i<$n1;$i++){<span><ol type="1">
						//$no=$i+1;
						$i=0; 
								while($anakayah=mysqli_fetch_assoc($selectanakayah)){
									$dataanakayah = mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota='".$anakayah["id_anggota"]."'");
									while($anakayahnya=mysqli_fetch_assoc($dataanakayah))
									{
			//echo'						
										//<li>	 '.$anakayahnya['name'].'</li>';
											$snks[$i]['bd']=$anakayahnya['birthdate'];
											$snks[$i]['nama']=$anakayahnya['name'];
										
									}
									$i++;
								}
								sort($snks);
								for($z=0;$z<$n1;$z++){
									$no=$z+1;
									echo $no; echo "). "; echo $snks[$z]['nama']; echo "<br/>";
								}
							//}	</ol></span>
								
								
			echo'							</td>;
										</tr>';						
								
							}
						
					}
						
					


			echo'			<tr>
								<td colspan="2"><br/></td>
							</tr>
							<tr>
								<td>Alamat <text class="pull-right">:</text></td>
								<td>'.$rows["address"].'</td>
							</tr>';
						if(floor($age) >= 17){
			echo '
							<tr>
								<td>Pekerjaan <text class="pull-right">:</text></td>
								<td>'.$rows["job"].'</td>
							</tr>';
			}				
			echo'			<tr>
								<td>No telp <text class="pull-right">:</text></td>
								<td>';
								$set2 = mysqli_query($koneksi, "SELECT * FROM phone_number WHERE id_anggota = $id");
								while($rowp= mysqli_fetch_assoc($set2)){

											echo $rowp["phone_number"];

								}
			echo  '					</td>
							</tr>';
							
						if(floor($age) >= 17){
			echo '
							<tr>
								<td>Email <text class="pull-right">:</text></td>
								<td>'.$rows["email"].'</td>
							</tr>';
			}				
			echo'
							</table>
						</div>
					  <div class="modal-footer">';
					  if($del=="ok"){
						  echo ' <button type="button" id="'.$rows["id_anggota"].'" class="btn btn-danger bongkar" >Hapus</button>';
					  }
			echo '		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					  

					  
					<script>
						$(".bongkar").on("click", function (){
							var id	= $(this).attr("id");
							console.log(id);
							$.ajax({
								method	:"POST",
								url		:"../kontrol/crud_admin/crud_anggota.php",
								data	:"do=habisi&id="+id,
								success	: function(data){
								$("#modal_del").modal("hide");
										location.reload();
								}
							})
						});
					</script>
						';
					}
			
		}else if($_POST["do"]=="habisi"){
			$id= $_POST["id"];
			$ambil_profil = mysqli_query($koneksi,"SELECT * FROM image_anggota WHERE id_anggota = '$id'");
			
			while($is_this = mysqli_fetch_assoc($ambil_profil)){
				$path = $is_this['link_img'];
				$true = "../../images/profil/".$is_this['true_img'];
				
				if($path != "../../images/profil/default_avatar.png"){
					unlink($path);
				}
				
					unlink($true);
			}
			$destroy= mysqli_query($koneksi,"DELETE FROM anggota WHERE id_anggota='$id'");
			$destroylagi= mysqli_query($koneksi,"DELETE FROM data_diri WHERE id_anggota='$id'");
		}
	}

?>