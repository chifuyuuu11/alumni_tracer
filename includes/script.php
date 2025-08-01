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
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
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

  $('.form').on("submit", function (event) {
    $(".card").append('<div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div></div>');
  });

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

  //mema lolers
  function programSelect() {
    var dept_id = $('#attained option:selected').attr("class");
    var xhttp = new XMLHttpRequest();

    xhttp.open('GET', '../registration/usersData/ctrl.ajax.php?dept_id=' + dept_id);

    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var result = JSON.parse(this.responseText);
        var html = `<option value="" class="0" disabled selected>Select Program</option>`;
        for (var i in result) {
          html += `
            <option class="${result[i].dept_id}" value="${result[i].program_id}">${result[i].program_desc}</option>
            `;
        }

        document.getElementById('program').innerHTML = html;
      }
    }

    xhttp.send();
  }
  
  function programSelect1() {
    var dept_id = $('#attained option:selected').attr("class");
    var xhttp = new XMLHttpRequest();

    xhttp.open('GET', '../registration/usersData/ctrl.ajax.php?dept_id=' + dept_id);

    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var result = JSON.parse(this.responseText);
        var html = `<option value="" class="0" disabled selected>Select Program</option>
        <option value="All">All</option>
        `;
        for (var i in result) {
          html += `
            <option class="${result[i].dept_id}" value="${result[i].program_desc}">${result[i].program_desc}</option>
            `;
        }

        document.getElementById('program').innerHTML = html;
      }
    }

    xhttp.send();
  }

  function checkEmail() {
    var email = $('#email').val();
    var regex = /^[a-z0-9]+@[a-z]+\.[a-z]{2,3}$/;
    if (regex.test(email)) {
      var xhttp = new XMLHttpRequest();

      xhttp.open('GET', 'usersData/ctrl.ajax.php?email=' + email);

      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var result = parseInt(this.responseText);
          if (result > 0) {
            $('#submit').prop("disabled", true);
            $('#message').append("Email already registered.");
            $('#email').addClass("is-invalid");
          } else {
            $('#submit').prop("disabled", false);
            $('#message').text('');
            $('#email').removeClass("is-invalid");
          }
        }
      }

      xhttp.send();
    }

  }
  var dept = $('#attained option:selected').attr("class");

  if (dept == 1 || dept == 2 || dept == 3) {
    $('#program').prop("disabled", true);
  } else {
    $('#program').prop("disabled", false);
  }


  //for attained, disables program select
  //down side needs revision kapag may binago sa program
  $('#attained').change(function () {
    var dept = $('#attained option:selected').attr("class");
    if (dept == 1 || dept == 2 || dept == 3) {
      $('#program').prop("disabled", true);
    } else {
      $('#program').prop("disabled", false);
    }
  });
  
  var dept = $('#department').val();

    $('.form-check-input').each(function () {
      if ($(this).hasClass(dept)) {
        $(this).prop("disabled", false);
      } else {
        $(this).prop("disabled", true);
        $(this).prop("checked", false);
      }
    })

  $('#department').change(function () {
    var dept = $('#department').val();

    $('.form-check-input').each(function () {
      if ($(this).hasClass(dept)) {
        $(this).prop("disabled", false);
      } else {
        $(this).prop("disabled", true);
        $(this).prop("checked", false);
      }
    })

  });

  //mema effect
  $(".alumni").mouseover(function () {
    $(this).addClass("shadow-lg");
    $(this).css("transform", "scale(1.009)");
  });
  $(".alumni").mouseout(function () {
    $(this).removeClass("shadow-lg");
    $(this).css("transform", "scale(1.00)");
  });

  <?php
  if (isset($_SESSION['success'])) {
    ?>
    $(function () {
      toastr.success("Successfully added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['username_exist'])) {
    ?>
    $(function () {
      toastr.error("Username already exists.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['deleted'])) {
    ?>
    $(function () {
      toastr.success("Successfully deleted!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['email_update'])) {
    ?>
    $(function () {
      toastr.success("Successfully updated! <p><strong> Please check your email.</strong></p>", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['updated'])) {
    ?>
    $(function () {
      toastr.success("Successfully updated!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['error_update'])) {
    ?>
    $(function () {
      toastr.error("Update error.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['alumni_info_updated'])) {
    ?>
    $(function () {
      toastr.success("Successfully updated alumni info!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['error_alumni_info_update'])) {
    ?>
    $(function () {
      toastr.error("Update error.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['role'])) {
    ?>
    $(function () {
      toastr.success("Role added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['role_exist'])) {
    ?>
    $(function () {
      toastr.error("Role already exist.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['campus'])) {
    ?>
    $(function () {
      toastr.success("Campus added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['work'])) {
    ?>
    $(function () {
      toastr.success("Work added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['campus_exist'])) {
    ?>
    $(function () {
      toastr.error("Campus already exist.", 'Error')
    });
    <?php

  } elseif (isset($_SESSION['level'])) {
    ?>
    $(function () {
      toastr.success("Grade level added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['level_exist'])) {
    ?>
    $(function () {
      toastr.error("Grade level already exists.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['program'])) {
    ?>
    $(function () {
      toastr.success("Program added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['program_exist'])) {
    ?>
    $(function () {
      toastr.error("Program already exist.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['civilstat'])) {
    ?>
    $(function () {
      toastr.success("Civil Status added!", 'Success')

    });
    <?php
  } elseif (isset($_SESSION['civilstat_exist'])) {
    ?>
    $(function () {
      toastr.error("Civil Status already exist.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['work_exist'])) {
    ?>
    $(function () {
      toastr.error("Work already exist.", 'Error')

    });
    <?php
  } elseif (isset($_SESSION['aftergrad'])) {
    ?>
    $(function () {
      toastr.success("Life After Graduation added!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['aftergrad_exist'])) {
    ?>
    $(function () {
      toastr.error("Entered Life After Graduation already exist.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['email'])) {
    ?>
    $(function () {
      toastr.success("Please check your email.", 'Email Sent!')
    });
    <?php
  } elseif (isset($_SESSION['success_admit'])) {
    ?>
    $(function () {
      toastr.success("Successfully admitted", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['department'])) {
    ?>
    $(function () {
      toastr.success("Department successfully added", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['department_exist'])) {
    ?>
    $(function () {
      toastr.error("Department already exist.", 'Error')

    });
    <?php
  } elseif (isset($_SESSION['img'])) {
    ?>
    $(function () {
      toastr.success("Photo uploaded!", 'Success')
    });
    <?php
  } elseif (isset($_SESSION['username&email_exist'])) {
    ?>
    $(function () {
      toastr.error("Username and Email already exists.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['email_exist'])) {
    ?>
    $(function () {
      toastr.error("Email already exists.", 'Error')
    });
    <?php
  } elseif (isset($_SESSION['success_register'])) {
    ?>
    $(function () {
      toastr.success('Please wait for an email to confirm your request', 'Registration Success');
    });
    <?php
  } elseif (isset($_SESSION['school_exist'])) {
    ?>
    $(function () {
      toastr.error("School already exists.", 'Error')
    });
    <?php
  } 

  unset($_SESSION['success']);
  unset($_SESSION['username_exist']);
  unset($_SESSION['alumni_info_updated']);
  unset($_SESSION['error_alumni_info_update']);
  unset($_SESSION['deleted']);
  unset($_SESSION['updated']);
  unset($_SESSION['email_update']);
  unset($_SESSION['error_update']);
  unset($_SESSION['role']);
  unset($_SESSION['role_exist']);
  unset($_SESSION['level']);
  unset($_SESSION['level_exist']);
  unset($_SESSION['campus']);
  unset($_SESSION['work']);
  unset($_SESSION['work_exist']);
  unset($_SESSION['campus_exist']);
  unset($_SESSION['program']);
  unset($_SESSION['program_exist']);
  unset($_SESSION['civilstat']);
  unset($_SESSION['civilstat_exist']);
  unset($_SESSION['aftergrad']);
  unset($_SESSION['aftergrad_exist']);
  unset($_SESSION['email']);
  unset($_SESSION['success_admit']);
  unset($_SESSION['department']);
  unset($_SESSION['department_exist']);
  unset($_SESSION['img']);
  unset($_SESSION['username&email_exist']);
  unset($_SESSION['email_exist']);
  unset($_SESSION['success_register']);
  unset($_SESSION['school_exist']);
  ?>

</script>