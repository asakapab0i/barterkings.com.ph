  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-body item-general">
          <h4><?php echo $data[0]['name']; ?>
            <span class="pull-right label label-danger">₱<?php echo $data[0]['value']; ?></span>
            <?php if ($editable === TRUE):?>
            <?php endif;?>
          </h4>
          <h5>
            <?php echo $data[0]['location'] ?>
          </h5><hr>
          <div class="item-images">
            <h4><small class="pull-right"><span data-itemid="<?php echo $data[0]['itemid']; ?>" class="reload-images-count"><?php echo $images_count; ?></span> images</small> Images
              <!-- <?php if ($editable === TRUE):?>
                <a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="item/upload/" data-method="upload" class="pop-modal btn btn-success btn-xs">Upload</a>
              <?php endif;?> -->
            </h4>
            <div data-itemid="<?php echo $data[0]['itemid']; ?>" class="reload-images">
              <?php $this->load->view('template/images-template'); ?>
            </div>
          </div>
        </div>
      </div>

      </div
    </div>
  </div>

    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title"><h4>Description</h4></div>
          </div>
          <div class="panel-body">
            <?php $this->load->view('template/item-template');?>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-body">
            <h4>The Seller</h4><hr>
            <?php $this->load->view('template/profile-template'); ?>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-body">
            <h4><small class="pull-right"><span data-itemid="<?php echo $data[0]['itemid']; ?>" class="reload-comments-count-<?php echo $data[0]['itemid']; ?>"><?php echo $comments_count; ?></span> comments</small> Comments
              <a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="item/comment" data-method="upload" class="pop-modal btn btn-xs btn-success">Make comments</a>
            </h4><hr>
            <div class="reload-comments-<?php echo $data[0]['itemid']; ?> comments-list reload-comments">
              <?php $this->load->view('template/comments-template');?>
            </div>
          </div>
        </div>

      </div>
  </div>
