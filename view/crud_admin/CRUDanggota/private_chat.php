

<!-- Morris Charts -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">CHAT PRIVATE</h1>
    </div>
</div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-3" >
                        <div class="panel panel-red" >
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> User Online</h3>
                            </div>
                            <div class="panel-body">
                                <div style="height:250px;">
                                <?php


                                include_once ('../kontrol/session_cekker.php');
                                $selectUs=mysqli_query($koneksi, "SELECT nickname,profil,level_user AS level FROM anggota where id_anggota='".$_SESSION['id_user']."'");
                                while($use=mysqli_fetch_assoc($selectUs)){
                                    $nameUs = $use['nickname'];
                                    $prof= $use['profil'];
                                    $lev = $use['level'];
                                }
                                        $id_user=$_SESSION['id_user'];

                                    $id_chat=0;
                                    if(isset($_GET['id_chat'])){
                                     $id_chat=$_GET['id_chat'];
                                        } 

                                    $chat1=mysqli_query($koneksi,"
                                        SELECT id_anggota,name,status
                                        FROM anggota 
                                        WHERE  id_anggota!=$id_user;
                                        ");
                                    $person_chat=mysqli_query($koneksi,"
                                        SELECT user_one,user_two 
                                        FROM message
                                        WHERE  id_message=$id_chat;
                                        ");

                                 
                                        $person_data=mysqli_fetch_assoc($person_chat);
                                        if(mysqli_num_rows($chat1)!=0){
                                            echo "<div style='color:blue;'>";
                                            echo "<center><label>(ONLINE)</label></center>";
                                            while($data_chat=mysqli_fetch_assoc($chat1)){
                                                if($data_chat['status']=='online'){
                                                    if($data_chat['id_anggota']==$person_data['user_two']){
                                                        echo "<div style='background-color:gray;text-align:center;padding:5px'><a href='#' onclick='pesan(".$data_chat['id_anggota'].");' style='color:#fff;'> <span class='glyphicon glyphicon-user' aria-hidden='true'> ".$data_chat['name']."</span></a></div>";
                                                            }
                                                    else {
                                                        echo "<a href='#' onclick='pesan(".$data_chat['id_anggota'].");'> <span class='glyphicon glyphicon-user' aria-hidden='true'> ".$data_chat['name']."</span></a><br/>";
                                                    }
                                                }
                                            }

                                            echo "</div>";
                                            echo "<div style='color:black;'>";
                                            echo "<br /><center><label style='text-align:center;'>(OFFLINE)</label></center>"; 
                                            mysqli_data_seek( $chat1, 0 );
                                            while($chat_data1=mysqli_fetch_array($chat1)){
                                                if($chat_data1['status']=='offline'){
                                                    if($chat_data1['id_anggota']== $person_data['user_two']){
                                                        echo "<div style='background-color:gray; text-align:center; pack(format)adding:5px'>
                                                            <a href='#' onclick='pesan(".$chat_data1['id_anggota'].");'><span class='glyphicon glyphicon-user' aria-hidden='true'> ".$chat_data1['name']."</span></a></div>";
                                                    }
                                                    else {
                                                        echo "<a href='#' onclick='pesan(".$chat_data1['id_anggota'].");'> <span class='glyphicon glyphicon-user' aria-hidden='true'> ".$chat_data1['name']."</span> </a><br/>";
                                                    }
                                            }
                                        }
                                            echo "</div>";
                                    }
                                
                                ?>  
                                </div>
                            </div>
                        </div>
                    
                    </div>
                
                    <div class="col-md-7">
                        <div class="panel panel-red">
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title"> PRIVATE CHAT </h3>
                            </div>
                            <div class="panel-body" style="height:400px;position: relative;">
                                <div id="pesan" style="width:100%;height:100%;overflow-y:scroll;padding:10px;border-radius:5px;background:#fff;position: absolute;bottom: 0;left: 0;">
                                    
                                </div>
                               
                            </div>
                             <div class="panel-body">
                                <div class="input-group">
                                  <input type="text" name='chat_send' class="form-control" placeholder="tuliskan pesan...">
                                  <span class="input-group-btn">
                                    <button id='chat_send' class="btn btn-default" type="button"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></button>
                                  </span>
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                

<!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

    setInterval(function(){
                $("#pesan").load("../kontrol/anggota/private_chat.php?id=reload_chat&id_pesan=<?php echo $id_chat; ?>");
                var hitung=$('#hitung').val();
              
                if($("#pesan").scrollTop()+hitung*10>= $("#pesan")[0].scrollHeight){
            
                $("#pesan").animate({ scrollTop:hitung*60}, 50);
            }
             },500);

           //functioon chat message
    $('#chat_send').click(function(){
        var send_chat=$('input[name=chat_send]').val();
        var pengirim="<?php echo $_SESSION['id_user']; ?>";
        var id_pesan="<?php echo $id_chat; ?>";

            $.ajax({
                type    :"POST",
                url     :"../kontrol/anggota/private_chat.php",
                data    :"send_chat="+send_chat+"&id_pengirim="+pengirim+"&id_pesan="+id_pesan,
                success : function(data){
                      
                       $('input[name=chat_send]').val(null);
                }
            })
        }) 

   
    });

     function pesan(id_pengirim){
         var pengirim="<?php echo $_SESSION['id_user']; ?>";
         var penerima=id_pengirim;
         var level="<?php echo $lev; ?>";
               $.ajax({
                type    :"POST",
                url     :"../kontrol/anggota/private_chat.php",
                data    :"new_message=yes&id_pengirim="+pengirim+"&id_penerima="+penerima,
                success : function(data){
                       if(level='admin'){
                        window.location.assign("admin_layout.php?private_chat=yes&id_chat="+data);
                       }
                       else{
                      window.location.assign("layout_user.php?private_chat=yes&id_chat="+data);}
                }
            })
    }

    </script>