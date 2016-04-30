  <!-- FOOTER -->
  <footer class="footer-basic-centered">

    <div class="container">
      <p class="footer-links">
        <a href="#">Home</a>
        ·
        <a href="#">Blog</a>
        ·
        <a href="#">Pricing</a>
        ·
        <a href="#">About</a>
        ·
        <a href="#">Faq</a>
        ·
        <a href="#">API</a>
        .
        <a href="#">Contact</a>
        <a href="#"><span class="pull-right footer-company-name">BarterKings &copy; 2015</span></a>
      </p>


    </div>

  </footer>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
    <div class="modal-content">

    </div>
  </div>
</div>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- FOOTER -->
<script>
	var base_url = "<?php echo base_url()?>";
</script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>asset/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="<?php echo base_url('asset/js/vendor/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('asset/js/vendor/jasny-bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('asset/js/vendor/bootstrap-slider.js')?>"></script>
<script src="<?php echo base_url('asset/js/vendor/bootstrap-select.js')?>"></script>
<script src="<?php echo base_url('asset/js/vendor/bootstrap3-wysihtml5.all.js')?>"></script>
<script src="<?php echo base_url('asset/js/vendor/bootstrap-tagsinput.js')?>"></script>
<script src="<?php echo base_url('asset/js/vendor/bootstrap-image-gallery.main.min.js')?>"></script>
<script src="<?php echo base_url('asset/js/vendor/typehead.min.js')?>"></script>
<script src="<?php echo base_url('asset/js'); ?>/plugins.js"></script>
<script src="<?php echo base_url('asset/js'); ?>/main.js"></script>
<script src="<?php echo base_url('asset/js'); ?>/add-item.js"></script>
<script src="<?php echo base_url('asset/js'); ?>/items-functionalities.js"></script>

<script>
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
e=o.createElement(i);r=o.getElementsByTagName(i)[0];
e.src='//www.google-analytics.com/analytics.js';
r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
ga('create','UA-77164709-1');ga('send','pageview');
</script>

</body>
</html>
