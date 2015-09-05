<div class="container">
  <ul class="nav nav-tabs" role="tablist">
    <li class="">
      <a type="button" href="#compose" role="tab" data-toggle="tab"> 
        <span class="glyphicon glyphicon-pencil"></span> Compose
      </a>
    </li>
    <li class="active"><a href="#inbox" role="tab" data-toggle="tab">
      Inbox <span class="label label-success">10</span>
    </a></li>
    <li><a href="#sent-mail" role="tab" data-toggle="tab">Sent Message</a>
    </li>
    <li><a href="#draft" role="tab" data-toggle="tab">Draft</a>
    </li>
    <li><a href="#trash" role="tab" data-toggle="tab">Trash</a>
    </li>
  </ul>
</div>

<div class="tab-content">
  <div class="tab-pane" id="compose">
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
</div>
</div>