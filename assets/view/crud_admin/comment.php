<?php
	include_once "../connt.php";
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Komentar</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
<div class="content">
		<br/>
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="table-responsive"><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-striped table-hoverid_anggota">
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Tanggal Post</th>
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
								<td><a href="profile.php?id='.$row['id_artikel'].'">'.$row['title'].'</a></td>
								<td>'.$row['date_post'].'</td>
	

								<td>
									
									<a href="edit.php?id='.$row['id_anggota'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="hapus.php?id='.$row['id_anggota'].'" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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