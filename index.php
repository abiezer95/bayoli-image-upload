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
    <title>Send us your images here</title>

    <!-- css -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <link href="css/fonts/css/all.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </head>

  <body>
    <!-- <div class="loader" style="display: none;">
        
    </div> -->

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
              <li>
                <a href="https://colorlib.com/preview/theme/cocoon/index.html"
                  >Home</a
                >
              </li>
              <li>
                <a href="https://colorlib.com/preview/theme/cocoon/about.html"
                  >About Us</a
                >
              </li>
              <li>
                <a
                  href="https://colorlib.com/preview/theme/cocoon/services.html"
                  >Services</a
                >
              </li>
              <li class="active">
                <a
                  href="https://colorlib.com/preview/theme/cocoon/portfolio.html"
                  >Portfolio</a
                >
              </li>
              <li>
                <a href="https://colorlib.com/preview/theme/cocoon/blog.html"
                  >Blog</a
                >
              </li>
              <li>
                <a href="https://colorlib.com/preview/theme/cocoon/contact.html"
                  >Contact</a
                >
              </li>
            </ul>
          </div>

          <div class="side_menu_section">
            <h4 class="side_title">filter by:</h4>
            <ul id="filtr-container" class="filter_nav">
              <li data-filter="*" class="active"><a>all</a></li>
              <li data-filter=".branding"><a>branding</a></li>
              <li data-filter=".design"><a>design</a></li>
              <li data-filter=".photography"><a>photography</a></li>
              <li data-filter=".architecture"><a>architecture</a></li>
            </ul>
          </div>

          <div class="side_menu_bottom">
            <div class="side_menu_bottom_inner">
              <ul class="social_menu">
                <li>
                  <a
                    href="https://colorlib.com/preview/theme/cocoon/portfolio.html#"
                  >
                    <i class="ion ion-social-pinterest"></i>
                  </a>
                </li>
                <li>
                  <a
                    href="https://colorlib.com/preview/theme/cocoon/portfolio.html#"
                  >
                    <i class="ion ion-social-facebook"></i>
                  </a>
                </li>
                <li>
                  <a
                    href="https://colorlib.com/preview/theme/cocoon/portfolio.html#"
                  >
                    <i class="ion ion-social-twitter"></i>
                  </a>
                </li>
                <li>
                  <a
                    href="https://colorlib.com/preview/theme/cocoon/portfolio.html#"
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
            <div
              class="grid-item  branding architecture  col-md-6 col-lg-3"
              style="position: absolute; left: 24.9962%; top: 0px;"
            >
              <a title="project name 2">
                <div class="project_box_one">
                  <img src="images/port2.png" alt="pro1" />
                  <div class="product_info">
                    <div class="product_info_text">
                      <div class="product_info_text_inner">
                        <i class="ion ion-plus"></i>
                        <h4>project name</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="grid-item  design col-sm-12 col-md-6 col-lg-3"
              style="position: absolute; left: 49.9925%; top: 0px;"
            >
              <a title="project name 5">
                <div class="project_box_one">
                  <img src="images/port3.png" alt="pro1" />
                  <div class="product_info">
                    <div class="product_info_text">
                      <div class="product_info_text_inner">
                        <i class="ion ion-plus"></i>
                        <h4>project name</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="grid-item  photography design col-sm-12 col-md-6 col-lg-3"
              style="position: absolute; left: 74.9887%; top: 0px;"
            >
              <a title="project name 5">
                <div class="project_box_one">
                  <img src="images/port4.png" alt="pro1" />
                  <div class="product_info">
                    <div class="product_info_text">
                      <div class="product_info_text_inner">
                        <i class="ion ion-plus"></i>
                        <h4>project name</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="grid-item  branding photography  col-sm-12 col-md-6 col-lg-3"
              style="position: absolute; left: 0%; top: 266px;"
            >
              <a title="project name 5">
                <div class="project_box_one">
                  <img src="images/port5.png" alt="pro1" />
                  <div class="product_info">
                    <div class="product_info_text">
                      <div class="product_info_text_inner">
                        <i class="ion ion-plus"></i>
                        <h4>project name</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="grid-item   architecture design col-sm-12 col-md-6 col-lg-3"
              style="position: absolute; left: 24.9962%; top: 266px;"
            >
              <a title="project name 5">
                <div class="project_box_one">
                  <img src="images/port6.png" alt="pro1" />
                  <div class="product_info">
                    <div class="product_info_text">
                      <div class="product_info_text_inner">
                        <i class="ion ion-plus"></i>
                        <h4>project name</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="piData"></div>
    
    <div class="piSizes"></div>
    
    <div id="pimodal">
      <?php include('loads/modal/modal.php');?>
    </div>

    
  </body>
</html>
