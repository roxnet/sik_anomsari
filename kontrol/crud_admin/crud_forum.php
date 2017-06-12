<?php
	include_once "../../connt.php";
	
	if(isset($_POST['crud'])){
		
		
		//Forum
		
		if($_POST['crud']=='add'){
			$forum = $_POST['forum'];
			$ket = $_POST['ket'];
			$creator = $_POST['creator']; 
			$fkategory = $_POST['fkategory'];
			$status = "aktif";
			$create = date("Y-m-d");
			
			$sql = mysqli_query($koneksi, "INSERT INTO forum(id_fkategori, forum, keterangan, id_creator, status, created_at) 
												VALUES('$fkategory', '$forum', '$ket', '$creator', '$status', '$create')");
			if($sql){
				echo"ok";
			}else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$create";
		}
		
		else if($_POST['crud']=='edit'){
			$idforum = $_POST['id'];
			$query=mysqli_query($koneksi,"SELECT * FROM forum WHERE id_forum='$idforum'");
			if(mysqli_num_rows($query)==1){
				while($forum=mysqli_fetch_array($query)){
	echo '	<form>
			<div class="modal-body">
				<div class="row ">
				  <div class="form col-md-12">
					<!--<input type="hidden" name="creator" value="">-->
					<input type="hidden" name="id" value="'.$forum['id_forum'].'">
					  <div class="form-group col-md-12">';
				$query2=mysqli_query($koneksi,"select * from fcategory"); 
	echo '				<select class="form-control" name="editfk" id="editfk">';
									while($kategory=mysqli_fetch_array($query2)){
										if($kategori['id_category']==$forum['id_fkategory']){
											echo '<option value="'.$kategory['id_category'].'">'.$kategory['category'].'</option>';
										}else echo '<option value="'.$kategory['id_category'].'">'.$kategory['category'].'</option>';

									}
	echo '
							</select>
					  </div>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-4 control-label">Nama Forum</label>
						<input type="text" class="form-control" name="eforum" value="'.$forum['forum'].'">
					  </div>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
						<textarea class="form-control" name="eket">'.$forum['keterangan'].'</textarea>
					  </div>
					  <div class="form-group col-md-12">
						<select class="form-control" name="status">';
							if($forum['status']=="aktif"){
								echo '<option value="aktif">aktif</option>
										<option value="nonaktif">nonaktif</option>';
							}else {
								echo '<option value="nonaktif">nonaktif</option>
										<option value="aktif">aktif</option>';
							}
	echo '				</select>
					  </div>
				  </div>
				</div>
				<div class="modal-footer">
					  <div class="">
						<button id="edit_forum" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_keluarga"><i class="glyphicon glyphicon-ok"></i> Ok</button>			  
						<button id="closed" type="button" class="btn btn-default" data-toggle="modal"  data-dismiss="modal">Batal</button>
					  </div>
				</div>
			</form>
			
			<script>
				$(document).ready(function(){
					$("#edit_forum").on("click", function (){
						var id	= $("input[name=id]").val();
						var fkategory	= $("select[name=editfk]").val();
						var forum	= $("input[name=eforum]").val();
						var ket	= $("textarea[name=eket]").val();
						var status= $("select[name=status]").val();
						console.log(id,fkategory,forum,ket,status);
						$.ajax({
							type	:"POST",
							url		:"../kontrol/crud_admin/crud_forum.php",
							data	:"crud=update&id="+id+"&fkategory="+fkategory+"&forum="+forum+"&ket="+ket+"&status="+status,
							success	: function(data){
								$("#modal_editforum").modal("hide");
									location.reload();
									//$("#keluarga").html(data);
									//if(data=="ok"){
									//	$("#modal_forum").modal("hide"); 
									//	location.reload();
									//}else $(".row").html(data);
									//$("#modal_alert").html("<div class="alert alert-success" role="alert">Keluarga Berhasil Ditambah</div>");
							}
						})
					});
				});
			</script>
			
			';
				}
			}
		}
		else if($_POST['crud']=='update'){
			$id = $_POST['id'];
			$forum = $_POST['forum'];
			$ket = $_POST['ket'];
			$fkategory = $_POST['fkategory'];
			$status = $_POST['status'];
			$edited = date("Y-m-d");
			
			$sql = mysqli_query($koneksi, "UPDATE forum SET id_fkategori='$fkategory', forum='$forum', keterangan='$ket', status='$status', edited_at='$edited' WHERE id_forum='$id'");
			if($sql){
				echo"ok";
			}else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$create";
		}	
	else if($_POST['crud']=='delforum'){
			$idf = $_POST['id'];
			$query=mysqli_query($koneksi,"SELECT * FROM forum WHERE id_forum='$idf'");
				if(mysqli_num_rows($query)!=0){
					while($forum=mysqli_fetch_array($query)){
					$query2=mysqli_query($koneksi,"SELECT category FROM fcategory WHERE id_category='".$forum['id_fkategori']."'");
					//$query3=mysqli_query($koneksi,"SELECT name FROM anggota WHERE id_anggota='".$forum['id_creator']."'");

						echo '<div class="modal-body">
						  <div class="table-responsive">
							<table class="table table-border">
							<tr>
								<td>Forum</td>
								<td>: '.$forum['forum'].'</td>
							<tr>
							<tr>
								<td>Kategori</td>
								<td>: ';while($kat=mysqli_fetch_array($query2)){
											echo $kat['category'];
										}
						echo'	</td>
							<tr>
							<tr>
								<td>Keterangan</td>
								<td>: '.$forum['keterangan'].'</td>
							<tr>
							<tr>
								<td>Creator</td>
								<td>: ';//while($kat=mysqli_fetch_array($query2)){
										//	echo $kat['category'];
										//}
						echo'	</td>
							<tr>
							<tr>
								<td>Created at</td>
								<td>: '.$forum['created_at'].'</td>
							<tr>
							<tr>
								<td>Edited at</td>
								<td>: ';
									if($forum['edited_at']!="0000-00-00") echo $forum['edited_at'];
						echo   '</td>
							<tr>
							<tr>
								<td>Status</td>
								<td>: '.$forum['status'].'</td>
							<tr>
						</table>
					  </div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger " onclick="destroyit('.$forum['id_forum'].')" >Hapus</button>
							<button id="closed" type="button" class="btn btn-default" data-toggle="modal"  data-dismiss="modal">Batal</button>
						</div>
						<script>
							function destroyit(id){
								console.log(id);
								$.ajax({
									type	:"POST",
									url		:"../kontrol/crud_admin/crud_forum.php",
									data	:"crud=destroy&id="+id,
									success	: function(data){
											if (data=="destroy sukses"){
												$("#modal_delf").modal("hide"); 
													location.reload();
											}
									}
								})
							}; 
						</script>
						';
					}
				}
		}
		else if($_POST['crud']=='destroy'){
			$id_f=$_POST['id'];
			$sql=mysqli_query($koneksi,"DELETE FROM forum WHERE id_forum=$id_f ");
			if($sql){
				echo "destroy sukses";
			}
		}
		
		
		//Tread
		
		if($_POST['crud']=='addTread'){
			$id_forum = $_POST['forum'];
			$topic = $_POST['topik'];
			$content = $_POST['content'];
			$creator = $_POST['creator']; 
			$create = date("Y-m-d");
			$image = "Emty";
			
			$sql = mysqli_query($koneksi, "INSERT INTO bahasan(id_forum, topic, content, image, id_creator, created_at) 
												VALUES('$id_forum', '$topic', '$content', '$image', '$creator', '$create')");
			if($sql){
				echo"ok";
			}else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$create";
		}
		
		
		
		//Fcategory
		
		
		if($_POST['crud']=='addfcat'){
			$fcategory=$_POST['tambah_fcategory'];
			$sql=mysqli_query($koneksi,"INSERT INTO fcategory (category) VALUES('".$fcategory."')");
			if($sql){
				$query=mysqli_query($koneksi,"select * from fcategory");
				if(mysqli_num_rows($query)!=0){
					while($fkategory=mysqli_fetch_array($query)){
						echo "<option>$fkategory[category]</option>";
					}
				}
			}
		}
		
		else if($_POST['crud']=='renamef'){
			$fcategory=$_POST['rename_fcategory'];
			$id_fcategory=$_POST['id'];
			$sql=mysqli_query($koneksi,"UPDATE fcategory SET category='".$fcategory."' where id_category=$id_fcategory ");
			if($sql){
				$query=mysqli_query($koneksi,"select * from fcategory");
				echo "<option>Semua Kategori</option>";
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[category]</option>";
					}
				}
			}
		}
		
		else if($_POST['crud']=='deletef'){
			$id_fcategory=$_POST['id'];
			$sql=mysqli_query($koneksi,"DELETE FROM fcategory where id_category=$id_fcategory ");
			if($sql){
				$query=mysqli_query($koneksi,"select * from fcategory");
				echo "<option>Semua Kategori</option>";
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[category]</option>";
					}
				}
			}
		}
		
		//Change kategori
		
		if($_POST["crud"]=="change"){
			$select=$_POST["select"];	
					$sql = mysqli_query($koneksi, "SELECT * FROM forum "); // jika tidak ada filter maka tampilkan semua entri
				if($select=="all"){
					  echo' 
						<table class="table table-striped table-hoverid_anggota" >
							<tr>
								<th>No</th>
								<th>Forum</th>
								<th>Created at</th>
								<th>Aksi</th>
							</tr>
						';
						

							if(mysqli_num_rows($sql) == 0){ 
								echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
						else{ // jika terdapat entri maka tampilkan datanya
							$no = 1; // mewakili data dari nomor 1
							while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
								//if($row['status']=="aktif"){
								echo '
								<tr>
									<td>'.$no.'</td>
									<td width="35%"><a href="admin_layout.php?Threads=yes&id='.$row['id_forum'].'" >'.$row['forum'].'</a></td>
									<td width="35%">'.$row['created_at'].'</td>
									<td width="20%">
										
										<a href="" data-toggle="modal" class="btn btn-primary btn-sm editf" data-target="#modal_editforum" onclick="edit2('.$row['id_forum'].')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										<a href="" class="btn btn-danger btn-sm btn-sm del" data-toggle="modal" data-target="#modal_delf" onclick="delf2('.$row['id_forum'].')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									</td>
								</tr>
								';$no++; // mewakili data kedua dan seterusnya
								//}
							}
						
						echo '</table>
						
						<script>
						function edit2(id){
								console.log(id);
								$.ajax({
									type	:"POST",
									url		:"../kontrol/crud_admin/crud_forum.php",
									data	:"crud=edit&id="+id,
									success	: function(data){
											$("#editf").html(data);

									}
								})
							}; 
							
						function delf2(id){
								console.log(id);
								$.ajax({
									type	:"POST",
									url		:"../kontrol/crud_admin/crud_forum.php",
									data	:"crud=delforum&id="+id,
									success	: function(data){
											$("#fdel").html(data);
											//$("#modal_category").modal("toggle");
											//$("#modal_alert").html("<div class="alert alert-success" role="alert">Category Berhasil Dirubah</div>");
											//$("#modal_fcategory").modal("hide");
																	//location.reload();

									}
								})
							};
						</script>
						';
							}
						
				}else {
				
				echo '
				<table class="table table-striped table-hoverid_anggota" >
							<tr>
								<th>No</th>
								<th>Forum</th>
								<th>Created at</th>
								<th>Aksi</th>
							</tr>			
				
				';
					
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
						
						if($row["id_fkategori"]==$select){
							echo '
							<tr>
									<td>'.$no.'</td>
									<td width="35%"><a href="admin_layout.php?Threads=yes&id='.$row['id_forum'].'" >'.$row['forum'].'</a></td>
									<td width="35%">'.$row['created_at'].'</td>
									<td width="20%">
										
										<a href="" data-toggle="modal" class="btn btn-primary btn-sm editf" data-target="#modal_editforum" onclick="edit3('.$row['id_forum'].')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										<a href="" class="btn btn-danger btn-sm btn-sm del" data-toggle="modal" data-target="#modal_delf" onclick="delf3('.$row['id_forum'].')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									</td>
								</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
							}else{ 
								echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
							}
						}
				echo '</table>
				<script>
						function edit3(id){
								console.log(id);
								$.ajax({
									type	:"POST",
									url		:"../kontrol/crud_admin/crud_forum.php",
									data	:"crud=edit&id="+id,
									success	: function(data){
											$("#editf").html(data);

									}
								})
							}; 
							
						function delf3(id){
								console.log(id);
								$.ajax({
									type	:"POST",
									url		:"../kontrol/crud_admin/crud_forum.php",
									data	:"crud=delforum&id="+id,
									success	: function(data){
											$("#fdel").html(data);
											//$("#modal_category").modal("toggle");
											//$("#modal_alert").html("<div class="alert alert-success" role="alert">Category Berhasil Dirubah</div>");
											//$("#modal_fcategory").modal("hide");
																	//location.reload();

									}
								})
							};
						</script>
				';
				}	
		}
		
	}
	

	
?>