<?php
	include_once "../connt.php";
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Anggota</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
<div class="content">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-inline">
						<div class="form-group">
							<select class="form-control" name="keluarga" id="keluarga">
								<option value="all">Semua Keluarga</option>
							  <?php
								$query=mysqli_query($koneksi,"select * from keluarga");
								if(mysqli_num_rows($query)!=0){
									while($kategory=mysqli_fetch_array($query)){
										echo "<option value='$kategory[id_keluarga]'>$kategory[nama_keluarga]</option>";
									}
								}
								else echo "<option>-</option>";
							?>
							</select>
						</div>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_keluarga"><i class="fa fa-fw fa-plus"></i></button>
						<a href="admin_layout.php?tambah_anggota=yes" class="btn btn-success tambah_anggota" >Tambah Anggota <i class="glyphicon glyphicon-user"></i></a>

						<div id="modal_alert"></div>

					</div>
					</div>
					<div class="col-lg-6 pull-right">
						<form name="cari" method="POST" class="navbar-form navbar-right">
							<div class="form-group">
								<input type="text" name="cari_anggota" placeholder="Cari Nama Lengkap" class="form-control">
								<button type="button" value="search" class="btn btn-default cariin" data-toggle="tooltip" title="Cari Data Post">Cari</button>
							</div>
						</form>	
					</div>
				</div>
				<div class="table-responsive" id="list_anggota"><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-striped table-hoverid_anggota" >
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Aksi</th>
						<th></th>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM anggota WHERE konfirmasi = 'ok' "); // jika tidak ada filter maka tampilkan semua entri

						if(mysqli_num_rows($sql) == 0){ 
							echo '<tr><td colspan="4"><center>Tidak Ada Data.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
						}
						else{ // jika terdapat entri maka tampilkan datanya
							$no = 1; // mewakili data dari nomor 1
							while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
								echo '
								<tr>
									<td width="10%">'.$no.'</td>
									<td width="35%"><a href="" class="view" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
									<td width="35%">'.$row['email'].'</td>
									<td width="20%">
										
										<a href="admin_layout.php?edit_anggota=yes&id='.$row['id_anggota'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										<a href="" id="'.$row['id_anggota'].'" class="btn btn-danger btn-sm del" data-toggle="modal" data-target="#modal_del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									</td>
								</tr>
								';
								$no++; // mewakili data kedua dan seterusnya
							}
						}
					?>
				</table>
			</div> <!--............................................................... /.table-responsive 1-->
				
			</div>

		</div> <!-- /.content -->
	</div>
</div><!-- /.row -->



<!-- Button trigger modal -->
<div class="modal fade" id="modal_keluarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Tambah Keluarga</h4>
		  </div>
		  <div class="modal-body">
			<form>
			  <div class="form-inline">
				  <div class="form-group">
					<input type="text" class="form-control" name="tambah">
					<button id="add_keluarga" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_keluarga"><i class="fa fa-fw fa-plus"></i></button>
				  </div>

			  </div>
			  <hr/>
			  <?php
				$sql=mysqli_query($koneksi,"select * from keluarga");
								if(mysqli_num_rows($sql)!=0){
									while($cat=mysqli_fetch_array($sql)){
										echo '
											<div class="form-inline">
												  <div class="form-group">
													<input type="text" class="form-control" name="'.$cat["id_keluarga"].'" value="'.$cat["nama_keluarga"].'">
													<button type="button" class="btn btn-info" onclick="rename('.$cat['id_keluarga'].')">
													<i class="fa fa-fw fa-pencil"></i></button>
													<button type="button" class="btn btn-danger" onclick="del('.$cat['id_keluarga'].')"><i class="fa fa-fw fa-remove"></i></button>
												  </div>
											</div>
											<br/>
										';
									}
								}
			  ?>
			</form>
		  </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Button trigger modal 2-->
<div class="modal fade bs-example-modal-lg" id="modal_lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title" id="exampleModalLabel">Anggota &raquo; Lihat</h3>
		  </div>
		<div class="cont"></div>
		  
		</div> 
	</div> 
</div> 

<!-- Button trigger modal 3-->
<div class="modal fade bs-example-modal-lg" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Anggota &raquo; hapus ?</h4>
		  </div>
		  
		<div class="vdel"></div>
		
		</div> 
	</div> 
</div> 


<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('.cariin').on('click',function(){
		var nama = $('input[name=cari_anggota]').val(); 
		console.log(nama);
           $.ajax({  
			url:"crud_admin/daftar_anggota.php",
			type	:"POST",
			data:"aksi=cari&nama="+nama,   
			success:function(data){
					$("#list_anggota").html(data);
				}
					    
           }); 	
	});
	
	
	
	$('#keluarga').change(function(){
		var x = document.getElementById("keluarga"); 
		var select = x.options[x.selectedIndex].value;
		console.log(select);
           $.ajax({  
			url:"crud_admin/daftar_anggota.php",
			method:"POST",
			data:"aksi=select&select="+select,   
			success:function(data){
			$("#list_anggota").html(data);
				}
					    
           }); 	
	});
	
	
	
	$("#add_keluarga").on('show.bs.modal', function (){
		var tambah_keluarga	= $('input[name=tambah]').val();
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_keluarga.php",
			data	:"crud=add&crud_keluarga="+tambah_keluarga,
			success	: function(data){
					$("#keluarga").html(data);
					location.reload();
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Ditambah</div>");
			}
		})
	});
	
	$(".view").on('click', function (){
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
	
	$(".del").on('click', function (){
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
	
});
	
	function rename(id){
		var rename_keluarga	= $('input[name='+id+']').val();
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_keluarga.php",
			data	:"crud=rename&crud_keluarga="+rename_keluarga+"&id="+id,
			success	: function(data){
					$("#keluarga").html(data);
					 $('#modal_keluarga').modal('toggle');
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Dirubah</div>");
			}
		})
	};
	
function del(id){
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_keluarga.php",
			data	:"crud=delete&id="+id,
			success	: function(data){
					$("#keluarga").html(data);
					location.reload();
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil dihapus</div>");
			}
		})
	};
	
	$(document).ready(function(){
		$('#add_form').on("submit", function(event){  
		event.preventDefault();  
	   
	  
	   $.ajax({  
			url:"../kontrol/crud_admin/crud_keluarga.php",  
			method:"POST",  
			data:$('#add_form').serialize(), 
			success:function(data){  
			 //$('#add_form')[0].reset();  
			 $('#modal_anggota').modal('hide'); 
			 //  window.location.href = "";
			}  
		   });  
		 
		 });
	});
	

</script>
		