<?php
	include_once "../connt.php";
?>
<div class="row">
	<div class="col-lg-12" >
		<div class="container">
		<div class="jumbotron" style="text-align:center;background-color:#FFFFFF" >
			<h2 class="page-header">Daftar Anggota Keluarga</h2>
			<p></p>
		</div></div>
	</div>
</div>

<div class="row">
	<div class="">
<div class="content"><div class="container">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="row">
					<div class="col-md-6">
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

						<div id="modal_alert"></div>

					</div>
					</div>
					<div class="col-lg-6 pull-right" >
						<form name="cari" method="POST" class="navbar-form navbar-right" style="background-color:rgb(200,200,200);border-radius:10px">
							<div class="form-group">
								<input type="text" name="cari_anggota" placeholder="Cari Nama Lengkap" class="form-control">
								<button type="button" value="search" class="btn btn-default cariin" data-toggle="tooltip" title="Cari Data Post">Cari <span class="glyphicon glyphicon-search"></span></button>
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
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM anggota WHERE konfirmasi = 'ok' "); // jika tidak ada filter maka tampilkan semua entri

						if(mysqli_num_rows($sql) == 0){ 
							echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
						}
						else{ // jika terdapat entri maka tampilkan datanya
							$no = 1; // mewakili data dari nomor 1
							while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
								echo '
								<tr>
									<td width="10%">'.$no.'</td>
									<td width="35%"><a href="" class="view" id="'.$row['id_anggota'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['name'].'</a></td>
									<td width="35%">'.$row['email'].'</td>

								</tr>
								';
								$no++; // mewakili data kedua dan seterusnya
							}
						}
					?>
				</table>
			</div> <!--............................................................... /.table-responsive 1-->
				
			</div>

		</div></div> <!-- /.content -->
	</div>
</div><!-- /.row -->





<!-- Button trigger modal 2-->
<div class="modal fade bs-example-modal-lg" id="modal_lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title" id="exampleModalLabel">Anggota &raquo; Lihat</h3>
		  </div>
		<div class="cont" style="font-size:14px"></div>
		  
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
			data:"aksi=cariuser&nama="+nama,   
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
			data:"aksi=selectuser&select="+select,   
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
		