<?php
	include_once "../connt.php";
	include_once ('../kontrol/session_cekker.php');
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Post</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
<div class="content">
			
			<div class="nav navbar-nav navbar-right">
				<form name="cari" method="post" action="" role="search" class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" name="cari_post" placeholder="Cari Nama Lengkap" class="form-control">
						<button type="submit" name="submit" id="submit" value="search" class="btn btn-default" data-toggle="tooltip" title="Cari Data Post">Cari</button>
					</div>
				</form>	
			</div>
			<div class="nav navbar-nav pull-middle" id="status_delete"></div>
			<div class="nav navbar-nav navbar-left">
				<a href="admin_layout.php?add_blog=yes" data-toggle="tooltip" title="Tambah Data Post" class="btn btn-success" role="button">
				<span class="glyphicon glyphicon-user"></span> Tambah Data</a>
			</div>
			<br />
			
			<!-- Tab panes -->
			<div class="tab-content">
				<br/>
				<br/>
				<div class="table-responsive"><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-striped table-hoverid_anggota">
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Tanggal Post</th>
						<th>Filter</th>
						<th></th>
					</tr>
					<?php 
						
						$sql = mysqli_query($koneksi, "SELECT * FROM blog ORDER BY date_post ASC"); // jika tidak ada filter maka tampilkan semua entri

					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}
					else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
								<td>'.$no.'</td>
								<td><a href="layout_blog.php?post=yes&id='.$row['id_artikel'].'" 
								target="blank_">'.$row['tittle'].'</a></td>
								<td>'.$row['date_post'].'</td>
								<td>'.$row['filter'].'</td>
	

								<td>
									
									<a href="admin_layout.php?edit_blog=yes&id='.$row['id_artikel'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete" data-whatever="'.$row['id_artikel'].'"><i class="fa fa-fw fa-trash"></i></button>
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
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Hapus Artikel</h4>
		  </div>
		  <div class="modal-body">
			<p>Apakah Anda Yakin Ingin dihapus ?</p>
			<input type="hidden" class="form-control" id="recipient-name" name="id">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			<button id="submit_hapus" type="button" class="btn btn-primary">Hapus</button>
		  </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#modal_delete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-body input[name=id]').val(recipient)
		})

	$("#submit_hapus").click(function(){
		var id_artikel	= $('input[name=id]').val();
		console.log(id_artikel);
	$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_content.php",
			data	:"crud=delete&delete="+id_artikel,
			success	: function(data){
				location.reload();
					$("#status_delete").html("<div class='alert alert-info' role='alert'>Content Berhasil di Dihapus</div>");
			}
		})	
	})
	});
</script>