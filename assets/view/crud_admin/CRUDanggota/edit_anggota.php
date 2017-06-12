<?php
	include_once "../connt.php";
	$id = $_GET["id"];
	$setprofile = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = $id");
	while($ppppp= mysqli_fetch_assoc($setprofile)){
		$profil=$ppppp['profil'];
		
	}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group col-md-9">
			<h1 class="page-header">Anggota &raquo; Edit</h1>
	
			<a href="admin_layout.php?anggota=yes" class="btn btn-default" type="button" ><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</a>
		

	</div>
								<div class="form-group col-md-2" style="">
											<div  align="center" style="padding:3px">
												<img src="../images/profil/<?php echo $profil;?>" width="100%" style="border:solid gray 2px">
												<div style="margin-top:2px">
													<a href="image_cONTRol_uNit/profil_edit.php?tpfedusrprfl=<?php echo $id;?>" class="btn btn-primary" style="width:95%;">Ganti foto</a>
												</div>
											</div>
								</div>
</div>
	<div class="row" style="margin-bottom:50px">
<?php 
	$set = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = $id");
	while($row= mysqli_fetch_assoc($set)){
	$set2 = mysqli_query($koneksi, "SELECT * FROM phone_number WHERE id_anggota = $id");
	$set3 = mysqli_query($koneksi, "SELECT * FROM data_diri WHERE id_anggota = $id");
	while($dir = mysqli_fetch_assoc($set3)){
		$ayah = $dir['ayah'];
		$ibu = $dir['ibu'];
		$pasangan = $dir['pasangan'];
		$life = $dir['life'];
	}
	echo '
		<form id="edit_form" class="form-horizontal">';
	echo '	<input type="hidden" name="id" value="'.$id.'">	
							
				
		
				<div class="form-group col-xs-12"><hr/>
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
				<div class="form-group col-xs-12"><hr/>
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
										<label class="col-sm-3 control-label">Nama ayah</label>
											<div class="col-sm-8">
												<input type="text" name="ayah" class="form-control" placeholder="nama lengkap ayah  " value="'.$ayah.'" required>
											</div>
								</div>
											
								<div class="form-group col-xs-12">
										<label class="col-sm-3 control-label">Nama ibu</label>
											<div class="col-sm-8">
												<input type="text" name="ibu" class="form-control" placeholder="nama lengkap ibu " value="'.$ibu.'" required>
											</div>
								</div>
				
							
								<div class="form-group col-xs-12" id="pasangan" >
									<label class="col-sm-3 control-label">Nama Suami/Istri</label>
										<div class="col-sm-8">
											<input type="text" name="pasangan" class="form-control" value="'.$pasangan.'" placeholder="Belum menikah" >
										</div>
								</div>
				
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-8">
						<textarea rows="3" name="adress" class="form-control" placeholder="Alamat Sekarang">'.$row["address"].'</textarea>
					</div>
				</div>
				
								<div class="form-group col-xs-12"><hr/>
								  <label class="col-sm-3 control-label">Life status</label>
									<div class="col-sm-8">
										<select id="deathlife" name="deathlife"class="form-control" form="add_form"required>
				';							if($life=="life"){
												echo '<option value="life">Life</option>
													<option value="death">Passed away</option>';
											}
												else echo'<option value="death">Passed away</option>
														<option value="life">Life</option>';
												
	echo'								</select>
									</div>
									
								</div>
								<div class="form-group col-xs-12"><hr/></div>
		<div id="accn">	
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Pekerjaan</label>
					<div class="col-sm-8">
						<input type="text" name="job" class="form-control" placeholder="Pekerjaan" value="'.$row["job"].'" >
					</div>
				</div>
				
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Nomor telepon</label>
					<div class="col-sm-8">';
					$x=0;
					while($row2= mysqli_fetch_assoc($set2)){
	echo'					<input type="text" name="phonenumber" class="form-control" placeholder="Masukkan no Telepon "  value="'.$row2["phone_number"].'" >';
							$x=1;
					}if($x==0){
	echo'					<input type="text" name="phonenumber" class="form-control" placeholder="Masukkan no Telepon "  >';
					}	
	echo'		</div>
				</div>				
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-8">
						<input type="email" name="email" class="form-control" placeholder="Masukkan email " value="'.$row["email"].'" >
					</div>
				</div>
		<div style="display:none">
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
		</div>	
				<div class="form-group col-xs-12"><hr/>
				<label class="control-label col-xs-3">Level anggota</label>
					<div class="col-xs-8">
      					<select class="form-control" name="level" required>';
						if($row["level_user"]=="admin"){
						echo '	<option value="1">Admin</option>
      							<option value="2">User</option>';
						}else {
							echo '	<option value="2">User</option>
									<option value="1">Admin</option>';
						}
    echo '				</select>
					</div>
				</div>
		</div>		<div class="form-group col-xs-12"><hr/></div>
				
	
			<label class="col-sm-3 control-label">&nbsp;</label>
				<!--button type="reset" class="btn btn-danger" >Clear</button-->
				<button type="button" id="edt" class="btn btn-primary" onclick="edit()">Simpan</button>

			<!--<input type="submit" id="edit_anggota" class="btn btn-sm btn-primary" data-toggle="tooltip" name="aksi" value="tambah" title="Simpan Data anggota">-->
		</form>';
	}
?>

					  
					  <!--MODAL EDIT PROFIL PICTURE-->
					  	<div class="modal fade" id="editProfilPic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="exampleModalLabel">Foto profil</h4>
							  </div>
							  <div class="modal-body" align="center">
								<div class="row" >
								
								
								</div>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Send message</button>
							  </div>
							</div>
						  </div>
						</div>
</div>



	
<link href="../js/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="../js/jquery.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	$('#nikah').change(function(){
			var x = document.getElementById("nikah"); 
			var select = x.options[x.selectedIndex].value;
			if(select=="kawin"){
				
				$("#pasangan").css("display","block")
			}	
		}); 
	$('#deathlife').change(function(){
			var x = document.getElementById("deathlife"); 
			var select = x.options[x.selectedIndex].value;
			if(select=="death"){
				
				$("#accn").css("display","none")
			}else if(select=="life"){	
				$("#accn").css("display","block")
			}		
		});
		
		
	});	

function back(){
		window.history.back();
	};
function edit(){
		var id			= $('input[name=id]').val();
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
		
		var ayah	= $("input[name=ayah]").val();
		var ibu		= $("input[name=ibu]").val();
		var namapasangan= $("input[name=pasangan]").val();
		var deathlife = $("select[name=deathlife]").val();
		console.log(id,email,pass1,pass1,nickname,name,gender,bloodtype,birthplace,birthdate,id_keluarga,job,level,phonenumber,adress,ayah,ibu,namapasangan,deathlife);
		
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_anggota.php",
			data  :"do=edit&id="+id+"&email="+email+"&pass1="+pass1+"&pass2="+pass2+"&nickname="+nickname+"&name="+name+"&gender="+gender+"&bloodtype="+bloodtype+"&birthplace="+birthplace+"&birthdate="+birthdate+"&id_keluarga="+id_keluarga+"&job="+job+"&level="+level+"&phonenumber="+phonenumber+"&adress="+adress+"&ayah="+ayah+"&ibu="+ibu+"&namapasangan="+namapasangan+"&deathlife="+deathlife,
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