<?php
	include_once "../connt.php";
	include ('../kontrol/session_cekker.php');
	
	$cek = mysqli_query($koneksi,"SELECT DISTINCT id_album FROM images");
	$ok = mysqli_num_rows($cek);
	if($ok > 0){
			$i=0;
			while($clr = mysqli_fetch_assoc($cek)){
				$i++;
				$clr_list[$i] = $clr["id_album"];
			}
			$clear_list = implode(",",$clr_list);
			$bersihkan = mysqli_query($koneksi,"DELETE FROM album WHERE id_album not in ($clear_list)");
	}
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Gallery</h1>
	</div>
</div>
			<a href="admin_layout.php?add_album=yes" class="btn btn-primary">Buat album</a>
		<div class="col-lg-2">
			<select class="form-control" name="tahun" id="tahun">
								<option value="all">Semua Tahun</option>
									<?php
									$thn_skr = date('Y');
									for ($x = $thn_skr; $x >= 2017; $x--) {
									?>
										<option value="<?php echo $x ?>"><?php echo $x ?></option>
									<?php
									}
									?>
							</select>
		</div>
	<div class="col-lg-4 pull-right">
							
						<div class="navbar-form navbar-right">
							<div class="form-group">
								<input type="text" name="cari_album" placeholder="Cari Judul Album" class="form-control">
								<button type="button" value="search" class="btn btn-default cariin" data-toggle="tooltip" title="Cari Data Post">Cari</button>
							</div>
						</div>	
					</div>
<hr/>
<div class="row" id="list_album">
		<?php
		
			$allbum = mysqli_query($koneksi, "SELECT * FROM album ORDER BY id_album DESC");
		
			 while($alb = mysqli_fetch_assoc($allbum )){
				$deff = mysqli_query($koneksi,"SELECT name_img FROM images WHERE id_album = '".$alb["id_album"]."' LIMIT 1");
				$take_pitch = mysqli_fetch_array($deff);
                    echo '
					<div class="col-md-3">
						<div class="panel panel-default">
						  <div class="panel-body" align="center">
							<img src="../images/gallery/thumb/'.$take_pitch["name_img"].'" width="200" >
						  </div>
						  <div class="panel-footer" style="min-height:107px">
							<div style="min-height:65px">'.$alb["judul_album"].'<br/>
							'.date("d F Y", strtotime($alb["created_at"])).'<br/></div>
							<a href="admin_layout.php?edit_album=yes&id_album='.$alb["id_album"].'" class="btn btn-xs btn-success " type="submit" onclick="">Lihat / Edit / Hapus album</a>
							<!--<button class="btn btn-xs btn-danger " type="submit" onclick="">Hapus</button>-->
							
						  </div>
						</div>
					</div>
						';
                 
               
              }
		
		?>
		</div>
<script src="../js/jquery.min.js"></script>		
<script>
	$('.cariin').on('click',function(){
		var nama = $('input[name=cari_album]').val(); 
		console.log(nama);
           $.ajax({  
			url:"../kontrol/crud_admin/album_kontroller.php",
			type	:"POST",
			data:"crud=cari&nama="+nama,   
			success:function(data){
					$("#list_album").html(data);
				}
					    
           }); 	
	});
$('#tahun').change(function(){
		var x = document.getElementById("tahun"); 
		var select = x.options[x.selectedIndex].value;
		console.log(select);
           $.ajax({  
			url:"../kontrol/crud_admin/album_kontroller.php",
			method:"POST",
			data:"crud=selecttahun&select="+select,   
			success:function(data){
					$("#list_album").html(data);
				}
					    
           }); 	
	});

</script>		
		