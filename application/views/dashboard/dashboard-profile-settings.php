<div class="panel panel-default">
  <div class="panel-heading">
    <h4>Profile Image</h4>
  </div>
  <div class="panel-body">
    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('template/profile-template'); ?>
      </div>
    </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h4>Profile Details</h4>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-9">
        <form method="post">
          <div class="form-group ">
            <label class="control-label " for="name">
              Name
            </label>
            <input class="form-control" id="name" name="name" type="text"/>
          </div>
          <div class="form-group ">
            <label class="control-label " for="url">
              URL
            </label>
            <input class="form-control" id="url" name="url" type="text"/>
          </div>
          <div class="form-group ">
            <label class="control-label " for="location">
              Location
            </label>
            <input class="form-control" id="location" name="location" type="text"/>
          </div>
          <div class="form-group ">
            <label class="control-label " for="company">
              Company
            </label>
            <input class="form-control" id="company" name="company" type="text"/>
          </div>
          <div class="form-group">
            <div>
              <button class="btn btn-success " name="submit" type="submit">
                Update Profile
              </button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>

</div>
