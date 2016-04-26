
    <div class="col-md-3 thumbnail">
       <div class="progress hide">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                <span class="sr-only">0% Complete</span>
            </div>
        </div>


        <span class="profile-picture">
            <img src="<?php echo base_url('asset/img/profiles_thumbs'); ?>/<?php echo $user[0]['profile_img_thumb']; ?>" alt="" class="img-responsive" />
        </span>
        <?php if(isset($is_logged_in) && $is_logged_in === true): ?>
            <form id="upload-profile-img-form" action="account/upload" method="POST" accept-charset="utf-8">
                <span class="btn btn-info btn-file btn-block">
                    Browse <input accept="image/x-png, image/gif, image/jpeg" type="file" id="profile-img" name="profile_image">
                </span>
                <button id="upload-profile-img-btn" class="form-control btn btn-success btn-sm btn-block">Upload Profile</button>
            </form>
        <?php else: ?>
         <button style="margin-top: 10px;" data-url="message/create" data-account-id="<?php echo $user[0]['id']?>" class="pop-modal form-control btn btn-success btn-sm btn-block">Send Message</button> 
        <?php endif; ?>

    </div>

    <div class="col-md-9">
        <h3><?php echo $user[0]['username']; ?></h3><hr>
        <small>
            <cite title="San Francisco, USA">San Francisco, USA
                <i class="glyphicon glyphicon-map-marker">
                </i>
            </cite>
        </small>

    </div>
