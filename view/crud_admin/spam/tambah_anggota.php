<?php
	include_once "../connt.php";
	include_once ('../../kontrol/session_cekker.php');
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Anggota &raquo; Tambah</h1>
		<button class="btn btn-default" type="button" onclick="back()"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</button>
		<hr/>
	</div>
</div>
	<div class="row" style="margin-bottom:50px">

		<form id="add_form" class="form-horizontal">
		<?php $Query = mysqli_query($koneksi, "SELECT * FROM keluarga" );?>
				<div class="form-group col-xs-12">
					<label class="control-label col-xs-3">Keluarga</label>
					<div class="col-xs-8">
						<select class="form-control" name="id_keluarga" required>
							<option> Pilih Keluarga </option>
							<?php while($prt=mysqli_fetch_assoc($Query)){
								echo '<option value="'.$prt['id_keluarga'].'">'.$prt['nama_keluarga'].'</option>';
							}?>
						</select>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Nama panggilan</label>
					<div class="col-sm-8">
						<input type="text" name="nickname" class="form-control" placeholder="masukkan nama panggilan " required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Nama lengkap</label>
					<div class="col-sm-8">
						<input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap " required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-8">
						<select name="gender" class="form-control" form="add_form"required>
							<option value="" > --- </option>
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group col-xs-12">		
				<label class="col-sm-3 control-label">Golongan darah</label>
					<div class="col-sm-8">
						<select name="bloodtype" class="form-control" required>
							<option value="-" > --- </option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="O">O</option>
							<option value="AB">AB</option>
						</select>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-8">
						<input type="text" name="birthplace" class="form-control" placeholder="Kota tempat lahir" required>
					</div>
				</div>
				<div class="form-group date col-xs-12">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-8">
							<input type="text" name="birthdate" id="datepicker" class="form-control" date="" data-date-format="yyyy-mm-dd" placeholder=" Tahun-Bulan-Tanggal" required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-8">
						<textarea rows="3" name="adress" class="form-control" placeholder="Alamat Sekarang"></textarea>
					</div>
				</div>
				<div class="form-group col-xs-12"><hr/>
					<label class="col-sm-3 control-label">Pekerjaan</label>
					<div class="col-sm-8">
						<input type="text" name="job" class="form-control" placeholder="Pekerjaan" required>
					</div>
				</div>
				

				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Nomor telepon</label>
					<div class="col-sm-8">
						<input type="text" name="phonenumber" class="form-control" placeholder="Masukkan no Telepon " required>
					</div>
				</div>				
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-8">
						<input type="email" name="email" class="form-control" placeholder="Masukkan email " required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" name="pass1" class="form-control" placeholder="Buat password">
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Konfirmasi Password</label>
					<div class="col-sm-8">
						<input type="password" name="pass2" class="form-control" placeholder="Konfirmasi Password ">
					</div>
				</div>
				<div class="form-group col-xs-12">
				<label class="control-label col-xs-3">Level</label>
					<div class="col-xs-8">
      					<select class="form-control" name="level" required>
      									<option> Pilih Hak Akses </option>
      									<option value="1">Admin</option>
      									<option value="0">User</option>
      					</select>
					</div>
				</div>
				
	
			<label class="col-sm-3 control-label">&nbsp;</label>
			<button type="reset" class="btn btn-danger" >Clear</button>
			<button type="button" id="add" class="btn btn-primary" onclick="tambah()" >Simpan</button>

			<!--<input type="submit" id="add_anggota" class="btn btn-sm btn-primary" data-toggle="tooltip" name="aksi" value="tambah" title="Simpan Data anggota">-->
		</form>
</div>

<link href="../js/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="../js/jquery.min.js"></script>

<script type="text/javascript">
function back(){
		window.history.back();
	};
function tambah(){
		var email		= $('input[name=email]').val();
		var pass1		= $('input[name=pass1]').val();
		var pass2		= $('input[name=pass2]').val();
		var nickname	= $('input[name=nickname]').val();
		var name		= $('input[name=name]').val();
		var gender		= $('select[name=gender]').val();
		var bloodtype	= $('select[name=bloodtype]').val();
		var birthplace	= $('input[name=birthplace]').val();
		var birthdate	= $('input[name=birthdate]').val();
		var id_keluarga	= $('select[name=id_keluarga]').val();
		var job			= $('input[name=job]').val();
		var level		= $('select[name=level]').val();
		var phonenumber	= $('input[name=phonenumber]').val();
		var adress		= $('textarea[name=adress]').val();
		console.log(email,pass1,pass1,nickname,name,gender,bloodtype,birthplace,birthdate,id_keluarga,job,level,phonenumber,adress);
		
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_anggota.php",
			data  :"do=tambah&email="+email+"&pass1="+pass1+"&pass2="+pass2+"&nickname="+nickname+"&name="+name+"&gender="+gender+"&bloodtype="+bloodtype+"&birthplace="+birthplace+"&birthdate="+birthdate+"&id_keluarga="+id_keluarga+"&job="+job+"&level="+level+"&phonenumber="+phonenumber+"&adress="+adress,
			success	: function(){
				 window.location.href = "admin_layout.php?anggota=yes"; 
			}
		})
}
</script>





	<!-- JS -->
	<script src="../js/bootstrap-datepicker.js"></script>
	<script>
	$('#datepicker').datepicker({
		format: 'yyyy-mm-dd',
		clearBtn: true,
		autoclose: true
	})
	</script>