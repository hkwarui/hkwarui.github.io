<?php
include("../includes/header2.php");
?>
<div class="content-wrapper">
    <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px;">
      <h4>
        <b>Passager</b>
        <small>self service</small>
      </h4>
    </section>
    <section class="content">

    <p><btn class ="btn btn-info btn-sm" data-toggle="modal" data-target="#add_booking"><i class="fa fa-plus"> New</i></btn>
     <a href="#" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</a> </p>

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
          <td><?php echo $row['driver_id']; ?></td>
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
  })
</script>
