<div class="container">
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
</div>

<div class="tab-content">
 <div class="container">
  <div class="content-container clearfix">
    <h1 class="content-title"></h1>
    <div class="content-body">
      <?php $this->load->view('template/message-template'); ?>
    </div>
  </div>
</div>
<!--   <div class="tab-pane" id="compose">
    <div class="container">
      <div class="content-container clearfix">
        <h1 class="content-title">Compose</h1>
        <?php $this->load->view('template/message-compose-template'); ?>
      </div>
    </div>
  </div>
  <div class="tab-pane active" id="inbox">
   <div class="container">
    <div class="content-container clearfix">
      <h1 class="content-title">Inbox</h1>
      <?php $this->load->view('template/message-template'); ?>
    </div>
  </div>
</div>
<div class="tab-pane" id="sent-mail">
 <div class="container">
  <div class="content-container clearfix">
    <h1 class="content-title">Sent Message</h1>
    <?php $this->load->view('template/message-template'); ?>
  </div>
</div>
</div>
<div class="tab-pane" id="draft">
  <div class="container">
    <div class="content-container clearfix">
      <h1 class="content-title">Draft</h1>
      <?php $this->load->view('template/message-template'); ?>
    </div>
  </div>
</div>
<div class="tab-pane" id="trash">
 <div class="container">
  <div class="content-container clearfix">
    <h1 class="content-title">Trash</h1>
    <?php $this->load->view('template/message-template'); ?>
  </div>
</div>
</div> -->
</div>