<div class="modal-background" style="background-color: rgba(128, 128, 128, 0.344);width:100%;height:120vh;position:absolute;z-index:300;backdrop-filter: blur(5px);">
  <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Are you sure to reject the payment?</h5>
        </div>

        <form action="" method="POST">
          <div  class="modal-footer" style="display: flex;">
              <input type="hidden" name="id" value="<?= $data['id'] ?>">
              <button name="cancel" value="cancel-reject" type="submit" class="btn btn-outline-dark">Cancel</button>
              <button name="reject" value="reject" type="submit" class="btn btn-dark">Reject</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
