<?php
	include_once "../../connt.php";
	if(isset($_POST['koment'])){
		if($_POST['koment']=='add'){
			$id_pengirim=$_POST['id_anggota'];
			$pesan=$_POST['komentar'];
			$id_artikel=$_POST['id_artikel'];
			$date=date("Y-m-d H:i:s");
			$querykomentar=mysqli_query($koneksi,"INSERT INTO
			bkomentar(id_artikel,id_anggota,komentar,date)
			values($id_artikel,$id_pengirim,'$pesan','$date')")or die (mysqli_error($querykomentar));
			if($querykomentar){
				$querycomment=mysqli_query($koneksi,"SELECT a.*,b.name 
    				FROM bkomentar a
    					INNER JOIN anggota b ON a.id_anggota=b.id_anggota
    					WHERE id_artikel=$id_artikel
    					ORDER BY date desc");
    			if(mysqli_num_rows($querycomment)!=0){
    				while($comment=mysqli_fetch_assoc($querycomment)){
    					echo "<div id='grid_komentar' style='background-color:rgba(0,0,0,0.1); margin-bottom:10px; padding:5px;'> <label>$comment[name]</label> . $comment[date] <hr / style='margin-top:5px;margin-bottom:5px;border:1px solid black'>
    					$comment[komentar] <br/><br/></div>
    					";
            		}
            	}
			}
		}
	}
?>