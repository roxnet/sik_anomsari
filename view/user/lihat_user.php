
<?php
  include_once "../connt.php";
  include ('../kontrol/session_cekker.php');
   $sql_user=mysqli_query($koneksi,"SELECT a.*,b.* FROM anggota a 
      INNER JOIN phone_number b ON a.id_anggota=b.id_anggota
      WHERE a.nickname='$nameUser'");
    if(mysqli_num_rows($sql_user)==1);
      $onlyuser=mysqli_fetch_assoc($sql_user);
?>
<div class="form-group">
  <table class="table table-striped">
  <tr>
    <td colspan="3">
      <img src="../images/profil/<?php echo $onlyuser['profil'];?>" width="200">
    </td>
  </tr>
  <tr>
    <td>Nama panggilan</td>
    <td> : </td>
    <td><?php echo $onlyuser['nickname'];?></td>
  <tr>
  <tr>
    <td>Nama lengkap</td>
    <td> : </td>
    <td><?php echo $onlyuser['name'];?></td>
  <tr>
  <tr>
    <td>Jenis kelamin</td>
    <td> : </td>
    <td><?php if ($onlyuser['gender']=='L') echo "LAKI-LAKI";
    else echo "PEREMPUAN"; ?></td>
  <tr>
  <tr>
    <td>Golongan darah</td>
    <td> : </td>
    <td><?php echo $onlyuser['bloodtype'];?></td>
  <tr>
  <tr>
    <td>Tempat/Tanggal lahir</td>
    <td> : </td>
    <td><?php echo $onlyuser['birthplace'];?> / <?php echo date("d F Y", strtotime($onlyuser["birthdate"]));?></td>
  <tr>
  
  <tr>
	<td colspan="3">
		<hr/>
	</td>
  </tr>
    
	<tr>
		<td >
			Keluarga 
		</td>
		<td >
			:
		</td>
		<td >
			<?php $keluarga = mysqli_query ($koneksi,"SELECT nama_keluarga AS keluarga FROM keluarga WHERE id_keluarga = '".$onlyuser['id_keluarga']."'");
						$it_keluarga = mysqli_fetch_array($keluarga);
						echo $it_keluarga['keluarga'];
			?>
		</td>
  </tr>	
  <tr>
		<td >
			Nama Ayah 
		</td>
		<td >
			:
		</td>
		<td >
			<?php $set3 = mysqli_query($koneksi, "SELECT * FROM data_diri WHERE id_anggota = '".$onlyuser['id_anggota']."'");
						while($dir = mysqli_fetch_assoc($set3)){
							$ayah = $dir['ayah'];
							$ibu = $dir['ibu'];
							$pasangan = $dir['pasangan'];
							$life = $dir['life'];
						}
				echo $ayah;
			?>
		</td>
  </tr>	
  <tr>
		<td >
			Nama ibu 
		</td>
		<td >
			:
		</td>
		<td >
			<?php 
				echo $ibu;
			?>
		</td>
  </tr>	
  <?php if ($pasangan != NULL){
	  
			echo'
				<tr>
					<td >
						Nama Suami/Istri 
					</td>
					<td >
						:
					</td>
					<td >
						'.$pasangan.'
					</td>
			  </tr>	';
			  
			  
	
					$selectanakayah = mysqli_query($koneksi,"SELECT * FROM data_diri WHERE ayah='".$onlyuser["name"]."'");
					$hasilselectanakayah= mysqli_num_rows($selectanakayah);
					if($hasilselectanakayah == 0){
						$selectanakibu = mysqli_query($koneksi,"SELECT * FROM data_diri WHERE ibu='".$onlyuser["name"]."'");
						$hasilselectselectanakibu= mysqli_num_rows($selectanakibu);
							if($hasilselectselectanakibu > 0){
								$n2 = $hasilselectselectanakibu;
								
			echo'						<tr>
											<td>Nama Anak </td>
											<td>: </td>
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
											<td>Nama Anak </td>
											<td></td>
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
	
	
	if($pasangan == null){
						
					}
	?>
  <tr>
	<td colspan="3">
		<hr/>
	</td>
  </tr>
  
  <tr>
    <td>Alamat</td>
    <td> : </td>
    <td><?php echo $onlyuser['address'];?></td>
  <tr>
  <tr>
    <td>Pekerjaan</td>
    <td> : </td>
    <td><?php echo $onlyuser['job'];?></td>
  <tr>
  <tr>
    <td>No telp</td>
    <td> : </td>
    <td><?php echo $onlyuser['phone_number'];?>
  <tr>
  <tr>
    <td>Email</td>
    <td> : </td>
    <td><?php echo $onlyuser['email'];?></td>
  <tr>
  </table>
</div>
