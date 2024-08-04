<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>

<script>
  $(function () {
  bsCustomFileInput.init();
});
      $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
        });
  $(function () {
    $("#example1").DataTable({
      "paging": true, 
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example4').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(function() {

  });

  <?php
  if (isset($_SESSION['success'])){
    ?>
    $(function() {
      toastr.success("Successfully added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['username_exist'])) {
    ?>
    $(function() {
      toastr.error("Username already exists.", 'Error')
    });
  <?php
  } elseif (isset($_SESSION['deleted'])){
    ?>
    $(function() {
      toastr.success("Successfully deleted!", 'Success')
    });
  <?php
  } elseif (isset($_SESSION['updated'])){
    ?>
    $(function() {
      toastr.success("Successfully updated!", 'Success')
    });
  <?php
  } elseif (isset($_SESSION['error_update'])) {
    ?>
    $(function() {
      toastr.error("Update error.", 'Error')
    });
  <?php
  } elseif (isset($_SESSION['role'])){
    ?>
    $(function() {
      toastr.success("Role added!", 'Success')
    });
  <?php
  } elseif (isset($_SESSION['role_exist'])){
    ?>
    $(function() {
      toastr.error("Role already exist.", 'Error')
    });
  <?php
  } elseif (isset($_SESSION['campus'])){
    ?>
    $(function() {
      toastr.success("Campus added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['work'])){
    ?>
    $(function() {
      toastr.success("Work added!", 'Success')
    });
  <?php
  } elseif (isset($_SESSION['campus_exist'])){
    ?>
    $(function() {
      toastr.error("Campus already exist.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['work_exist'])){
    ?>
    $(function() {
      toastr.error("Work already exist.", 'Error')
    });
  <?php
  } elseif (isset($_SESSION['email'])){
    ?>
    $(function() {
      toastr.success("Please check your email.", 'Email Sent!')
    });
  <?php
  } elseif (isset($_SESSION['success_admit'])){
    ?>
    $(function() {
      toastr.success("Successfully admitted", 'Success')
    });
  <?php
  } elseif (isset($_SESSION['invalid_otp'])){
    ?>
    $(function() {
      toastr.error("Invalid OTP!", 'Error')
    });
  <?php
  }
  
  
  

  unset($_SESSION['success']);
  unset($_SESSION['username_exist']);
  unset($_SESSION['deleted']);
  unset($_SESSION['updated']);
  unset($_SESSION['error_update']);
  unset($_SESSION['role']);
  unset($_SESSION['role_exist']);
  unset($_SESSION['campus']);
  unset($_SESSION['work']);
  unset($_SESSION['work_exist']);
  unset($_SESSION['campus_exist']);
  unset($_SESSION['email']);
  unset($_SESSION['success_admit']);
  unset($_SESSION['invalid_otp']);
  ?>
    

</script>