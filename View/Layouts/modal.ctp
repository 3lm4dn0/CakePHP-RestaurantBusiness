<div class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3><?=$title_for_layout?></h3>
  </div>
  <div class="modal-body">
    <p><?php echo $this->fetch('content'); ?></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Close</a>
  </div>
</div>