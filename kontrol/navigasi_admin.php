<?php 
	if(isset($_GET['dashboard'])){
      if($_GET['dashboard']=='yes'){
        include_once "crud_admin/dashboard.php";
      }}
	else if(isset($_GET['post'])){
      if($_GET['post']=='yes'){
        include_once "crud_admin/post.php";
      }}
	else if(isset($_GET['add_blog'])){
		if($_GET['add_blog']=='yes'){
			include_once "blog/add_blog.php";
		}}
	else if(isset($_GET['edit_blog'])){
		if($_GET['edit_blog']=='yes'){
			include_once "blog/edit_blog.php";
		}}
	else if(isset($_GET['comment'])){
		if($_GET['comment']=='yes'){
			include_once "crud_admin/comment.php";
		}}
	else if(isset($_GET['gallery'])){
		if($_GET['gallery']=='yes'){
			include_once "crud_admin/gallery.php";
	}}

		else if(isset($_GET['add_album'])){
					if($_GET['add_album']=='yes'){
						include_once "crud_admin/CRUDgallery/add_album.php";  
				}}

				else if(isset($_GET['edit_album'])){
					if($_GET['edit_album']=='yes'){
						include_once "crud_admin/CRUDgallery/edit_album.php";  
				}} 

	else if(isset($_GET['anggota'])){  ///--->Anggota here!!
		if($_GET['anggota']=='yes'){
			include_once "crud_admin/anggota.php";
	}}
			else if(isset($_GET['tambah_anggota'])){
				if($_GET['tambah_anggota']=='yes'){
					include_once "crud_admin/CRUDanggota/tambah_anggota.php";
			}}
			else if(isset($_GET['edit_anggota'])){
				if($_GET['edit_anggota']=='yes'){
					include_once "crud_admin/CRUDanggota/edit_anggota.php";
			}}
			
			
			////Percobaan profile
	else if(isset($_GET['profile'])){
		if($_GET['profile']=='yes'){
			include_once "img/example5.php";
	}}		
			
	else if(isset($_GET['pendaftar'])){
		if($_GET['pendaftar']=='yes'){
			include_once "crud_admin/pendaftar.php";
	}}
	
	else if(isset($_GET['forum'])){
		if($_GET['forum']=='yes'){
			include_once "crud_admin/forum.php";
	}}
				else if(isset($_GET['Threads'])){
					if($_GET['Threads']=='yes'){
						include_once "crud_admin/CRUDforum/forums.php";
				}}
				
				
				//ujian
				else if(isset($_GET['ujian'])){
					if($_GET['ujian']=='yes'){
						include_once "crud_admin/testdelimg.php";
				}}


	//private_chat
	if(isset($_GET['private_chat'])){
		if($_GET['private_chat']=='yes'){
			include_once "crud_admin/CRUDanggota/private_chat.php";
	}}

?>