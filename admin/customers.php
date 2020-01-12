<?php  include("../includes/header2.php"); ?>
<div class="content-wrapper">
  <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid 1px;">
    <h4>
      <b>Customers</b>
      <small>section</small>
    </h4>
    <ol class="breadcrumb">
      <b> <?php echo date('D, jS F Y') ;?></b>
    </ol>
  </section>

  <section class="content">
    <p>
      <btn class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_customer"><i class="fa fa-plus"> New</i>
      </btn>
      <a href="#" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</a>
    </p>

    <div class="modal fade" id="add_customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <form id="hl_form" method="post">
            <input type="hidden" id="form_name" name="form_name" value="add_customer" />
            <input type="hidden" id="edit_id" name="edit_id" value="0" />

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><strong>Add Driver</strong></h4>
            </div>
            <div class="modal-body">
              <div class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
                <i class="fa fa-fw fa-check-circle"></i>
                <strong> Success ! </strong> Data saved successfully.
              </div>
              <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
                <i class="fa fa-fw fa-times-circle"></i>
                <strong> Note !</strong> Data saving failed.
              </div>
              <div class="alert icon-alert with-arrow alert-light form-alter" role="alert" style="display:none;">

              </div>

              <div class="form-group row">
                <div class="form-group col-xs-6 required">
                  <label for="First Name.">First Name.</label>
                  <input type="text" id="fname" name="fname" class="form-control" />
                </div>
                <div class="form-group col-xs-6 ">
                  <label for="last name">Last Name</label>
                  <input type="text" id="lname" name="lname" class="form-control" />
                </div>

              </div>

              <div class="form-group row">
                <div class="form-group col-xs-6 ">
                  <label for="Email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" />
                </div>
                <div class="form-group col-xs-6">
                  <label for="Contact">Contact</label>
                  <input type="text" id="contact" name="contact" class="form-control" />
                </div>
                <div class="form-group col-xs-6">
                  <input type="hidden" id="customer_id" name="customer_id" class="form-control" />
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info btn-form-action btn-submit">Submit</button>
              <button type="button" class="btn btn-danger  btn-form-action btn-reset">Clear</button>
            </div>
          </form>

        </div>
      </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-col-danger">
          <div class="modal-header">
            <h4 class="modal-title" id="smallModalLabel"><b>Confirmation:</b></h4>
          </div>
          <div class="modal-body">
            <p> Do you want to <b> Delete </b> This Record ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-confirm-delete "> Confirm </button>
            <button type="button" class="btn btn-info btn-confirm-close" data-dismiss="modal"> Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="smallModalLabel">Info:</h4>
          </div>
          <div class="modal-body warning-modal-message">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-warning-close" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="box box primary" style="padding:1%;">
      <table id="example2" class="table table-bordered table-striped nowrap" style="width:100%">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Image</th>
            <th>Names</th>
            <th>Email</th>
            <th>Phone.</th>
            <th>User Since</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
        $sno = 1;
        $query = "SELECT * FROM users_details ORDER BY user_fname";
        $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
        while($row = mysqli_fetch_array($result)){
        ?>
          <tr>
            <td><?php echo $sno++; ?></td>
            <td><img style="display:block; border-radius:50%" width="30px" height="auto"
                src='<?php echo "../uploads/".$row['user_image'] ?>'></td>
            <td><?php echo $row['user_fname'] ." ".$row['user_lname']; ?></td>
            <td><?php echo $row['user_email'];?></td>
            <td><?php echo $row['user_contact'];?></td>
            <td><?php echo $row['user_since']; ?></td>
            <td text-align="center">
              <div class="form-group">
                <button type="button" class="btn btn-xs btn-info btn-edit" id="<?php echo $row['id']; ?>"
                  title="Edit details" data-target="#confirmModal">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-xs btn-danger btn-delete" id="<?php echo $row['id']; ?>"
                  title="Delete details" data-toggle="modal" data-target="#confirmModal">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
              </div>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
<?php  include("../includes/footer.php"); ?>

<script>
$(document).ready(function() {
  $('#example2').DataTable({
    "columnDefs": [{
        "width": "5%",
        "targets": 0
      },
      {
        "width": "5%",
        "targets": 1
      },
      {
        "width": "10%",
        "targets": 5
      },
      {
        "width": "10%",
        "targets": 6
      },
    ]
  });

  $("#hl_form").validate({
    rules: {
      fname: {
        required: true
      },
      lname: {
        required: true
      },
      email: {
        required: true
      },
      contact: {
        required: true
      }
    },
    messages: {
      fname: "Please enter First Name .",
      lname: "Please enter last Name ",
      email: "Please enter a valid Email",
      contact: "Please enter Contact"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  $(document).on('click', '.btn-submit', function(ev) {
    ev.preventDefault();
    var btn_button = $(this);
    if ($("#hl_form").valid() == true) {
      var data = $("#hl_form").serialize();
      btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> Processing...');
      btn_button.attr("disabled", true);
      $.post('save_customer.php', data, function(data, status) {
        console.log("Data: " + data + "\nStatus: " + status);
        if (data == "1") {
          $(".alert-danger").hide();
          $(".alert-success").fadeIn(800);
          btn_button.html('<i class="fa fa fa-check-circle"></i> Done');
          setTimeout(function() {
            location.reload();
          }, 2000);
        } else {
          $(".alert-success").hide();
          $(".alert-danger").fadeIn(800);
          btn_button.html('Submit').attr("disabled", false);
        }
      });
    }
  });
  $(document).on('click', '.btn-reset', function(ev) {
    ev.preventDefault();
    $("#form_name").val("add_customer");
    $("#edit_id").val('');
    $("#fname").val('').focus();
    $("#lname").val('');
    $('#email').val('');
    $("#contact").val('');
    $(".alert-light").hide();
    $(".dup - chek - details ").html('');
    $("label.error").hide('');
  });
  $(document).on('click', '.btn-edit', function(ev) {
    ev.preventDefault();
    var btn_button = $(this);
    btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> ');
    var tbl_id = $(this).attr("id");
    $('.btn-reset').trigger('click');
    $.ajax({
      cache: false,
      url: 'get_customer_info.php', // url where to submit the request
      type: "GET", // type of action POST || GET
      dataType: 'json', // data type
      data: {
        cmd: "edit_customer",
        tbl_id: tbl_id
      }, // post data || get data
      success: function(result) {
        btn_button.html(' <i class="fa fa fa-pencil-square-o"></i> ');
        console.log(result);
        $("#add_customer").modal("show");
        $("#form_name").val("edit_customer");
        $("#edit_id").val(result['id']);
        $("#fname").val(result['user_fname']).focus();
        $("#lname").val(result['user_lname']);
        $("#email").val(result['user_email']);
        $("customer_id").val(result['id']);
        $("#contact").val(result['user_contact']).change();
      },
      error: function(xhr, resp, text) {
        console.log(xhr, resp, text);
      }
    });
  });
  $(document).on('click', '.btn-confirm-delete', function(ev) {
    ev.preventDefault();
    var btn_button = $(this);
    var tbl_id = $('.btn-confirm-delete').attr("id");
    $('#confirmModal').modal('hide');

    $.post('save_customer.php', {
      form_name: "del_user",
      tbl_id: tbl_id
    }, function(data, status) {
      console.log(data);
      if (data == "1") {
        btn_button.html('<i class="fa fa fa-check-circle "></i> Done');
        $('.warning-modal-message').html("This details deleted successfully.");
        $('#warningModal').modal('show');
        setTimeout(function() {
          location.reload();
        }, 1500);
      } else if (data == "404-del") {
        $('.warning-modal-message').html(
          "This details reflect in another record. So you can't delete !!!");
        $('#warningModal').modal('show');
      } else {
        $('.warning-modal-message').html("Data deletion failed.");
        btn_button.html('Yes');
      }
    });
  });

  $(document).on('click', '.btn-delete', function(ev) {
    ev.preventDefault();
    $(".btn-confirm-delete").attr("id", $(this).attr('id'));
  });

  $(document).on('click', '.btn-confirm-close', function(ev) {
    ev.preventDefault();
    $(".btn-confirm-delete").attr("id", "0");
  });


})
</script>