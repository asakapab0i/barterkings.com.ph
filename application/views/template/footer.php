<!-- Content End -->
</div>

  <!-- FOOTER -->
  <footer class="footer-basic-centered">

    <div class="">
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
        .
        <a href="#">Contact</a>
        <a href="#"><span class="pull-right footer-company-name">&copy; 2015</span></a>
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

<?php if(ENVIRONMENT == 'production'): ?>
	<script>

  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('location')),
      {types: ['geocode']});

      // When the user selects an address from the dropdown, populate the address
      // fields in the form.
      autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
      // Get the place details from the autocomplete object.
      var place = autocomplete.getPlace();

      for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
      }

      // Get each component of the address from the place details
      // and fill the corresponding field on the form.
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          document.getElementById(addressType).value = val;
        }
      }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy
          });
          autocomplete.setBounds(circle.getBounds());
        });
      }
    }

</script>
  <script src="<?php echo base_url('asset/dist/js/production.js')?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg4wlVCRSetZ8v8L9EGtetzCDrTshFMOY&libraries=places&callback=initAutocomplete" async defer></script>
  <!-- Go to www.addthis.com/dashboard to customize your tools -->
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-573353641a43b50a"></script>
<?php else: ?>

  <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>asset/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg4wlVCRSetZ8v8L9EGtetzCDrTshFMOY&libraries=places&callback=initAutocomplete" async defer></script>

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/typehead.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/normalize.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/slider.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-select.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-image-gallery.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-image-gallery.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/main.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/style.css">

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
  <script src="<?php echo base_url('asset/js'); ?>/vendor/modernizr-2.6.2.min.js"></script>
  <script src="<?php echo base_url('asset/js'); ?>/google-locations.js">
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-573353641a43b50a"></script>
<?php endif;?>

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
