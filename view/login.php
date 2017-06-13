<?php 
	include "../connt.php";	
	$_SESSION['gold']=null;
		session_start();
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>

        <!-- CSS
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"> -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/form-elements.css">
        <link rel="stylesheet" href="../css/style.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
           
                <div class="container">
                    <!--<div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Bootstrap</strong> Login Form</h1>
                            
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login sebagai anggota</h3>
                            		<p>Masukkan username dan password Anda untuk login <br/>(Enter your username and password to log on)</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
							<div id="konfirmasi_login"></div>
			                    <form name="login" action="" method="post">
			                    	<div class="form-group">
										
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="email" placeholder="Email..." class="form-username form-control log" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control log" id="form-password">
			                        </div>
			                        <button id="login" type="button" class="btn">LOGIN!</button>
			                    </form>
		                    </div>
							<div class="form-top">
							<p style="color:white">Bagi yang belum memiliki Akun dapat&nbsp;
												<a href="" id="daftar" class="draft" data-toggle="modal" data-target="#myModal"> klik disini untuk mendaftar</a></p>
							</div>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>...or login with:</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>
                        	</div>
                        </div>
                    </div>-->
                </div>
            
        </div>

		
		<!-- Modal     Form 1-->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:-30px">
			  <div style="width:100%">
			  <div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content" style="border-radius:0px;">
				  <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><div class="alert alert-success">Form pendaftaran </div></h4>
				  </div>
				   <div class="modal-body" > <h3>Data diri </h3>
								<div class="row" style="margin-bottom:50px">

									<form id="add_form" class="form-horizontal">
									
											<div class="form-group col-xs-12">
												<label class="control-label col-xs-3">Keluarga</label>
												<div class="col-xs-8">
													<select class="form-control" name="id_keluarga" required>
														<option> Pilih Keluarga </option>
														 <?php 
														 $Que = mysqli_query($koneksi, "SELECT * FROM keluarga" );
														 while($prt=mysqli_fetch_assoc($Que)){
															echo '<option value="'.$prt['id_keluarga'].'">'.$prt['nama_keluarga'].'</option>';
														}?>
												</select>
												</div>
											</div>
											
											<div class="form-group col-xs-12">
												<label class="col-sm-3 control-label">Nama ayah</label>
												<div class="col-sm-8">
													<input type="text" name="ayah" class="form-control" placeholder="masukkan nama panggilan " required>
												</div>
											</div>
											
											<div class="form-group col-xs-12">
												<label class="col-sm-3 control-label">Nama ibu</label>
												<div class="col-sm-8">
													<input type="text" name="ibu" class="form-control" placeholder="masukkan nama panggilan " required>
												</div>
											</div>
											
											<div class="form-group col-xs-12"><hr/>
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
													<select name="gender" class="form-control" form="add_form"required id="gender">
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
														<input type="text" name="birthdate" id="datepicker" class="form-control dtdt" data-date-format="yyyy-mm-dd" placeholder=" Tahun-Bulan-Tanggal" required>
												</div>
											</div>
											
											
											
											<div class="form-group col-xs-12">
												<label class="col-sm-3 control-label">Status pernikahan</label>
												<div class="col-sm-8">
													<select id="nikah" class="form-control" form="add_form"required>
														<option value="lajang">Belum menikah</option>
														<option value="kawin">Menikah</option>
													</select>
												</div>
											</div>
											<div class="form-group col-xs-12" id="pasangan" style="display:none">
												<label class="col-sm-3 control-label">Nama Suami/Istri</label>
												<div class="col-sm-8">
													<input type="text" name="pasangan" class="form-control" placeholder="Masukkan nama lengkap " >
												</div>
											</div>
											<div class="form-group col-xs-12">
												<label class="col-sm-3 control-label">Alamat</label>
												<div class="col-sm-8">
													<textarea rows="3" name="adress" class="form-control" placeholder="Alamat Sekarang"></textarea>
												</div>
											</div>
											
								
										<!--<label class="col-sm-3 control-label">&nbsp;</label>
										<button type="reset" class="btn btn-danger" >Clear</button>
										<button type="button" id="add" class="btn btn-success" onclick="tambah()" >Simpan</button>
										-->
									
							</div>

				  </div>
				  <div class="modal-footer" >
					<div style="margin-bottom:20px">
					<div id="konfirmasi_daftar"></div>
					
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="button" class="btn btn-primary next" >Next</button>
						</form>		
					</div>
				  </div>
				</div>
			  </div>
			  </div>
			</div>
			
			<!--Modal   Form 2   Kontak-->
			<div class="modal fade" id="myModalkontak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:-30px">
			  <div style="width:100%">
			  <div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content" style="border-radius:0px;">
				  <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><div class="alert alert-success">Form pendaftaran 2 </div></h4>
				  </div>					<h3>Kontak </h3>

					<div class="modal-body" style="min-height:400px">
							<div class="row">
												
											<div class="form-group col-xs-12">
												<label class="col-sm-3 control-label">Pekerjaan</label>
												<div class="col-sm-8">
													<input type="text" name="job" class="form-control" placeholder="Pekerjaan" >
												</div>
											</div>
											

											<div class="form-group col-xs-12">
												<label class="col-sm-3 control-label">Nomor telepon</label>
												<div class="col-sm-8">
													<input type="text" name="phonenumber" class="form-control" placeholder="Masukkan no Telepon " >
												</div>
											</div>				
											<div class="form-group col-xs-12">
												<label class="col-sm-3 control-label">Email</label>
												<div class="col-sm-8">
													<input type="email" name="email_daftar" class="form-control" placeholder="Masukkan email " >
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
							</div>
			</div>
				  <div class="modal-footer" >
					<div style="margin-bottom:20px">
					<div id="konfirmasi_daftar"></div>
					
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="button" class="btn btn-primary" onclick="daftar()">Next</button>
						</form>		
					</div>
				  </div>
				</div>
			  </div>
			  </div>
			</div>
			
			
			

			
			<!-- Modal   Konfirmasi -->
			<div class="modal fade" id="daftarOk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:-30px">
			  <div style="width:100%">
			  <div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content" style="border-radius:0px;">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><div class="alert alert-success">Berhasil mendaftar</div></h4>
				  </div>
				   <div class="modal-body">
						<div><h4>Pendaftaran anda telah berhasil dikirim,<br/> anda akan mendapatkan konfirmasi lewat E-Mail yang telah anda daftarkan,<br/> jika telah mendapat persetujuan pengurus.</h4></div>
				  </div>
				  <div class="modal-footer" >
					<div style="margin-bottom:20px">
					<div id="konfirmasi_daftar"></div>
					
						<a href="main.html" class="btn btn-default" >OK</a>
						</form>		
					</div>
				  </div>
				</div>
			  </div>
			  </div>
			</div>

        <!-- Javascript -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.backstretch.js"></script> 
		<script src="../js/scripts.js"></script>
        <script type="text/javascript">
	$(document).ready(function(){
		$("#login").click(function(){
			var email_login	= $('input[name=email]').val();
			var password_login	= $('input[name=password]').val();
			$.ajax({
				type	:"POST",
				url		:"../kontrol/login.php",
				data	:"login=in&email_login="+email_login+"&password_login="+password_login,
				success	: function(data){
					if(data=='true'){					
						
						window.location="layout_user.php?home=yes";
					}
					else{
						$("#konfirmasi_login").html(data);
					}
				}
			})
		});
		
		$('#nikah').change(function(){
			var x = document.getElementById("nikah"); 
			var select = x.options[x.selectedIndex].value;
			if(select=="kawin"){
				
				$("#pasangan").css("display","block")
			}	
		});
		
		$(".next").on('click', function (){
				var dob = new Date($("input[name=birthdate]").val());
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                //$('#umur').val(age);
				
				if(age > 17){    ///Jika telah berumur 17
					$('#myModalkontak').modal('show');
				}
				
				else {          ///jika belum
					var email		= null;
					var pass1		= null;
					var pass2		= null;
					var job			= null;
					var phonenumber	= null;
					
					var ayah	= $("input[name=ayah]").val();
					var ibu		= $("input[name=ibu]").val();
					var nickname	= $("input[name=nickname]").val();
					var name		= $("input[name=name]").val();
					var namapasangan= $("input[name=pasangan]").val();
					
					var gender		= $("select[name=gender]").val();
					var bloodtype	= $("select[name=bloodtype]").val();
					var birthplace	= $("input[name=birthplace]").val();
					var birthdate	= $("input[name=birthdate]").val();
					var id_keluarga	= $("select[name=id_keluarga]").val();
					var adress		= $("textarea[name=adress]").val();

										
					console.log(email,pass1,pass2,job,phonenumber,ayah,ibu,nickname,name,gender,bloodtype,birthplace,birthdate,id_keluarga,namapasangan,adress);
					
					$.ajax({
						type	:"POST",
						url		:"../kontrol/login.php",
						data  :"login=daftar&ayah="+ayah+"&ibu="+ibu+"&nickname="+nickname+"&name="+name+"&gender="+gender+"&bloodtype="+bloodtype+"&birthplace="+birthplace+"&birthdate="+birthdate+"&id_keluarga="+id_keluarga+"&namapasangan="+namapasangan+"&adress="+adress+"&email="+email+"&pass1="+pass1+"&pass2="+pass2+"&job="+job+"&phonenumber="+phonenumber,
						success	: function(data){
							 //window.location.href = "http://localhost/sik_new/view/main.html"; 
							 if(data != "failed"){
								 //$('#myModalprofil').modal('show');
								 
									//$('#add_form')[0].reset();
									$('#myModal').modal('hide');
									$('#myModalkontak').modal('hide');
									//$('#myModalprofil').modal('show');
								 window.location.href = "image_cONTRol_uNit/add_profil_pendaftar.php?tpfedusrprfl="+data; 
								 
								}
								else {
									//$("#konfirmasi_daftar").html(data);
								}
						}
					})
					
					
				}
		});
	
	
	
	});
	function daftar(){
					var email		= $("input[name=email_daftar]").val();
					var pass1		= $("input[name=pass1]").val();
					var pass2		= $("input[name=pass2]").val();
					var job			= $("input[name=job]").val();
					var phonenumber	= $("input[name=phonenumber]").val();
					
					var ayah	= $("input[name=ayah]").val();
					var ibu		= $("input[name=ibu]").val();
					var nickname	= $("input[name=nickname]").val();
					var name		= $("input[name=name]").val();
					var namapasangan= $("input[name=pasangan]").val();
					
					var gender		= $("select[name=gender]").val();
					var bloodtype	= $("select[name=bloodtype]").val();
					var birthplace	= $("input[name=birthplace]").val();
					var birthdate	= $("input[name=birthdate]").val();
					var id_keluarga	= $("select[name=id_keluarga]").val();
					var adress		= $("textarea[name=adress]").val();

										
					console.log(email,pass1,pass2,job,phonenumber,ayah,ibu,nickname,name,gender,bloodtype,birthplace,birthdate,id_keluarga,namapasangan,adress);
					
					$.ajax({
						type	:"POST",
						url		:"../kontrol/login.php",
						data  :"login=daftar&ayah="+ayah+"&ibu="+ibu+"&nickname="+nickname+"&name="+name+"&gender="+gender+"&bloodtype="+bloodtype+"&birthplace="+birthplace+"&birthdate="+birthdate+"&id_keluarga="+id_keluarga+"&namapasangan="+namapasangan+"&adress="+adress+"&email="+email+"&pass1="+pass1+"&pass2="+pass2+"&job="+job+"&phonenumber="+phonenumber,
						success	: function(data){
							 //window.location.href = "http://localhost/sik_new/view/main.html"; 
							 if(data != "failed"){
								 $('#add_form')[0].reset();
									$('#myModal').modal('hide');
									$('#myModalkontak').modal('hide');
								 //$('#myModalprofil').modal('show');
								 //window.location.href = "image_cONTRol_uNit/add_profil_pendaftar.php?tpfedusrprfl="+data; 
									location.reload();
									//$('#add_form')[0].reset();
								/*	$('#myModal').modal('hide');
									$('#daftarOk').modal('show');
								 */
								 
								}
								else {
									//$("#konfirmasi_daftar").html(data);
								}
						}
					})
			}
			
	
								 /*
									$('#add_form')[0].reset();
									$('#myModal').modal('hide');
									$('#daftarOk').modal('show');
								 */
								 
			
	</script>
		 	<link href="../js/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

			<script src="../js/bootstrap-datepicker.js"></script>
			<script>
			$("#datepicker").datepicker({
				startView: "decade",
				format: "yyyy-mm-dd",
				clearBtn: true,
				autoclose: true,
				
				
			})
			
			</script> 


    </body>

</html>