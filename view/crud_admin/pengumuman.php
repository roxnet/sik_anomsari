<?php
	include_once "../connt.php";
	$pengumuman = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY id_pengumuman DESC");
	
	$creator = mysqli_query($koneksi,"SELECT name FROM anggota WHERE id_anggota = '".$_SESSION['id_user']."'");
	$ct = mysqli_fetch_array($creator);
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Pengumuman </h1>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
<div class="content">
<a href="#" class="btn btn-success add_pngmmn"  data-toggle="modal" data-target="#modal_add">Buat pengumuman baru <i class="glyphicon glyphicon-pushpin"></i></a>
<hr/>
<div class="table-responsive" id="list_anggota"><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-striped table-hoverid_anggota" >
					<tr>
						<th>No.</th>
						<th>Judul</th>
						<th>Created at</th>
						<th>by</th>
						<th>Aksi</th>
						<th></th>
					</tr>
					<?php

						if(mysqli_num_rows($pengumuman) == 0){ 
							echo '<tr><td colspan="4"><center>Tidak Ada Data.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
						}
						else{ // jika terdapat entri maka tampilkan datanya
							$no = 1; // mewakili data dari nomor 1
							while($row = mysqli_fetch_assoc($pengumuman)){ // fetch query yang sesuai ke dalam array
							
							$creator1 = mysqli_query($koneksi,"SELECT name FROM anggota WHERE id_anggota = '".$row['id_creator']."'");
							$ct1 = mysqli_fetch_array($creator1);	
							
								echo '
								<tr>
									<td width="10%">'.$no.'</td>
									<td width="25%"><a href="" class="view" id="'.$row['id_pengumuman'].'" data-toggle="modal" data-target="#modal_lihat">'.$row['tittle'].'</a></td>
									<td width="15%">'.date("d F Y", strtotime($row['created_at'])).'</td>
									<td width="15%">'.$ct1['name'].'</td>
									<td width="15%">
										
										<a href="" class="btn btn-primary btn-sm edit" id="'.$row['id_pengumuman'].'" data-toggle="modal" data-target="#modal_edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										<a href="" id="'.$row['id_pengumuman'].'" class="btn btn-danger btn-sm del" data-toggle="modal" data-target="#modal_hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
	</div>
</div>



<!-- Button trigger modal 1-->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Buat Pengumuman !</h4>
		  </div>
			<div class="row">
			<div class="modal-body">
				<form>
				  <div class="form col-md-12">
					<form>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-4 control-label">Judul pengumuman </label>
						<input type="text" class="form-control" name="tittle" placeholder="Max 20 karakter" maxlength="20">
					  </div>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-4 control-label">Isi pengumuman</label>
						<textarea id="content" class="form-control" name="isi"></textarea>
					  </div>					  
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-5 control-label">by: <?php echo $ct['name'] ;?> <br/>(<?php echo date("d F Y")?>)</label>
					  		<input type="hidden" name="creator" value="<?php echo $_SESSION['id_user'] ;?>" >
					  </div>

				  </div>
			</div>
					  <div class="form-group col-md-12 " style="padding-right:25px">
					  <div class="pull-right">
						<button id="closed" type="button" class="btn btn-danger" data-toggle="modal"  data-dismiss="modal">Batal</button>
						<button id="send_pngmmn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_keluarga"><i class="glyphicon glyphicon-send"></i> _Ok</button>			  
					  </div>
					  </div>
					</form>
			  
			</form>
		  </div>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	<!-- Button trigger modal 2-->
<div class="modal fade" id="modal_lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Pengumuman !</h4>
		  </div>
			<div id="paper">
			
			</div>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->	
	<!-- Button trigger modal 3-->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Edit Pengumuman !</h4>
		  </div>
			<div id="formmplt"></div>
				<div class="modal-body">
						<div class="row" >
						  <div class="form col-md-12" id="cuy">
							  <div class="form-group col-md-12">
								<label for="inputEmail3" class="col-sm-4 control-label">Judul pengumuman </label>
								<input type="hidden" class="" name="id_p" id="id_p"/>
								<input type="text" class="form-control" name="tittle1" placeholder="Max 20 karakter" maxlength="20" id="judul">
							  </div>
							  <div class="form-group col-md-12">
								<label for="inputEmail3" class="col-sm-4 control-label">Isi pengumuman <a id="textppr"></a></label>
								<textarea id="content" class="form-control isi" name="isi" ></textarea>
							  </div>					  
							  <div class="form-group col-md-12">
								<label for="inputEmail3" class="col-sm-5 control-label">by:  <i class="bty"></i><br/></label>
							  </div>

						  </div>
						</div>
					</div>
					<div class="modal-footer">
						<button id="closed" type="button" class="btn btn-default" data-toggle="modal"  data-dismiss="modal">Batal</button>

						<button class="btn btn-primary" id="send_edit"> Simpan</button>
					</div>
			
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	<!-- Button trigger modal 2.45-->
<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Hapus Pengumuman !?</h4>
		  </div>
			<div id="paper2">
			
			</div>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->	
	<script src="../js/tinymce/tinymce.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script>
     tinymce.init({
        selector: "textarea#content",theme: "modern",height : "100",
        plugins: [
             " autolink link image lists charmap print preview hr anchor pagebreak"
       ],
	    menubar:false,
       toolbar: "bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent  ",
       
    });
</script>
<script>
$(document).ready(function(){
	$("#send_pngmmn").on('click', function (){
		var creator	= $('input[name=creator]').val();
		var tittle	= $('input[name=tittle]').val();
		var content	= tinymce.get("content").getContent();
		console.log(creator,tittle,content);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_pengumuman.php",
			data	:"crud=sendNew&creator="+creator+"&tittle="+tittle+"&content="+content,
			success	: function(data){
					//$("#keluarga").html(data);
					if(data=='ok'){
						//$('#modal_forum').modal('hide'); 
						location.reload();
					}location.reload();
					//$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Ditambah</div>");
			}
		})
	});
	
	$(".view").on('click', function (){
		var id	= $(this).attr("id");
		console.log(id);
		$.ajax({
			method	:"POST",
			url		:"../kontrol/crud_admin/crud_pengumuman.php",
			data	:"crud=view&id="+id,
			success	: function(data){
					$("#paper").html(data);
			}
		})
	});
	$(".edit").on('click', function (){
		var id	= $(this).attr("id");
		console.log(id);
		$.ajax({
			method	:"POST",
			url		:"../kontrol/crud_admin/crud_pengumuman.php",
			data	:"crud=edit&id="+id,
			dataType:"json",  
            success:function(data){
					 $('#id_p').val(data.id_p);
					 $('#judul').val(data.tittle);
					 $('.isi').text(data.content);
					 tinymce.get("content").setContent(data.content);
					 
			}
		})
	});
							$("#send_edit").on("click", function (){
								
								var id_p	= $("input[name=id_p]").val();
								var tittle	= $("input[name=tittle1]").val();
								var content	= tinymce.get("content").getContent();
								console.log(id_p,tittle,content);
								$.ajax({
									type	:"POST",
									url		:"../kontrol/crud_admin/crud_pengumuman.php",
									data	:"crud=sendedit&id_p="+id_p+"&tittle="+tittle+"&content="+content,
									success	: function(data){
											//$("#keluarga").html(data);
											if(data=="ok"){
												location.reload();
											}location.reload();
									}
								});	
							});
			$(".del").on('click', function (){
		var id	= $(this).attr("id");
		console.log(id);
		$.ajax({
			method	:"POST",
			url		:"../kontrol/crud_admin/crud_pengumuman.php",
			data	:"crud=delll&id="+id,
			success	: function(data){
					$("#paper2").html(data);
			}
		})
	});
	
});
</script>