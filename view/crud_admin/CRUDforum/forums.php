<?php
	include_once "../connt.php";
	include_once ('../../kontrol/session_cekker.php');
	$id_f =$_GET['id'];
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
		<h1 class="page-header">Threads Forum  &raquo; <?php 
		
	$forum = mysqli_query($koneksi,"SELECT * FROM forum WHERE id_forum=$id_f");
	
	while($forums = mysqli_fetch_array($forum)){echo $forums['forum'] ;}?></h1>
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
							<!--<select class="form-control" name="keluarga" id="keluarga">
								<option value="all">Semua Keluarga</option>
							  <?php
								$query=mysqli_query($koneksi,"select * from bahasan");
								if(mysqli_num_rows($query)!=0){
									while($kategory=mysqli_fetch_array($query)){
										echo "<option value='$kategory[id_keluarga]'>$kategory[nama_keluarga]</option>";
									}
								}
								else echo "<option>-</option>";
							?>
							</select>-->
						</div>
						<button class="btn btn-default" type="button" onclick="back()"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</button>
						<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_forum"><i class="glyphicon glyphicon-comment"></i> &nbsp;Ugah Topik Baru</button>-->

						<div id="modal_alert"></div>

					</div>
					</div>
					
				</div><br/>
				<div class="table-responsive" id="list_anggota"><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-striped table-hoverid_anggota" >
					<tr>
						<th>No</th>
						<th>Topik</th>
						<th>Content</th>
						<th>Comments</th>
						<th>by</th>
						<th>Aksi</th>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM bahasan "); // jika tidak ada filter maka tampilkan semua entri

						if(mysqli_num_rows($sql) == 0){ 
							echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
						}
						else{ // jika terdapat entri maka tampilkan datanya
							$no = 1; $x=0;// mewakili data dari nomor 1
							while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
								if($row['id_forum']==$id_f){
								echo '
									<tr>
										<td>'.$no.'</td>
										<td width="">'.$row['topic'].'</a></td>
										<td width="">'.$row['content'].'</td>
										<td width=""></td>
										<td width="">'.$row['id_creator'].'</td>
										<td width="">
											<a href="" id="'.$row['id_forum'].'" class="btn btn-info btn-sm del" data-toggle="modal" data-target="#modal_del"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>
											<a href="" id="'.$row['id_forum'].'" class="btn btn-danger btn-sm del" data-toggle="modal" data-target="#modal_del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
										</td>
									</tr>
								';$x=1;
								}
								$no++; // mewakili data kedua dan seterusnya
							}if($x!=1) echo '<td colspan="7" align="center"> Tidak ada Topik bahasan untuk forum ini</td>' ;
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
			<h4 class="modal-title" id="exampleModalLabel">Ugah Topik Baru</h4>
		  </div>
			<div class="row">
			<div class="modal-body">
				<form>
				  <div class="form col-md-12">
					<form>
						<input type="hidden" name="creator">
						<input type="hidden" name="forum" value="<?php echo $id_f ;?>">
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-4 control-label">Topik</label>
						<input type="text" class="form-control" name="topik">
					  </div>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-2 control-label">content</label>
						<textarea class="form-control" name="content"></textarea>
					  </div>
				  </div>
			</div>
					  <div class="form-group col-md-12 col-md-offset-7">
						<button id="add_forum" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_keluarga"><i class="fa fa-fw fa-plus"></i> Ok</button>			  
						<button id="closed" type="button" class="btn btn-danger" data-toggle="modal"  data-dismiss="modal">Batal</button>
					  </div>
					</form>
			  
			</form>
		  </div>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Button trigger modal 2
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
</div> -->

<!-- Button trigger modal 3
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
</div> -->


<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	/*$('#keluarga').change(function(){
		var x = document.getElementById("keluarga"); 
		var select = x.options[x.selectedIndex].value;
		console.log(select);
           $.ajax({  
			url:"crud_admin/daftar_anggota.php",
			method:"POST",
			data:"select="+select,   
			success:function(data){
			$("#list_anggota").html(data);
				}
					    
           }); 	
	});*/
	
	
	
	$("#add_forum").on('click', function (){
		var creator	= $('input[name=creator]').val();
		var forum	= $('input[name=forum]').val();
		var topik	= $('input[name=topik]').val();
		var content	= $('textarea[name=content]').val();
		console.log(creator,forum,topik,content);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_forum.php",
			data	:"crud=addTread&creator="+creator+"&forum="+forum+"&topik="+topik+"&content="+content,
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
	function back(){
		window.history.back();
	};
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
		