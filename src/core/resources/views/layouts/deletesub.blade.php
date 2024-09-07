 <div class="modal fade" id="deletesub" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo trans('lang.delete_data');?></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
      		<form action="" method="POST">
                <p><?php echo trans('lang.delete_confirm');?></p>
      		   <input type="hidden" value="" name="iddelete" id="subiddelete"/>
      		  </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
          <input type="submit" class="btn btn-sm btn-fill btn-info" id="subdodelete" value="<?php echo trans('lang.delete_data');?>"/>
        </div>
      </div>
    </div>
  </div>