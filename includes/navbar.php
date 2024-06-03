<div class="header">
    <div class="header-left">
         <a href="" class="logo">
            <img src="assets/img/nipralo_logo.png" width="250" height="250" alt="Logo">
        </a>
        <a href="" class="logo2">
            <img src="assets/img/nipralo_logo.png" width="250" height="250" alt="Logo">
        </a>
    </div>
            
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
    
    <div class="page-title-box" >
    <?php
          $currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
          $sanitizedLabel = preg_replace('/[^a-zA-Z0-9]/', '', $currentPage);
          $label = GetLabelForNavbar($sanitizedLabel);
          echo '<h3 id="title">' . $label . '</h3>';
          ?>       
        <!-- <h3 id="title">' . $label . '</h3> -->
    </div>
    
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="<?= $getCount['photo']?>" alt="User Image">
                <span class="status online"></span></span>
                <span><?= $getCount['first_name']?></span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.php?idd=<?= $getCount['id']?>">My Profile</a>
                <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php">My Profile</a>
                <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                <a class="dropdown-item" href="index.php">Logout</a>
            </div>
        </div>   
</div>

<script>
	function setPageTitle(newTitle) {
         document.getElementById("title").innerHTML = newTitle;
	}
</script>