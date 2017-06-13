<?php
include_once "../../connt.php";

	if(isset($_POST['do'])){
		if($_POST['do']=="ok"){
			$konfirm = "ok";
				$id		     = $_POST['id'];
				
				$update = mysqli_query($koneksi, "UPDATE anggota SET konfirmasi = '$konfirm'
															WHERE id_anggota ='$id'") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
				
				$sel_pro = mysqli_query($koneksi, "SELECT profil FROM anggota WHERE id_anggota = '$id' ");
				$profil = mysqli_fetch_array($sel_pro);
				$query = mysqli_query($koneksi,"INSERT INTO image_anggota(id_anggota, link_img, true_img, add_at) VALUES ('$id','".$profil['profil']."','','$date')");
		
				echo "true";	
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
							<input type="hidden" name="id_confrm" value="'.$rows["id_anggota"].'">
							
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
							</tr>
							
								</table>
						
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
										//$("#form_ok")[0].reset();
										$("#modal_anggota").modal("hide");
										location.reload();
								}
							})
						});
						
						
						$(".ok").on("click", function(){
									var id		= $("input[name=id_confrm]").val();
									
									console.log(id);
									
									$.ajax({
										type	:"POST",
										url		:"../kontrol/crud_admin/konfirm_pendaftar.php",
										data  :"do=ok&id="+id,
										success	: function(data){
											 //window.location.href = "http://localhost/sik_new/view/main.html"; 
											 //if(data=="true"){
													 $("#modal_anggota").modal("hide"); 
													 location.reload();
												//}
												///else{
												//	$("#form_ok")[0].reset();
												//	$("#modal_konfirm").html(data);
												//	location.reload();
												//}
										}
									})
							});
						
						
					</script>
						';
					}
			}
	}else if($_POST["do"]=="habisi"){
			$id= $_POST["id"];
			//$pindai=mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota='$id'");
			
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
			$destroy= mysqli_query($koneksi,"DELETE FROM data_diri WHERE id_anggota='$id'");
		}
		
	}else if(isset($_POST["select"])){
		
			$select=$_POST["select"];	
					$sql = mysqli_query($koneksi, "SELECT * FROM anggota WHERE konfirmasi = 'notyet'"); // jika tidak ada filter maka tampilkan semua entri
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