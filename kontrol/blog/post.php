<?php
	include_once "../connt.php";
	$post=$_GET['id'];
	$query=mysqli_query($koneksi,"SELECT a.*,b.name FROM blog a 
		INNER JOIN anggota b ON a.id_anggota=b.id_anggota 
		WHERE id_artikel='$post' 
		ORDER BY date_post desc");
	if(mysqli_num_rows($query)==1){
		while($data=mysqli_fetch_assoc($query)){
		echo "
				<h2 class='sub-title'>
					$data[tittle]
				</h2>
				<p class='post-meta'>Posted by <a href='#'>$data[name]</a> $data[date_post]</p>
				<hr/ style='margin-top:-25px;margin-bottom:5px;'>
				<article>
					".$data["content"]."[...]
				</article>
			
			<br/>
		";
	}}
?>