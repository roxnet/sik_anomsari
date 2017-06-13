<?php
	include_once "../connt.php";
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Pendaftar</h1>
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
						<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_keluarga"><i class="fa fa-fw fa-plus"></i></button>-->		
						<div id="modal_alert"></div>

						</div>
					</div>
				</div><br/>
				<div class="table-responsive" id="list_pendaftar"><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-striped table-hoverid_anggota" >
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Aksi</th>
						<th></th>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM anggota WHERE konfirmasi = 'notyet' ORDER BY id_anggota DESC"); // jika tidak ada filter maka tampilkan semua entri

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
						}
					?>
				</table>
			</div> <!--............................................................... /.table-responsive 1-->
				
			</div>

		</div> <!-- /.content -->
	</div>
</div><!-- /.row -->


 

<!-- Button trigger modal 3-->
<div class="modal fade bs-example-modal-lg" id="modal_konfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Konfirmasi &raquo; pendaftar</h4>
		  </div>
		  
		<div class="vdel"></div>
		
		</div> 
	</div> 
</div> 


<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#keluarga').change(function(){
		var x = document.getElementById("keluarga"); 
		var select = x.options[x.selectedIndex].value;
		console.log(select);
           $.ajax({  
			url:"../kontrol/crud_admin/konfirm_pendaftar.php",
			method:"POST",
			data:"select="+select,   
			success:function(data){
			$("#list_pendaftar").html(data);
				}
					    
           }); 	
	});
	
	$(".confirm").on('click', function (){
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
	

	
});
	


</script>
		