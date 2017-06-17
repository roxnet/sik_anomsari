<?php
	include_once "../connt.php";
	include ('../kontrol/session_cekker.php');
?>				
				
				<input type="hidden" name="id" value="<?php echo $_SESSION['id_user'];?>">
				<div class="form-group col-xs-12"><hr/>
					<label class="col-sm-3 control-label">Password lama</label>
					<div class="col-sm-8">
						<input type="password" name="old_pass" class="form-control" placeholder="masukkan Password lama " required>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-3 control-label">Password baru</label>
					<div class="col-sm-8">
						<input type="password" name="new_pass" class="form-control" placeholder="masukkan Password baru" required>
					</div>
				</div>
				<div class="form-group col-xs-12">
				<div class="col-sm-10">
					<div class="pull-right">
						<button type="button" id="edt" class="btn btn-primary" onclick="edit()"><span class="glyphicon glyphicon-refresh"></span> Ubah password</button>
					</div>	
				</div>	
				</div>
				<br/>
				<div id="conplch"></div>
				
<script>				
				function edit(){
		var id				= $('input[name=id]').val();
		var old_pass		= $('input[name=old_pass]').val();
		var new_pass		= $('input[name=new_pass]').val();
		
		console.log(id,old_pass,new_pass);
		
		$.ajax({
			type	:"POST",
			url		:"../kontrol/user/ubah_profil.php",
			data  :"do=changepass&id="+id+"&old_pass="+old_pass+"&new_pass="+new_pass,
			success	: function(data){
				 //window.location.href = "layout_user.php?tentang=yes"; 
				$('#conplch').html(data);
			}
		})
}
</script>