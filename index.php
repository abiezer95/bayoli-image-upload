<?php 
require 'database/definitions.php'; 
require 'database/is_mobile.php'; //detect mobile
require_once('../wp-load.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$logged = is_user_logged_in();
$user = wp_get_current_user();
$roles = $user->roles;
if($logged){
  if($roles[0] == 'administrator'){
    $logged = true;
  }else{
    $logged = false;
  }
}
//mobile
$detect = new Mobile_Detect;

if($detect->isMobile() or
$detect->isTablet()){
  header("/");
}
// if ($logged == false) {
//   header("Refresh:0");
// }
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />

    <!-- <meta name="description" content="Cocoon -Portfolio">
<meta name="keywords" content="Cocoon , Portfolio">
<meta name="author" content="Pharaohlab"> -->
    <meta
      name="viewport" 
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <title>Bayoli - upload your order here</title>
    <link rel="shortcut icon" href="http://www.bayoli.tk/wp-content/uploads/2019/07/borde-negro-42.png"/>
    <!-- css -->
    <link
      rel="stylesheet"
      href="css/bootstrap.min.css"
    />
    <link href="css/fonts/css/all.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <!-- bootstrap -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </head>  
  <body>
    <div class="load">
      <div class="load2">
        <div class="spinner-border text-warning" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <tt>Loading your image..</tt>
      </div>
    </div>

    <div class="body-container container-fluid" id="app">
      <a class="menu-btn">
        <i class="ion ion-grid"></i>
      </a>
      <div class="row justify-content-center">
        <div class="col-lg-2 col-md-3 col-12 menu_block">
          <div class="logo_box">
            <a class="sideBarTitle">File</a>
            <br />
            <a class="sideBarSubtitle">Upload your image</a>
          </div>

          <div class="side_menu_section">
            <ul class="menu_nav">
            <?php 
              $menus = get_terms('nav_menu');
            // wp_nav_menu( 'header-menu' );
              foreach ($menus as $menu) {
                echo '<li><a href="'.$menu->slug.'">'.ucfirst($menu->name).'</a></li>';
              }
              // print_r($menu);
            ?>
            </ul>
          </div>

          <div class="side_menu_section">
            <h4 class="side_title">filter by:</h4>
            <ul id="filtr-container" class="filter_nav">
              <?php
                if (!$logged) {
                  echo '<li data-filter="*" class="active"><a href="./">all</a></li>';
                }else{
                  if(!isset($_GET['completed'])){
                    echo '<li data-filter="*" class="active"><a href="./">all</a></li>';
                  }else{
                    echo '<li data-filter="*"><a href="./">all</a></li>';
                  }
                }
              ?>
              <?php
                if ($logged) {
                  if(isset($_GET['completed'])){
                    echo '<li data-filter="completed" class="active"><a href="?completed">Completed</a></li>';
                  }else{
                    echo '<li data-filter="completed"><a href="?completed">Completed</a></li>';
                  }
                }
              ?>
              <!-- <li data-filter=".branding"><a>Popular</a></li>
              <li data-filter=".design"><a>design</a></li>
              <li data-filter=".photography"><a>photography</a></li>
              <li data-filter=".architecture"><a>architecture</a></li> -->
            </ul>
          </div>

          <div class="side_menu_bottom">
            <div class="side_menu_bottom_inner">
              <ul class="social_menu">
                <li>
                  <a
                    href=""
                  >
                    <i class="ion ion-social-pinterest"></i>
                  </a>
                </li>
                <li>
                  <a
                    href=""
                  >
                    <i class="ion ion-social-facebook"></i>
                  </a>
                </li>
                <li>
                  <a
                    href=""
                  >
                    <i class="ion ion-social-twitter"></i>
                  </a>
                </li>
                <li>
                  <a
                    href=""
                  >
                    <i class="ion ion-social-dribbble"></i>
                  </a>
                </li>
              </ul>
              <div class="copy_right">
                <p class="copyright">
                  Copyright ©
                  <?php echo date("Y")?>
                  All rights reserved
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-10 col-md-9 col-12 body_block  align-content-center">
          <div
            class="portfolio gutters grid img-container"
            style="position: relative; height: 798.093px;"
          >
            <div class="grid-sizer col-sm-12 col-md-6 col-lg-3"></div>
            <div
              clvass="grid-item branding  col-sm-12 col-md-6 col-lg-3"
              style="position: absolute; left: 0%; top: 0px;"
              onclick="getFile()"
            >
              <a title="project name 1">
                <div class="project_box_one">
                  <!-- <img src="images/port1.png" alt="pro1"> -->
                  <center class="addMore">
                    <i class="fas fa-plus"></i>
                    <a><br />Add a new image</a>
                  </center>
                  <div class="product_info">
                    <div class="product_info_text">
                      <div class="product_info_text_inner">
                        <i class="ion ion-plus"></i>
                        <h4>Click here</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <!-- here -->
            <div class="picUpdateFrame">
              <?php 
                include('images.php');
              ?>
            </div>
        </div>
      </div>
    </div>
    <div id="piData"></div>
    
    <div class="piSizes"></div>
    
    <div id="pimodal">
      <?php include('loads/modal/modal.php');?>
    </div>

    <div class="admin">
    <?php 
          if($logged){
            include('loads/admin/header.php');
          }
    ?>
    </div>

    <div class="toasts">
        <div role="alert" aria-live="assertive" aria-atomic="true" id="" class="toast" data-autohide="false">
          <div class="toast-header">
            <i class="fas fa-bell"></i>
            <strong class="mr-auto ml-1">Notification</strong>
            <small class="ml-5">Just Now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="toast-body" style="color:#000;font-weight:bold;font-size:13px">
            toast-description
          </div>
        </div>
    </div>

    <div class="cacheData"></div>
  </body>
</html>