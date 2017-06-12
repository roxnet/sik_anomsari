<?php
if(isset($_POST['id'] && $_POST['sid']){
	$id=$_POST['id'];
	$sid=$_POST['sid'];
	$pesan_query=mysli_query($koneksi,"
		SELECT id_anggota as pengirim,id_anggota1 as penerima,pesan
		FROM private_message
		where (id_anggota=".$id." OR id_anggota=".$sid.") 
		AND (id_anggota1=".$id." OR id_anggota1=".$sid.")
		");
	if(mysqli_num_rows($pesan_query)!=0){
		while($pesan_chat=mysqli_fetch_array($pesan_query)){
			if($pesan_chat['pengirim']==$id)
			echo"<label class='pul_left'>".$pesan_chat['pesan']."</label><br />";
		else if($pesan_chat['pengirim']==$sid)
			echo"<label class='pul_right'>".$pesan_chat['pesan']."</label><br />";
		}
	}
}


?>