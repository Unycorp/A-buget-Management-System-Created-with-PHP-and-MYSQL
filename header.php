  
<div class="header">
    <style>
        .theName{
          display:flex;
      }
        .theName1{
          display:none;
      }
        .myBox{
          box-shadow:0 0 10px 1px rgba(0,0,0,.04);
          background:#ffffff;
          border-radius:5px;
          min-height:50px;
          margin:auto;
          border:1px solid rgba(255,255,255,.2);
          overflow:hidden;
          width:100%;
          margin-bottom:50px;
          padding-bottom:50px;
      }
        .myHeader{
          padding-left:20px;
          padding-top:20px;
          padding-bottom:20px;
          border-bottom:1px solid rgba(0,0,0,.05);
          background:rgba(0,0,255,.025);
          color:dodgerblue;
          font-size:16px;font-weight:bold;
            
      }
        .myCat{
          width:calc(100% / 3);
          min-width:200px;
          min-height:40px;
          padding-top:10px;
          padding-bottom:10px;
          margin-left:auto;
          margin-right:auto;
          border:1px solid rgba(0,0,0,.03);
          margin-top:30px;border-radius:5px;
         
      }
        .myBtn{
          border:0px;outline:none;
          padding:5px;border-radius:2px;font-size:16px;
          background:dodgerblue;
          color:white;
           cursor:pointer;
      }
        .myBtn:active{
          background:aliceblue;
      }
        .selBtn{
          background:aliceblue;
          color:black;
      }
        .btn-green{
            background:limegreen;
            border:1px solid limegreen;
        }
        btn-green:active{
            color:limegreen;
            background:white;
        }
        .topGravity{
            display:flex;
            flex-direction:column;
        }.nobut{
            border:0px;outline:none;background:none;
        }
        .leftGravity{
            display:flex;
         }
        @media only screen and (max-width:450px){
          
          .theName{
              display:none;
          }.theName1{
              display:flex;
          }
      }
	
</style>

            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <a class="header-left" href="javascript:void(0)" role="button" data-toggle="#dashboard">
                            <!--<code>This is budget</code>-->
                            
                        </a>

                        <ul class="navbar-nav header-right">
							
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell ai-icon" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
										<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
										<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
									</svg>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
										<ul class="timeline">
                                            <?php    $query = "SELECT * FROM notification WHERE user_id='$user_id' AND status_id='false' ORDER BY id DESC LIMIT 4";
                                                $result = mysqli_query($conn, $query);
                                                if(mysqli_num_rows($result)>0){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $message = $row['message'];
                                                        $date = $row['date_id']; ?>
											<li>
												<div class="timeline-panel">
													<div class="media mr-2 media-info">
														<?php echo substr($message, 0, 2) ?>
													</div>
													<div class="media-body">
														<h6 class="mb-1"><?php echo $message ?></h6>
														<small class="d-block"><?php $date ?></small>
													</div>
												</div>
											</li>
                                        <?php }}?>
										</ul>
									</div>
                                    <a class="all-notification" href="notification.php">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <img src="<?php echo $photo ?>" width="20" alt="" style='border-radius: 50%'/>
									<div class="header-info">
										<span>Hey, <strong><?php echo $name ?></strong></span>
										<small><?php echo $occupation ?></small>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="profile.php" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="notification.php" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">notification </span>
                                    </a>
                                    <a href="logout.php" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>