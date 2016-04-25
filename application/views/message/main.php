<div class="container">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="">
            <a type="button" data-type="create" href="#compose" class="show-tab"> 
              <span class="glyphicon glyphicon-pencil"></span> Compose
            </a>
          </li>
          <li class="active"><a data-type="inbox" href="#inbox" class="show-tab">
            Inbox 
            <?php if($count_inbox > 0): ?>
              <span class="label label-success"><?php echo $count_inbox; ?></span>
            <?php endif;?>
          </a></li>
          <li><a data-type="sent" href="#sent" class="show-tab">Sent Message</a>
          </li>
          <li><a data-type="draft" href="#draft" class="show-tab">Draft</a>
          </li>
          <li><a data-type="trash" href="#trash" class="show-tab">Trash</a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="content-container clearfix">
            <h1 class="content-title"></h1>
            <div class="content-body">

              <div class="panel">
                <div class="panel-body">

                  <?php $this->load->view('template/message-template'); ?>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>