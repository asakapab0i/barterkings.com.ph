<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="">
                <div class="row">
                    <div class="col-sm-6 col-md-5">
                        <img src="http://placehold.it/380x500" alt="" class="img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-7">
                        <h3>Bhaumik Patel</h3><hr>
                        <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>email@example.com
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                            <!-- Split button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">
                                    Social</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span><span class="sr-only">Social</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Twitter</a></li>
                                        <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                        <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Github</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                  <div class="page-header">
                    <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo '';//$offers_count; ?></span> offers</small> Offers 
                    </h1>
                </div> 
                <div data-itemid = "" class="offers-list reload-offers">
                    <?php $this->load->view('template/offers-template');?>
                </div>

            </div>
        </div>
        <div class="row">
            <h1><small class="pull-right">45 items</small> Items</h1><hr>
            <?php $this->load->view('template/profile-items-template.php'); ?>
        </div>
    </div>
