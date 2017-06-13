<?php
	include_once "../connt.php";
	$id = 6;//$_GET["id"]//;
	$set = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = $id");
?>
<div class="row" style="margin-bottom:50px">
<?php while($row= mysqli_fetch_assoc($set)){
	$set2 = mysqli_query($koneksi, "SELECT * FROM phone_number WHERE id_anggota = $id");
	echo '
		<form id="edit_form" class="form-horizontal">';
	echo '	<input type="hidden" name="id" value="'.$id.'">
				<div class="form-group col-xs-12">
					<label class="control-label col-xs-3">Keluarga</label>
					<div class="col-xs-8">
						<select class="form-control" name="id_keluarga" required>';
								$Query = mysqli_query($koneksi, "SELECT * FROM keluarga" );
									while($prt=mysqli_fetch_assoc($Query)){
										if($prt['id_keluarga'] == $row['id_keluarga']){
											echo '<option value="'.$prt['id_keluarga'].'">'.$prt['nama_keluarga'].'</option>';
										}
										else if($prt['id_keluarga'] != $row['id_keluarga']){
											echo '<option value="'.$prt['id_keluarga'].'">'.$prt['nama_keluarga'].'</option>';
										}
									}
	echo '				</select>
					</div>
				</div>

				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Nama panggilan</label>
					<div class="col-sm-8">
						<input type="text" name="nickname" class="form-control" value="'.$row["nickname"].'" placeholder="masukkan nama panggilan " required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Nama lengkap</label>
					<div class="col-sm-8">
						<input type="text" name="name" class="form-control" value="'.$row["name"].'" placeholder="Masukkan nama lengkap " required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-8">
						<select name="gender" class="form-control" form="add_form"required>';
						if($row["gender"]=="L"){
						echo '	<option value="L">Laki-Laki</option>
								<option value="P">Perempuan</option>';
						}else {
							echo '	<option value="P">Perempuan</option>
									<option value="L">Laki-laki</option>';
						}
	echo '				</select>
					</div>
				</div>
				<div class="form-group col-xs-12">
				<label class="col-sm-3 control-label">Golongan darah</label>
					<div class="col-sm-8">
						<select name="bloodtype" class="form-control" required>
							<option value="'.$row["bloodtype"].'" > '.$row["bloodtype"].' </option>';
	if($row["bloodtype"] !== "A") echo'	<option value="A">A</option>';
	if($row["bloodtype"] !== "B") echo'	<option value="B">B</option>';
	if($row["bloodtype"] !== "O") echo'	<option value="O">O</option>';
	if($row["bloodtype"] !== "AB") echo' <option value="AB">AB</option>';

	echo '				</select>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-8">
						<input type="text" name="birthplace" class="form-control" value="'.$row["birthplace"].'" placeholder="Kota tempat lahir" required>
					</div>
				</div>
				<div class="form-group date col-xs-12">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-8">
							<input type="text" name="birthdate" id="datepicker" class="form-control" value="'.$row["birthdate"].'" data-date-format="yyyy-mm-dd" placeholder=" Tahun-Bulan-Tanggal" required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-8">
						<textarea rows="3" name="adress" class="form-control" placeholder="Alamat Sekarang">'.$row["adress"].'</textarea>
					</div>
				</div>
				<div class="form-group col-xs-12"><hr/>
					<label class="col-sm-3 control-label">Pekerjaan</label>
					<div class="col-sm-8">
						<input type="text" name="job" class="form-control" placeholder="Pekerjaan" value="'.$row["job"].'" required>
					</div>
				</div>

				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Nomor telepon</label>
					<div class="col-sm-8">';
					$x=0;
					while($row2= mysqli_fetch_assoc($set2)){
	echo'					<input type="text" name="phonenumber" class="form-control" placeholder="Masukkan no Telepon "  value="'.$row2["phone_number"].'" required>';
							$x=1;
					}if($x==0){
	echo'					<input type="text" name="phonenumber" class="form-control" placeholder="Masukkan no Telepon "  required>';
					}
	echo'		</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-8">
						<input type="email" name="email" class="form-control" placeholder="Masukkan email " value="'.$row["email"].'" required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" name="pass1" class="form-control" placeholder="Buat password" value="'.$row["password"].'">
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Konfirmasi Password</label>
					<div class="col-sm-8">
						<input type="password" name="pass2" class="form-control" placeholder="Konfirmasi Password " value="'.$row["password"].'">
					</div>
				</div>
				<div class="form-group col-xs-12">
				<label class="control-label col-xs-3">Level</label>
					<div class="col-xs-8">
      					<select class="form-control" name="level" required>';
						if($row["level_user"]=="1"){
						echo '	<option value="1">Admin</option>
      							<option value="0">User</option>';
						}else {
							echo '	<option value="0">User</option>
									<option value="1">Admin</option>';
						}
    echo '				</select>
					</div>
				</div>


			<label class="col-sm-3 control-label">&nbsp;</label>
				<button type="reset" class="btn btn-danger" >Clear</button>
				<button type="button" id="edt" class="btn btn-primary" onclick="edit()">Simpan</button>

			<!--<input type="submit" id="edit_anggota" class="btn btn-sm btn-primary" data-toggle="tooltip" name="aksi" value="tambah" title="Simpan Data anggota">-->
		</form>';
	}
?>
</div>
