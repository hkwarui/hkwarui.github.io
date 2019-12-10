<?php
include("../includes/header.php");
?>
<div class="content-wrapper">
    <section class="content-header" style="background-color: #fbfbfb; padding: 2px; border-bottom:solid:2px;">
      <h4>
        <b>Customer</b>
        <small>self service</small>
      </h4>
    </section>

    <section class="content">

        <p><btn class ="btn btn-info btn-sm" data-toggle="modal" data-target="#add_booking"><i class="fa fa-plus"> New</i></btn>
      <a href="#" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</a> </p>

                  <!-- Modal -->
        <div class="modal fade" id="add_booking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">

        <form id="hl_form" method="post">
          <input type="hidden" id="form_name" name="form_name" value="add_user" />
          <input type="hidden" id="edit_id" name="edit_id" value="0" />

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><strong>New Booking</strong></h4>
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
            <div class="form-group col-xs-3 required">
                <label for="Date">Date</label>
                <input type="text" id="date" name="date" class="form-control" placeholder="select date" required="required" />
            </div>
            <div class="form-group col-xs-3 required">
                <label for="route">Route</label>
                <select class="form-control selectpicker show-tick" id="route" name="route" data-live-search="true"  required="required"> <option value="">-- select --</option>
                  <?php
                    $query = "SELECT * FROM routes ORDER BY bus_time";
                     $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
                     while($row = mysqli_fetch_array($result)){ ?>
                    <option value="<?php echo $row['route'] ; ?>"><?php echo $row['route']; ?></option>
                 <?php } ?>
                </select>
            </div>
            <div class="form-group col-xs-3 required">
                  <label for="Time">Time</label>
                   <select class="form-control selectpicker show-tick" id="bus_time" name="bus_time" data-live-search="true"  required="required">
                 <option value = ""> --Select-- </option>
                 </select>
            </div>
             <div  class="form-group col-xs-3 required">
                <input type="hidden" id="charges" name="charges" class="form-control"  />
            </div>
            </div>
            
        </div> 

<div class="clearfix"></div>
<div class="modal-footer">
  <button type="button" class="btn btn-info btn-form-action btn-submit">Submit</button>
  <button type="button" class="btn btn-danger btn-form-action btn-reset">Clear</button>
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
        <button type="button" class="btn btn-info btn-confirm-close" data-dismiss="modal"> Close </button>
      </div>
   </div>
  </div>
</div>


<!-- Small Size -->
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

        <!-- bookings table -->

    <div class="box box primary" style="padding:1%;">
    <table id="example2"  class="table table-bordered table-striped nowrap" style="width:100%">
      <thead>
        <tr>
          <th>S.No</th>
          <th>Bus Reg.</th>
          <th>Date</th>
          <th>Time</th>
          <th>Route</th>
          <th>Driver</th>
          <th>Payment</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
       <?php
        $sno = 1;
        $query = "SELECT * FROM users_bookings ORDER BY bus_time";
        $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
        while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
          <td><?php echo $sno++; ?></td>
          <td><?php echo $row['bus_reg']; ?></td>
          <td><?php echo $row['book_date'];?></td>
          <td><?php echo $row['bus_time']; ?></td>
          <td><?php echo $row['bus_route']; ?></td>
          <td><?php echo $row['bus_driver']; ?></td>
          <td><?php echo $row['payments']; ?></td>
          <td text-align="center">
          <div class="form-group">
          <button type="button" class="btn btn-xs btn-info btn-edit" id="<?php echo $row['id']; ?>" title="Edit details"  data-target="#confirmModal" >
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-xs btn-danger btn-delete" id="<?php echo $row['id']; ?>" title="Delete details" data-toggle="modal" data-target="#confirmModal" >
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

<?php
include("../includes/footer.php");
?>
 <script>
  $(document).ready(function()  {
    $('#example2').DataTable({
    });
   $('#date').datepicker({
       minDate: new Date()
  });
  $('#route').change(function(){
     var routeId = $(this).val();
     $('#bus_time').find('option').not(':first').remove();
     $.ajax({
       url: 'ajax_booking.php',
       type: 'post',
       data: {request: 1, routeId : routeId },
       dataType: 'json',
       success: function(response){
         var len = response.length;
         var price = response.price;
         for( var i = 0; i<len; i++){
           var id = response[i]['id'];
           var bus_time = response[i]['bus_time'];
           $("#bus_time").append("<option value='"+bus_time+"'>"+bus_time+"</option>");
         }
       }
      })
     });

     $('#bus_time').change(function(e){
         e.preventDefault();
         var busTime = $(this).val();
        $.ajax({
        url: 'ajax_booking.php',
        type: 'post',
        data: {request: 2, busTime : busTime},
        dataType: 'json',
        success: function(response){
           var len = response.length;
           var price = response[0]['price'];
           var bus_reg = response[0]['bus_reg'];
           $("#charges").val(price);
           $(".alert-danger").hide();
           $(".alert-success").hide();
           $(".alert-light").html("<h3 class='text-center'><strong> Charges:  KES "+  price + " /= </strong></h3>");
           $(".alert-light").show();
       }
      })      
     });
  
    $("#hl_form").validate({
      // Specify the validation rules
      rules: {
        route: {
          required: true
        },
        date: {
          required: true
        },
        bus_time: {
          required: true
        }

      },
      // Specify the validation error messages
      messages: {
        route: "Please select route",
        date: "Please select date",
        bus_time: "Please select time to see charges"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });

      $(document).on('click', '.btn-submit', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      if($("#hl_form").valid() == true){
        var data = $("#hl_form").serialize();
        btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> Processing...');
        btn_button.attr("disabled",true);
        $.post('save_booking.php', data, function(data, status){
          console.log("Data: " + data + "\nStatus: " + status);
          if( data == "1"){
            $(".alert-danger").hide();
            $(".alert-success").fadeIn(800);
            btn_button.html('<i class="fa fa fa-check-circle"></i> Done');
            setTimeout(function(){  location.reload(); }, 2000);
          }
          else{
            $(".alert-success").hide();
            $(".alert-danger").fadeIn(800);
            btn_button.html('Submit').attr("disabled",false);
          }
        });
      }
    });

    $(document).on('click', '.btn-reset', function(ev){
      ev.preventDefault();
      $("#form_name").val("add_user");
      $("#edit_id").val('');
      $("#route").val('');
      $('#bus_time').val('');
      $("#date").val('').focus();
      $(".alert-light").hide();
      $(".dup-chek-details").html('');
      $("label.error").hide('');
    });

    $(document).on('click', '.btn-edit', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      btn_button.html(' <i class="fa fa fa-spinner fa-spin"></i> ');
      var tbl_id = $(this).attr("id");
      $('.btn-reset').trigger('click');
      $.ajax({
        cache: false,
        url: 'get_ajax_bookings.php', // url where to submit the request
        type : "GET", // type of action POST || GET
        dataType : 'json', // data type
        data : { cmd: "edit_booking.", tbl_id: tbl_id }, // post data || get data
        success : function(result) {
        btn_button.html(' <i class="fa fa fa-pencil-square-o"></i> ');
        console.log(result);
        $("#add_booking").modal("show");
        $("#form_name").val("edit_user");
        $("#edit_id").val(result['id']);
        $("#date").val(result['book_date']);
        $("#bus_time").val(result['bus_time']);
        $("#route").val(result['bus_route']).change();
        $("#charges").val(result['payments'])
        $(".alert-light").html("<h4 class='text-center'><strong> Charges:  KES "+ result['payments']  + " /= </strong></h4>");
        $(".alert-light").show();
        },
        error: function(xhr, resp, text) {
        console.log(xhr, resp, text);
        }
      });
    });

     $(document).on('click', '.btn-confirm-delete', function(ev){
      ev.preventDefault();
      var btn_button = $(this);
      var tbl_id = $('.btn-confirm-delete').attr("id");
      $('#confirmModal').modal('hide');

      $.post('save_booking.php', { form_name: "del_user", tbl_id: tbl_id }, function(data,status){
        console.log(data);
        if(data == "1"){
          btn_button.html('<i class="fa fa fa-check-circle "></i> Done');
          $('.warning-modal-message').html("This details deleted successfully.");
          $('#warningModal').modal('show');
          setTimeout(function(){  location.reload(); }, 1500);
        }
        else if(data == "404-del"){
          $('.warning-modal-message').html("This details reflect in another record. So you can't delete !!!");
          $('#warningModal').modal('show');
        }
        else{
          $('.warning-modal-message').html("Data deletion failed.");
          btn_button.html('Yes');
        }
      });
    });

    $(document).on('click', '.btn-delete', function(ev){
      ev.preventDefault();
      $(".btn-confirm-delete").attr("id",$(this).attr('id'));
    });

    $(document).on('click', '.btn-confirm-close', function(ev){
      ev.preventDefault();
      $(".btn-confirm-delete").attr("id","0");
    });

  });
</script>
