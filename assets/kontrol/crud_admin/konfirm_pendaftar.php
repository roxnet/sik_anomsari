<?php
include_once "../../connt.php";

	if(isset($_POST['do'])){
		if($_POST['do']=="ok"){
				$id		     = $_POST['id'];
				
				$level   		 = "2";
				
				$id_keluarga	 = $_POST['id_keluarga'];
				$nickname		 = $_POST['nickname'];
				$name		     = $_POST['name'];
				$gender			 = $_POST['gender'];
				$profil			 = $_POST['profil'];
				$bloodtype		 = $_POST['bloodtype'];
				$birthplace		 = $_POST['birthplace'];
				$birthdate 		 = $_POST['birthdate'];
				
					$Ynow = date('Y');
					$Ybirth=date("Y", strtotime($birthdate));
					$Mnow = date('m');
					$Mbirth=date("m", strtotime($birthdate));
					$Yfg = $Ynow - $Ybirth;					
					$mfg = $Mnow - $Mbirth;
					$min = $mfg / 12;
					$age = $Yfg + $min;
				
				$adress			 = $_POST['adress'];
				$status		     = "offline";

				$ayah		     = $_POST['ayah'];
				$ibu		     = $_POST['ibu'];
				$pasangan		 = $_POST['pasangan'];
				$life		     = "life";
				
			if(floor($age) >= 17){
				$email		     = $_POST['email'];
				$pass1	         = $_POST['pass1'];
				$phonenumber	 = $_POST['phonenumber'];
				$job		     = $_POST['job'];				
			}else {				
				$email		     = null;
				$pass1	         = null;
				$phonenumber	 = null;
				$job		     = null;
			}

				
														
						$password = md5($pass1); 																	
						$insert = mysqli_query($koneksi, "INSERT INTO anggota(email, password, nickname, name, profil, gender, bloodtype, birthplace, birthdate, address, id_keluarga, job, level_user, status) 
															VALUES('$email','$password', '$nickname', '$name', '$profil','$gender', '$bloodtype', '$birthplace', '$birthdate', '$adress', '$id_keluarga', '$job', '$level', '$status')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						
						$userid = mysqli_insert_id($koneksi);
						
					
						if($insert)	{
								$bersihkan= mysqli_query($koneksi,"DELETE FROM pendaftar WHERE id_anggota='$id'");
								$bersihkan2=mysqli_query($koneksi,"DELETE FROM phone_number WHERE id_anggota='$id'");
								$bersihkan3=mysqli_query($koneksi,"DELETE FROM data_diri WHERE id_anggota='$id'");
								
								
								
								$phonenumberentry=mysqli_query($koneksi,"INSERT INTO phone_number(id_anggota,phone_number) VALUES('$userid','$phonenumber')");
								$aaadatadiri=mysqli_query($koneksi,"INSERT INTO data_diri(id_anggota,ayah,ibu,pasangan,life) VALUES('$userid','$ayah','$ibu','$pasangan','$life')");

						$dateadd = date('y-m-d');
								$inpttimageanggotanya=mysqli_query($koneksi,"INSERT INTO image_anggota(id_anggota,link_img,add_at) VALUES('$userid','$profil','$dateadd')");
								
								echo "true";
						}
						
		}else if($_POST['do']=="view"){
			$id = $_POST["id"];
			$del=isset($_POST["del"]);
			$viewa = mysqli_query($koneksi, "SELECT * FROM pendaftar WHERE id_anggota = $id");
					while($rows= mysqli_fetch_assoc($viewa)){
						
					$Ynow = date('Y');
					$Ybirth=date("Y", strtotime($rows['birthdate']));
					$Mnow = date('m');
					$Mbirth=date("m", strtotime($rows['birthdate']));
					$Yfg = $Ynow - $Ybirth;					
					$mfg = $Mnow - $Mbirth;
					$min = $mfg / 12;
					$age = $Yfg + $min;
						
			echo'<form id="form_ok">
						<div class="modal-body">
							<table class="table table-hover">

							<tr>
								<td colspan="2" align="">';
							echo '<img src="../images/profil/'.$rows["profil"].'" width="250" height="250">
									<input name="profil" type="hidden" value="'.$rows["profil"].'">';
									
			echo'				</td>
							</tr>
							<tr>
								<td>Nama panggilan</td>
								<td>: '.$rows["nickname"].'<input name="nickname" type="hidden" value="'.$rows["nickname"].'"></td>
							<tr>
							<tr>
								<td>Nama lengkap</td>
								<td>: '.$rows["name"].'<input name="name" type="hidden" value="'.$rows["name"].'"></td>
							<tr>
							<tr>
								<td>Jenis kelamin</td>
								<td>:';
								if ($rows["gender"]=="L"){
									echo ' Laki-laki';
								}else echo ' Perempuan';
								
			echo				'<input name="gender" type="hidden" value="'.$rows["gender"].'"></td>
							<tr>
							<tr>
								<td>Golongan darah</td>
								<td>: '.$rows["bloodtype"].'<input name="bloodtype" type="hidden" value="'.$rows["bloodtype"].'"></td>
							<tr>
							<tr>
								<td>Tempat/Tanggal lahir</td>
								<td>: '.$rows["birthplace"].' <input name="birthplace" type="hidden" value="'.$rows["birthplace"].'">/<input name="birthdate" type="hidden" value="'.$rows["birthdate"].'"> '.date("d F Y", strtotime($rows["birthdate"])).' ('.floor($age).' tahun)</td>
							<tr>
							<tr>
								<td colspan="2"><br/></td>
							<tr>
							<tr>
								<td>Keluarga</td>
								<td>: '; 
							$viewkel = mysqli_query($koneksi, "SELECT * FROM keluarga WHERE id_keluarga = '".$rows["id_keluarga"]."'");
											while($rowmy= mysqli_fetch_assoc($viewkel)){
												echo $rowmy['nama_keluarga'];
											}
								
			echo'						<input name="id_keluarga" type="hidden" value="'.$rows["id_keluarga"].'">
										<input name="idnya" type="hidden" value="'.$rows["id_anggota"].'">
										<input name="pass1" type="hidden" value="'.$rows["password"].'"></td>
							<tr>							
								';
							
					$viewdatdir = mysqli_query($koneksi, "SELECT * FROM data_diri WHERE id_anggota = '".$rows["id_anggota"]."'");
						while($rowdr= mysqli_fetch_assoc($viewdatdir)){
			echo'			<tr>
								<td>Nama Ayah</td>
								<td>: '.$rowdr["ayah"].'<input name="ayah" type="hidden" value="'.$rowdr["ayah"].'"></td>
							<tr>
							<tr>
								<td>Nama Ibu<br/></td>
								<td>: '.$rowdr["ibu"].'<input name="ibu" type="hidden" value="'.$rowdr["ibu"].'"></td>
							<tr>';
							if($rowdr["pasangan"] != null){	
			echo'				<tr>
									<td>Nama Suami/Istri<br/></td>
									<td>: '.$rowdr["pasangan"].'</td>
								<tr>	
						';
							}
			echo'			<input name="pasangan" type="hidden" value="'.$rowdr["pasangan"].'">';
						}
			echo	'				
							<tr>
								<td colspan="2"><br/></td>
							<tr>
							<tr>
								<td>Alamat</td>
								<td>: '.$rows["adress"].'<input name="adress" type="hidden" value="'.$rows["adress"].'"></td>
							<tr>';
			
				if(floor($age) >= 17){
			echo'				<tr>
								<td>Pekerjaan</td>
								<td>: '.$rows["job"].'<input name="job" type="hidden" value="'.$rows["job"].'"></td>
							<tr>
							<tr>
								<td>No telp</td>
								<td>: '.$rows["phonenumber"].'<input name="phonenumber" type="hidden" value="'.$rows["phonenumber"].'"></td>
							<tr>
							<tr>
								<td>Email</td>
								<td>: '.$rows["email"].'<input name="email" type="hidden" value="'.$rows["email"].'"></td>
							<tr>';
					}	
			echo'				</table>
						</form>
						</div>
					  <div class="modal-footer">
						  <button type="button" id="'.$rows["id_anggota"].'" class="btn btn-primary ok" >Ok</button>
						  <button type="button" id="'.$rows["id_anggota"].'" class="btn btn-danger bongkar" >Hapus</button>
					  
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					  
					<script>
						
						$(".bongkar").on("click", function (){
							var id	= $(this).attr("id");
							console.log(id);
							$.ajax({
								method	:"POST",
								url		:"../kontrol/crud_admin/konfirm_pendaftar.php",
								data	:"do=habisi&id="+id,
								success	: function(data){
										$("#form_ok")[0].reset();
										$("#modal_konfirm").modal("hide");
										location.reload();
								}
							})
						});
						
						
						$(".ok").on("click", function(){
									var id		= $("input[name=idnya]").val();
									var email		= $("input[name=email]").val();
									var pass1		= $("input[name=pass1]").val();
									var nickname	= $("input[name=nickname]").val();
									var name		= $("input[name=name]").val();
									var gender		= $("input[name=gender]").val();
									var bloodtype	= $("input[name=bloodtype]").val();
									var birthplace	= $("input[name=birthplace]").val();
									var birthdate	= $("input[name=birthdate]").val();
									var id_keluarga	= $("input[name=id_keluarga]").val();
									var job			= $("input[name=job]").val();
									var adress		= $("input[name=adress]").val();
									var profil		= $("input[name=profil]").val();
									var phonenumber		= $("input[name=phonenumber]").val();
									
									var ayah			= $("input[name=ayah]").val();
									var ibu				= $("input[name=ibu]").val();
									var pasangan		= $("input[name=pasangan]").val();
									
									
									console.log(profil,ayah,ibu,pasangan,id,email,pass1,nickname,name,gender,bloodtype,birthplace,birthdate,id_keluarga,job,adress,phonenumber);
									
									$.ajax({
										type	:"POST",
										url		:"../kontrol/crud_admin/konfirm_pendaftar.php",
										data  :"do=ok&id="+id+"&email="+email+"&pass1="+pass1+"&nickname="+nickname+"&name="+name+"&profil="+profil+"&gender="+gender+"&bloodtype="+bloodtype+"&birthplace="+birthplace+"&birthdate="+birthdate+"&id_keluarga="+id_keluarga+"&phonenumber="+phonenumber+"&job="+job+"&adress="+adress+"&ayah="+ayah+"&ibu="+ibu+"&pasangan="+pasangan,
										success	: function(data){
											 //window.location.href = "http://localhost/sik_new/view/main.html"; 
											 if(data=="true"){
													 $("#modal_anggota").modal("hide"); 
													 location.reload();
												}
												else{
													$("#form_ok")[0].reset();
													$("#modal_konfirm").html(data);
													location.reload();
												}
										}
									})
							});
						
						
					</script>
						';
					}
			
		}else if($_POST["do"]=="habisi"){
			$id= $_POST["id"];
			$pindai=mysqli_query($koneksi,"SELECT * FROM pendaftar WHERE id_anggota='$id'");
			  while($pin=mysqli_fetch_assoc($pindai)){
				  if($pin['profil'] != "../../images/profil/default_avatar.png"){
					if(file_exists($pin['profil'])){
											unlink($pin['profil']);
											unlink($pin['profil']);

					}						  
				  }
							  
			  }


			$destroy= mysqli_query($koneksi,"DELETE FROM pendaftar WHERE id_anggota='$id'");
			$destroy= mysqli_query($koneksi,"DELETE FROM data_diri WHERE id_anggota='$id'");
		}
		
	}else if(isset($_POST["select"])){
		
			$select=$_POST["select"];	
					$sql = mysqli_query($koneksi, "SELECT * FROM pendaftar "); // jika tidak ada filter maka tampilkan semua entri
				if($select=="all"){
					  echo' 
						<table class="table table-striped table-hoverid_anggota" >
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Aksi</th>
								<th></th>
							</tr>';
						
							//$sql = mysqli_query($koneksi, "SELECT * FROM pendaftar "); // jika tidak ada filter maka tampilkan semua entri

							if(mysqli_num_rows($sql) == 0){ 
								echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
							else{ // jika terdapat entri maka tampilkan datanya
								$no = 1; // mewakili data dari nomor 1
								while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
									echo '
									<tr>
										<td width="10%">'.$no.'</td>
										<td width="35%">'.$row['name'].'</td>
										<td width="35%">'.$row['email'].'</td>
										<td width="20%">
											
										<a href="" id="'.$row['id_anggota'].'" class="btn btn-primary btn-sm confirm" data-toggle="modal" data-target="#modal_konfirm"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Konfrmasi</a>
										</td>
									</tr>
									';
									$no++; // mewakili data kedua dan seterusnya
								}
						echo '</table>';
							}
						
				}else {
				
				echo '
				<table class="table table-striped table-hoverid_anggota" >
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Aksi</th>
						<th></th>
					</tr>			
				
				';
					
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
						if($row["id_keluarga"]==$select){
							echo '
							<tr>
								<td width="10%">'.$no.'</td>
								<td width="35%">'.$row['name'].'</td>
								<td width="35%">'.$row['email'].'</td>
								<td width="20%">
									
										<a href="" id="'.$row['id_anggota'].'" class="btn btn-primary btn-sm confirm" data-toggle="modal" data-target="#modal_konfirm"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Konfrmasi</a>
								</td>
							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
							}
						}
				echo '</table>
				
				<script>
					$(".confirm").on("click", function (){
						var id	= $(this).attr("id");
						console.log(id);
						$.ajax({
							method	:"POST",
							url		:"../kontrol/crud_admin/konfirm_pendaftar.php",
							data	:"do=view&del=ok&id="+id,
							success	: function(data){
									$(".vdel").html(data);
							}
						})
					});
				</script>';
				}	
	}
?>