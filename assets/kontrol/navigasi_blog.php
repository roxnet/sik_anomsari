<?php 
	if(isset($_GET['home'])){
      if($_GET['home']=='yes'){
        include_once "blog/home_blog.php";
      }}
	else if(isset($_GET['post'])){
      if($_GET['post']=='yes'){
        include_once "blog/post_blog.php";
      }}
	  
	
?>