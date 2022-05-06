<div class="modal-background" style="background-color: rgba(128, 128, 128, 0.344);width:100%;height:120vh;position:absolute;z-index:300;backdrop-filter: blur(5px);">
  <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header" style="display:flex;justify-content:center">
          <center><img src="<?= BASE_URL?>/icon/warning.png" alt=""></center>
        </div>
        <div class="modal-body">
          <p class="modal-title" id="exampleModalLabel">Current account status: <?php
            if($data['status'] == 1){
              echo "active";
            }
            else if($data['status'] == 2){
              echo "deactive";
            }
          
          ?>, Are you sure want to <?php
            if($data['status'] == 2){
              echo "active";
            }
            else if($data['status'] == 1){
              echo "deactive";
            }
          ?> this account</p>
        </div>
        <form action="" method="POST">
          <div  class="modal-footer" style="display: flex;">
              <input type="hidden" name="email" value="<?= $data['email'] ?>">
              <input type="hidden" name="account_status" value="<?php
              if($data['status'] == 1){
                echo 2;
              }else{
                echo 1;
              }
              ?>" id="">
              <button name="cancel" value="cancel_logout" type="submit" class="btn btn-outline-dark">Cancel</button>
              <button name="change_account" value="change_account" type="submit" class="btn btn-dark">
                <?php
                  if($data['status'] == 2){
                    echo "activate";
                  }
                  else if($data['status'] == 1){
                    echo "deactivate";
                  }
                ?>
              </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
