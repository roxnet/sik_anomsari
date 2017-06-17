<?php
	if(isset($_GET['home'])){
      if($_GET['home']=='yes'){
        include_once "notif_user.php";
      }}

			else if(isset($_GET['notif'])){
					if($_GET['notif']=='yes'){
						include_once "notif_user.php";
					}}

			else if(isset($_GET['tentang'])){
					if($_GET['tentang']=='yes'){
						include_once "user/lihat_user.php";
					}}
	if(isset($_GET['blog'])){
      if($_GET['blog']=='yes'){
        include_once "blog/home_blog.php";
      }}
	else if(isset($_GET['post'])){
      if($_GET['post']=='yes'){
        include_once "post_blog.php";
      }}

	else if(isset($_GET['forum'])){
		 if($_GET['forum']=='yes'){
			 include_once "forum/home_forum.php";
		 }}

		else if(isset($_GET['Threads'])){
			 if($_GET['Threads']=='yes'){
				include_once "forum/forums.php";
			}}
		else if(isset($_GET['bahasan'])){
					if($_GET['bahasan']=='yes'){
						include_once "forum/bahasan.php";
				}}
				
		else if(isset($_GET['anggota'])){
		 if($_GET['anggota']=='yes'){
			 include_once "anggota/home_anggota.php";
		 }}	
				
				
				
else if(isset($_GET['edit_profile'])){
	 	if($_GET['edit_profile']=='yes'){
			include_once "user/edit_user.php"; 
		}}
		
else if(isset($_GET['ubah_password'])){				//ubah password  
	 	if($_GET['ubah_password']=='yes'){
			include_once "user/ubah_pass.php";
		}}
		
else if(isset($_GET['ganti_profil'])){				//ganti_profil 
	 	if($_GET['ganti_profil']=='yes'){
			include_once "user/ganti_foto_profil.php";
		}}		
		
		
if(isset($_GET['private_chat'])){
		if($_GET['private_chat']=='yes'){
			include_once "crud_admin/CRUDanggota/private_chat.php";
	}}
		
		else if(isset($_GET['gallery'])){  ///Galeri
	 	if($_GET['gallery']=='yes'){
			include_once "gallery/gallery.php";
		}}		
		
		else if(isset($_GET['lihat_album'])){  
	 	if($_GET['lihat_album']=='yes'){
			include_once "gallery/lihat_album.php";
		}}
		
?>
