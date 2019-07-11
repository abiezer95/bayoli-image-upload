<?php require 'database/definitions.php'; ?>
<div
  class="modal fade"
  id="picmodal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit your image</h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body modal-content">
          <ul class="nav nav-pills nav-fill allTabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Sizes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Finish</a>
              </li>
          </ul>

        <div class="modalHeight">
          <div style="width: 450px;" class="inout"></div>
        
          <div class="spinner-border text-warning loading" role="status">
            <span class="sr-only">Loading...</span>
          </div>

        <div class="modaloptions">
          <button type="button" class="btn btn-warning" onclick="anotherFile()">
            Choose another image
          </button>
          <div class="form-check crop-check">
            <input class="form-check-input position-static" type="checkbox" id="full" onchange="fullSize()" />
            <label for="full">Use crop options</label>
          </div>
        </div>
        <div id="modaloptions">
          <ul class="list-group list-prints">
            <div class="list-prints-update">
            <?php 
              $types = getAll('type_prints', ['name', 'price', 'id'], '');
              $n = 0;
              foreach ($types as $key => $value) {
                if($n <= 0){
                  echo '
                  <li class="list-group-item active">
                    '.strtoupper($types[$key]['name']).'
                  <i class="far fa-check-circle selectedprint"></i>
                  </li>
                  ';
                }

                if($n >= 1 && $n <=3){
                  echo '
                  <li class="list-group-item">
                    '.strtoupper($types[$key]['name']).'
                  <i class="selectedprint"></i>
                  </li>
                  ';
                }
                
                $n++;
                if($n > 3){ break;}
              }
              // echo json_encode($all);
            ?>
            </div>
            
            <li class="multiselect">
              <div class="btn-group">
                <button
                  type="button"
                  class="btn dropdown-toggle dropdown-toggle-split"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  See more options
                </button>

                <div class="dropdown-menu">
                  <a class="dropdown-item newPrintMenu">Add more prints</a>
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-allEl">
                    <?php 
                      $n = 0;
                      foreach ($types as $key => $value) {      
                        if($n > 3){
                          echo '
                          <a class="dropdown-item" href="#">'.strtoupper($types[$key]['name']).'</a>
                          ';
                        }
                        
                        $n++;
                      }
                    ?>
                    
                  </div>
                </div>
                <script src="loads/modal/js/modal.js"></script>
              </div>
              <i class="selectedprint"></i>
            </li>
          </ul>

          <div class="price">
            <span>Price: $250</span>
            <label
              >For more information contact us. <a href="">Click Here</a></label
            >
          </div>
          </div>
        </div>

        <!-- here is the new tab sizes -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Cancel
        </button>
        <!-- <button type="button" class="btn prevStep" onclick="psteps()">Prev Step</button> -->
        <button type="button" class="btn btn-primary nstep" disabled onclick="nsteps()">Next Step</button>
      </div>
    </div>
  </div>
</div>

<script src="js/rcrop.js"></script>
<link href="css/rcrop.min.css" media="screen" rel="stylesheet" type="text/css" />

<style>
.loading{
  position:absolute;
  left: 158px;
  top: 81px;
}
</style>

