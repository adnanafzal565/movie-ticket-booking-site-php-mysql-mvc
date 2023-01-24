<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 29/04/2018
 * Time: 8:08 AM
 */
?>

<!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= date("Y"); ?> <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="fa fa-heart" style="color: red;"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

    <script src="<?= ADMIN_VENDOR; ?>js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= ADMIN_VENDOR; ?>chart.js/Chart.min.js"></script>
    <script src="<?= ADMIN_VENDOR; ?>moment/moment.min.js"></script>
    <script src="<?= ADMIN_VENDOR; ?>daterangepicker/daterangepicker.js"></script>
    <script src="<?= ADMIN_VENDOR; ?>chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= ADMIN_JS; ?>off-canvas.js"></script>
    <script src="<?= ADMIN_JS; ?>misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- <script src="<?= ADMIN_JS; ?>dashboard.js"></script> -->
    <script src="<?= JS; ?>script.js?v=<?= time(); ?>"></script>
    <script src="<?= JS; ?>sweetalert.min.js"></script>
    <!-- End custom js for this page -->

    <script src="<?= PUBLIC_PATH; ?>datetimepicker/jquery.datetimepicker.full.js"></script>
    <script src="<?= PUBLIC_PATH; ?>datatable/datatables.js"></script>

    <script src="<?= PUBLIC_PATH; ?>chartjs/Chart.js"></script>

    <script>
        $(function () {
            var inputTypeNumbers = document.querySelectorAll("input[type=number]");
            for (var a = 0; a < inputTypeNumbers.length; a++) {
                inputTypeNumbers[a].onwheel = function (event) {
                    event.target.blur();
                };
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
  </body>
</html>
