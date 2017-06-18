<?php
include_once "../../connt.php";

if(isset($_GET['id'])){
	$id_chat=$_GET['id_pesan'];
	$pesan_query=mysqli_query($koneksi,"
		SELECT a.id_message,reply,id_pengirim,name,a.date,id_pesan,user_one,user_two
        FROM private_message a
        INNER JOIN anggota c ON a.id_pengirim=c.id_anggota
        INNER JOIN message b ON a.id_pesan=b.id_message
        WHERE a.id_pesan=$id_chat
		");
	
	$hitung=mysqli_num_rows($pesan_query);
	echo "<input type='hidden' value='$hitung' id='hitung'>";
	if(mysqli_num_rows($pesan_query)!=0){	
		while($pesan_chat=mysqli_fetch_array($pesan_query)){
			if($pesan_chat['id_pengirim']==$pesan_chat['user_two'])
			echo "<div class='pull-left' style='clear:both'>".$pesan_chat['date']."<br/><label >".$pesan_chat['name']."&nbsp; : ".$pesan_chat['reply']."</label></div><br />";
		else if($pesan_chat['id_pengirim']==$pesan_chat['user_one'])
			echo "<div class='pull-right' style='clear:both'>".$pesan_chat['date']."<br/><label >".$pesan_chat['reply']." : &nbsp;".$pesan_chat['name']."</label></div><br />";
		}
	}
}


if(isset($_POST['send_chat'])){
	$reply=$_POST['send_chat'];
	$id_pengirim=$_POST['id_pengirim'];
	$date=date("Y-m-d H:i:s");
	$id_pesan=$_POST['id_pesan'];
	$simpan_pesan_query=mysqli_query($koneksi,"
		INSERT INTO private_message(reply,id_pengirim,date,id_pesan)
		VALUES ('$reply','$id_pengirim','$date','$id_pesan');
		");
	
}

if (isset($_POST['new_message'])){
	$id_pengirim=$_POST['id_pengirim'];
	$id_penerima=$_POST['id_penerima'];

            $date=date("Y-m-d H:i:s");
             $cek_chat=mysqli_query($koneksi,"
                                        SELECT id_message
                                        FROM message
                                        WHERE  (user_one=$id_pengirim AND user_two=$id_penerima)
                                        OR (user_two=$id_pengirim AND user_one=$id_penerima);
                                        ");
            if(mysqli_num_rows($cek_chat)==NULL){
                mysqli_query($koneksi,"INSERT INTO message(user_one,user_two,date)
                    VALUES ($id_pengirim,$id_penerima,'$date')");

                 $newdata=mysqli_fetch_assoc($cek_chat);
                 echo $newdata['id_message'];
            }
            else{
            	 $newdata=mysqli_fetch_assoc($cek_chat);
                 echo $newdata['id_message'];
            }


}

?>