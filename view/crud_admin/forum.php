<?php
	include_once "../connt.php";
	include_once ('../kontrol/session_cekker.php');
?><!--
<div class="row">
	<div class="col-lg-12">
		<div class="jumbotron" style="text-align:center">
			<h1 class="page-header">Forum</h1>
			<p>Bebas ngobrol tapi jaga kesopanan</p>
		</div>
	</div>
</div>-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Forum</h1>
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
							<select class="form-control" name="fkategory" id="fkategory">
								<option value="all">Semua Kategori</option>
							  <?php
								$query=mysqli_query($koneksi,"select * from fcategory");
								if(mysqli_num_rows($query)!=0){
									while($kategory=mysqli_fetch_array($query)){
										echo "<option value='$kategory[id_category]'>$kategory[category]</option>";
									}
								}
								else echo "<option>-</option>";
							?>
							</select>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_fcategory"><i class="glyphicon glyphicon-cog"></i></button>

						</div>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_forum"><i class="fa fa-fw fa-plus"></i> Buat Forum Baru</button>

						<div id="modal_alert"></div>

					</div>
					</div>
					
				</div><br/>
				<div class="table-responsive" id="list_forum"><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-striped table-hoverid_anggota" >
					<tr>
						<th>No</th>
						<th>Forum</th>
						<th>by</th>
						<th>Created at</th>
						<th>Aksi</th>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM forum "); // jika tidak ada filter maka tampilkan semua entri

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
									<td width="25%"></td>
									<td width="20%">'.$row['created_at'].'</td>
									<td width="20%">
										
										<a href="" data-toggle="modal" class="btn btn-primary btn-sm editf" data-target="#modal_editforum" onclick="edit('.$row['id_forum'].')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										<a href="" class="btn btn-danger btn-sm btn-sm del" data-toggle="modal" data-target="#modal_delf" onclick="delf('.$row['id_forum'].')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									</td>
								</tr>
								';$no++; // mewakili data kedua dan seterusnya
								//}
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
<div class="modal fade" id="modal_forum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Buat Forum</h4>
		  </div>
			
			<div class="modal-body">
			<div class="row">
				<form>
				  <div class="form col-md-12">
						<input type="hidden" name="creator">
					  <div class="form-group col-md-12">
						<?php $query=mysqli_query($koneksi,"select * from fcategory"); ?>
						<select class="form-control" name="addfk" id="addfk">
								<option >Semua Kategori</option>
									<?php
									while($kategory=mysqli_fetch_array($query)){
										echo '<option value="'.$kategory['id_category'].'">'.$kategory['category'].'</option>';
									}
									?>
							</select>
					  </div>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-4 control-label">Nama Forum</label>
						<input type="text" class="form-control" name="forum">
					  </div>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
						<textarea class="form-control" name="ket"></textarea>
					  </div>
				  </div>
				  
				</div>
			</div>
			<div class="modal-footer">
					  <div class="">
						<button id="add_forum" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_keluarga"><i class="fa fa-fw fa-plus"></i> Ok</button>			  
						<button id="closed" type="button" class="btn btn-default" data-toggle="modal"  data-dismiss="modal">Batal</button>
					  </div>
			</div>
			</form>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Button trigger modal -->
<div class="modal fade" id="modal_editforum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Forum &raquo; Edit</h4>
		  </div>
		  <div id="editf"></div>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Button trigger modal 3 -->
<div class="modal fade bs-example-modal-lg" id="modal_delf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Forum &raquo; Hapus ?</h4>
		  </div>
			
		  <div id="fdel"></div>
			
		</div> 
	</div> 
</div> 

<!-- Button trigger modal -->
<div class="modal fade" id="modal_fcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Tambah Kategory</h4>
		  </div>
		  <div class="modal-body">
			<form>
			  <div class="form-inline">
				  <div class="form-group">
					<input type="text" class="form-control" name="tambahfcat">
					<button id="add_fcategory" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_category"><i class="fa fa-fw fa-plus"></i></button>
				  </div>

			  </div>
			  <hr/>
			  <?php
				$sql=mysqli_query($koneksi,"select * from fcategory");
								if(mysqli_num_rows($sql)!=0){
									while($cat=mysqli_fetch_array($sql)){
										echo '
											<div class="form-inline">
												  <div class="form-group">
													<input type="text" class="form-control" name="'.$cat["id_category"].'" value="'.$cat["category"].'">
													<button type="button" class="btn btn-info" onclick="rename('.$cat['id_category'].')">
													<i class="fa fa-fw fa-pencil"></i></button>
													<button type="button" class="btn btn-danger" onclick="del('.$cat['id_category'].')"><i class="fa fa-fw fa-remove"></i></button>
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

<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#fkategory').change(function(){
		var x = document.getElementById("fkategory"); 
		var select = x.options[x.selectedIndex].value;
		console.log(select);
           $.ajax({  
			url:"../kontrol/crud_admin/crud_forum.php",
			method:"POST",
			data:"crud=change&select="+select,   
			success:function(data){
			$("#list_forum").html(data);
				}
					    
           }); 	
	});
	
	
	
	$("#add_forum").on('click', function (){
		var creator	= $('input[name=creator]').val();
		var fkategory	= $('select[name=addfk]').val();
		var forum	= $('input[name=forum]').val();
		var ket	= $('textarea[name=ket]').val();
		console.log(creator,fkategory,forum,ket);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_forum.php",
			data	:"crud=add&creator="+creator+"&fkategory="+fkategory+"&forum="+forum+"&ket="+ket,
			success	: function(data){
					//$("#keluarga").html(data);
					if(data=='ok'){
						$('#modal_forum').modal('hide'); 
						location.reload();
					}else $(".row").html(data);
					//$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Ditambah</div>");
			}
		})
	});
	
	$("#add_fcategory").on('click', function (){
		var tambah_fcategory	= $('input[name=tambahfcat]').val();
		console.log(tambah_fcategory);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_forum.php",
			data	:"crud=addfcat&tambah_fcategory="+tambah_fcategory,
			success	: function(data){
					$("#fkategory").html(data);
					location.reload();
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Category Berhasil Ditambah</div>");
					$("#modal_fcategory")
			}
		})
	});
	


});

	function edit(id){
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
		
	function delf(id){
			console.log(id);
			$.ajax({
				type	:"POST",
				url		:"../kontrol/crud_admin/crud_forum.php",
				data	:"crud=delforum&id="+id,
				success	: function(data){
						$("#fdel").html(data);
						//$('#modal_category').modal('toggle');
						//$("#modal_alert").html("<div class='alert alert-success' role='alert'>Category Berhasil Dirubah</div>");
						//$("#modal_fcategory").modal('hide');
												//location.reload();

				}
			})
		};
		
	function rename(id){
			var rename_fcategory	= $('input[name='+id+']').val();
			console.log(id,rename_fcategory);
			$.ajax({
				type	:"POST",
				url		:"../kontrol/crud_admin/crud_forum.php",
				data	:"crud=renamef&rename_fcategory="+rename_fcategory+"&id="+id,
				success	: function(data){
						$("#fkategory").html(data);
						//$('#modal_category').modal('toggle');
						$("#modal_alert").html("<div class='alert alert-success' role='alert'>Category Berhasil Dirubah</div>");
						$("#modal_fcategory").modal('hide');
												//location.reload();

				}
			})
		};
		
	function del(id){
			console.log(id);
			$.ajax({
				type	:"POST",
				url		:"../kontrol/crud_admin/crud_forum.php",
				data	:"crud=deletef&id="+id,
				success	: function(data){
						$("#fkategory").html(data);
						//$('#modal_category').modal('toggle');
						$("#modal_alert").html("<div class='alert alert-success' role='alert'>Category Berhasil dihapus</div>");
						$("#modal_fcategory").modal('hide');
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
		