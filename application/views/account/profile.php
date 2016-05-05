<div class="container">
  <div class="col-md-12">

    <div class="panel panel-default">
      <div class="panel-body reload-profile">
        <?php $this->load->view('template/profile-template'); ?>
      </div>
    </div>

  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">My listings</h4>
      </div>
      <div class="panel-body">
        <?php $this->load->view('template/items-template'); ?>
      </div>
    </div>
  </div>
</div>
