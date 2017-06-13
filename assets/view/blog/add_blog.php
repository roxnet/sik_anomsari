<?php
	include_once "../connt.php";
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Post &raquo; Buat Artikel</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
	<button class="btn btn-danger" type="button" onclick="back()"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
	<div id="confirm_content"></div>
	<form target="" method="post">
		<div class="form-group">
			<label for="judul">Judul Artikel :</label>
			<input type="text" class="form-control" name="judul" placeholder="Judul">
		</div>
		
				<div class="form-group">
					<label for="judul">Category :</label>
					<div class="form-inline">
						<div class="form-group">
							<select class="form-control" name="category" id="category">
							<?php
								$query=mysqli_query($koneksi,"select * from category");
								if(mysqli_num_rows($query)!=0){
									while($kategory=mysqli_fetch_array($query)){
										echo "<option value='$kategory[id_category]'>$kategory[category]</option>";
									}
								}
								else echo "<option value='-'>-</option>";
							?>
							</select>
						</div>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_category"><i class="fa fa-fw fa-plus"></i></button>
						<div id="modal_alert"></div>
					</div>
				</div>
		<div class="form-group">
			<label for="textarea">Isi Artikel :</label>
			<textarea id="content" class="form-control" name="isi" ></textarea>
		</div>
		<div class="form-group">
			<label for="judul">Dilihat Oleh :</label>
			<div class="form-inline">
				<div class="form-group">
					<select class="form-control" name="filter" id="filter">
						<option value="semua">SEMUA</option>
						<option value="anggota">ANGGOTA</option>
						<option value="nonanggota">BUKAN ANGGOTA</option>
					</select>
				</div>
			</div>
		</div>
		<hr/>
		<div class="form-group pull-right">
			<button type="button" id="submit_content" class="btn btn-md btn-primary active">Simpan</button>
			<button type="reset" class="btn btn-md btn-danger active">Reset</button>
		</div>
	</form>
	</div>
</div>


<!-- Button trigger modal -->
<div class="modal fade" id="modal_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
					<input type="text" class="form-control" name="tambah">
					<button id="add_category" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_category"><i class="fa fa-fw fa-plus"></i></button>
				  </div>

			  </div>
			  <hr/>
			  <?php
				$sql=mysqli_query($koneksi,"select * from category");
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


<script src="../js/tinymce/tinymce.min.js"></script>
<script src="../js/jquery.min.js"></script>
<!-- Just be careful that you give correct path to your tinymce.min.js file, above is the default example -->
<script type="text/javascript">
	function back(){
		window.history.back();
	};

     tinymce.init({
        selector: "textarea#content",theme: "modern",height : "250",
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       
       external_filemanager_path:"../js/filemanager/",
       filemanager_title:"Responsive Filemanager" ,
       external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
    });
	
$(document).ready(function(){
	$("#add_category").on('show.bs.modal', function (){
		var tambah_category	= $('input[name=tambah]').val();
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_category.php",
			data	:"crud=add&crud_category="+tambah_category,
			success	: function(data){
					$("#category").html(data);
					location.reload();
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Category Berhasil Ditambah</div>");
			}
		})
	});
	
	$("#submit_content").click(function(){
		var id_anggota	="1";
		var judul	= $('input[name=judul]').val();
		var category = $('select[name=category]').val();
		var content	= tinymce.get("content").getContent();
		var filter	= $('select[name=filter]').val();
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_content.php",
			data	:"crud=add&id_anggota="+id_anggota+"&judul="+judul+"&category="+category+"&content="+content+"&filter="+filter,
			success	: function(data){
					$("#confirm_content").html(data);
					$('html,body').animate({scrollTop:0},0);
			}
		})
	});
})

function rename(id){
		var rename_category	= $('input[name='+id+']').val();
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_category.php",
			data	:"crud=rename&crud_category="+rename_category+"&id="+id,
			success	: function(data){
					$("#category").html(data);
					 $('#modal_category').modal('toggle');
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Category Berhasil Dirubah</div>");
			}
		})
	};
	
function del(id){
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_category.php",
			data	:"crud=delete&id="+id,
			success	: function(data){
					$("#category").html(data);
					 $('#modal_category').modal('toggle');
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Category Berhasil dihapus</div>");
			}
		})
	};
	
</script>

