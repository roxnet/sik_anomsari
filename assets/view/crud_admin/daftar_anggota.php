<?php
include_once "../../connt.php";
		
		if($_POST["aksi"]=="select"){
			$select=$_POST["select"];	
					$sql = mysqli_query($koneksi, "SELECT * FROM anggota "); // jika tidak ada filter maka tampilkan semua entri
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
						
							//$sql = mysqli_query($koneksi, "SELECT * FROM anggota "); // jika tidak ada filter maka tampilkan semua entri

							if(mysqli_num_rows($sql) == 0){ 
								echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
							else{ // jika terdapat entri maka tampilkan datanya
								$no = 1; // mewakili data dari nomor 1
								while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
									echo '
									<tr>
										<td width="10%">'.$no.'</td>
										<td width="35%"><a href="" class="view2" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
										<td width="35%">'.$row['email'].'</td>
										<td width="20%">
											
											<a href="admin_layout.php?edit_anggota=yes&id='.$row['id_anggota'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
											<a href="" id="'.$row['id_anggota'].'" class="btn btn-danger btn-sm del2" data-toggle="modal" data-target="#modal_del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
										</td>
									</tr>
									';
									$no++; // mewakili data kedua dan seterusnya
								}
						echo '</table>
						
						<script>
						$(".view2").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&id="+id,
									success	: function(data){
											$(".cont").html(data);
									}
								})
							});
							
							$(".del2").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&del=ok&id="+id,
									success	: function(data){
											$(".vdel").html(data);
									}
								})
							});
						</script>
						';
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
								<td width="35%"><a href="" class="view3" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
								<td width="35%">'.$row['email'].'</td>
								<td width="20%">
									
									<a href="admin_layout.php?edit_anggota=yes&id='.$row['id_anggota'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="" id="'.$row['id_anggota'].'" class="btn btn-danger btn-sm del3" data-toggle="modal" data-target="#modal_del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
							}
						}if ($no == 1){ 
								echo '<tr><td colspan="4"><center>Tidak Ada Data.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
				echo '</table>
				<script>
						$(".view3").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&id="+id,
									success	: function(data){
											$(".cont").html(data);
									}
								})
							});
							
							$(".del3").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&del=ok&id="+id,
									success	: function(data){
											$(".vdel").html(data);
									}
								})
							});
						</script>
				';
				}	
		}
			else if($_POST["aksi"]=="selectuser"){
			$select=$_POST["select"];	
					$sql = mysqli_query($koneksi, "SELECT * FROM anggota "); // jika tidak ada filter maka tampilkan semua entri
				if($select=="all"){
					  echo' 
						<table class="table table-striped table-hoverid_anggota" >
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Email</th>

							</tr>';
						
							//$sql = mysqli_query($koneksi, "SELECT * FROM anggota "); // jika tidak ada filter maka tampilkan semua entri

							if(mysqli_num_rows($sql) == 0){ 
								echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
							else{ // jika terdapat entri maka tampilkan datanya
								$no = 1; // mewakili data dari nomor 1
								while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
									echo '
									<tr>
										<td width="10%">'.$no.'</td>
										<td width="35%"><a href="" class="view2" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
										<td width="35%">'.$row['email'].'</td>

									</tr>
									';
									$no++; // mewakili data kedua dan seterusnya
								}
						echo '</table>
						
						<script>
						$(".view2").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&id="+id,
									success	: function(data){
											$(".cont").html(data);
									}
								})
							});
							
							$(".del2").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&del=ok&id="+id,
									success	: function(data){
											$(".vdel").html(data);
									}
								})
							});
						</script>
						';
							}
						
				}else {
				
				echo '
				<table class="table table-striped table-hoverid_anggota" >
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>

					</tr>			
				
				';
					
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
						if($row["id_keluarga"]==$select){
							echo '
							<tr>
								<td width="10%">'.$no.'</td>
								<td width="35%"><a href="" class="view3" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
								<td width="35%">'.$row['email'].'</td>

							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
							}
						}
				echo '</table>
				<script>
						$(".view3").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&id="+id,
									success	: function(data){
											$(".cont").html(data);
									}
								})
							});
							
							$(".del3").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&del=ok&id="+id,
									success	: function(data){
											$(".vdel").html(data);
									}
								})
							});
						</script>
				';
				}	
		}else if($_POST["aksi"]=="cari"){		
				$nama=mysqli_real_escape_string($koneksi,$_POST["nama"]);	
					$sql = mysqli_query($koneksi, "SELECT * FROM anggota WHERE name='$nama'"); // jika tidak ada filter maka tampilkan semua entri
				if($nama!=null){
					  echo' 
						<table class="table table-striped table-hoverid_anggota" >
							<tr>
								<th>Nama</th>
								<th>Email</th>
								<th>Aksi</th>
								<th></th>
							</tr>';
						
							if(mysqli_num_rows($sql) == 0){ 
								echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
							else{ // jika terdapat entri maka tampilkan datanya
								while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
									echo '
									<tr>
										<td width="35%"><a href="" class="view4" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
										<td width="35%">'.$row['email'].'</td>
										<td width="20%">
											
											<a href="admin_layout.php?edit_anggota=yes&id='.$row['id_anggota'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
											<a href="" id="'.$row['id_anggota'].'" class="btn btn-danger btn-sm del4" data-toggle="modal" data-target="#modal_del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
										</td>
									</tr>
									';
								}
						echo '</table>
						
						<script>
						$(".view4").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&id="+id,
									success	: function(data){
											$(".cont").html(data);
									}
								})
							});
							
							$(".del4").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&del=ok&id="+id,
									success	: function(data){
											$(".vdel").html(data);
									}
								})
							});
						</script>
						';
							}
						
				}
		}
		else if($_POST["aksi"]=="cariuser"){		
				$nama=mysqli_real_escape_string($koneksi,$_POST["nama"]);	
					$sql = mysqli_query($koneksi, "SELECT * FROM anggota WHERE name='$nama'"); // jika tidak ada filter maka tampilkan semua entri
				if($nama!=null){
					  echo' 
						<table class="table table-striped table-hoverid_anggota" >
							<tr>
								<th>Nama</th>
								<th>Email</th>

							</tr>';
						
							if(mysqli_num_rows($sql) == 0){ 
								echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
							else{ // jika terdapat entri maka tampilkan datanya
								while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
									echo '
									<tr>
										<td width="35%"><a href="" class="view4" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
										<td width="35%">'.$row['email'].'</td>
						
									</tr>
									';
								}
						echo '</table>
						
						<script>
						$(".view4").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&id="+id,
									success	: function(data){
											$(".cont").html(data);
									}
								})
							});
							
							$(".del4").on("click", function (){
								var id	= $(this).attr("id");
								console.log(id);
								$.ajax({
									method	:"POST",
									url		:"../kontrol/crud_admin/crud_anggota.php",
									data	:"do=view&del=ok&id="+id,
									success	: function(data){
											$(".vdel").html(data);
									}
								})
							});
						</script>
						';
							}
						
				}
		}
?>					