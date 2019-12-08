<?php
    include("../includes/header.php");
    $query = $DBcon->query("SELECT * FROM users_details WHERE user_code ='$eid'");
    $row = $query->fetch_array();
    $userPicture = !empty($row['user_image'])?$row['user_image']:'no-image.png';
    $user_image_url = '../uploads/'.$userPicture;
?>
<link rel="stylesheet" type="text/css" href="../dist/css/profile_style.css">
<div class="content-wrapper">
    <section class="content-header" style="background-color: #fbfbfb; padding: 5px; border-bottom:solid:2px;">
      <h4>
        <b>Passager</b>
        <small>self service</small>
      </h4>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-info">
            <div class="user-box">
              <div class="img-relative">
                             <!-- Loading image -->
                <div class="overlay uploadProcess" style="display: none;">
                  <div class="overlay-content"><img src="../images/loading.gif"/></div>
                </div>
                              <!-- Hidden upload form -->
                <form method="post" action="../upload.php" enctype="multipart/form-data" id="picUploadForm" target="uploadTarget">
                   <input type="file" name="picture" id="fileInput"  style="display:none"/>
                </form>
                 <iframe id="uploadTarget" name="uploadTarget" src="#" style="width:0;height:0;border:0 :solid #fff;display:none"></iframe> 
                                     <!-- Image update link -->
                  <a class="editLink" href="javascript:void(0);"><img src="../images/edit.png"/></a>
                         <!-- Profile image -->
                  <img src="<?php echo  $user_image_url ; ?>" id="imagePreview" style ="height:200px;" >
              </div>
             
            </div>
          </div>
        </div>
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-info">
          <div class="panel-heading">
             <h3 class="panel-title"><b> Recent Bookings</b></h3>
          </div>
          <div class="panel-body">
             <table class="table table-user-information">
                <thead>
                  <th><b>Date</b></th>
                  <th><b>Time</b></th>
                  <th><b>Route</b></th>
                </thead>
                <tbody>
                  <?php
                    $qry = "SELECT * FROM users_bookings WHERE customer ='$eid' ORDER BY book_date DESC LIMIT 10";
                    $result = mysqli_query($DBcon,$qry) or die(mysqli_error($DBcon));
                    if(mysqli_num_rows($result)>0){
                    while($row1 = mysqli_fetch_array($result)){
                  ?>
                  <tr>
                     <td><span class="label label-warning" ><?php echo $row1['book_date']; ?></span></td>
                     <td><span class="label label-success" ><?php echo $row1['bus_time']; ?></span></td>
                    <td><span class="label label-info" ><?php echo $row1['bus_route']; ?></span></td>
                  </tr>
                  <?php }} else echo "No activity !" ;?>
                </tbody>
              </table>
          </div>
        </div>
      </div> 
      </div>

      <div class ="row">
      <div class="col-md-3">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><b><?php echo $row['user_fname'] ."   " .$row['user_lname'] ;?></b></h3>
            </div>
            <div class="panel-body">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td><strong>Role : </strong></td>
                      <td><?php echo $row['user_role'];?></td>
                    </tr>
                    <tr>
                      <td><strong>User Since : </strong></td>
                      <td><?php echo $row['user_since'];?></td>
                    </tr>
                    <tr>
                      <td><strong>Email: </strong></td>
                      <td><?php echo $row['user_email'];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
      </div>

  </div>
  </section>
  </div>
  <?php  include("../includes/footer.php"); ?>

  <script type="text/javascript">
$(document).ready(function () {
    //If image edit link is clicked
    $(".editLink").on('click', function(e){
        e.preventDefault();
        $("#fileInput:hidden").trigger('click');
    });

    //On select file to upload
    $("#fileInput").on('change', function(){
        var image = $('#fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    //validate file type
        if(!img_ex.exec(image)){
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput').val('');
            return false;
        }else{
            $('.uploadProcess').show();
            $('#uploadForm').hide();
            $( "#picUploadForm" ).submit();
        }
    });
});

//After completion of image upload process
function completeUpload(success, fileName) {
  if(success == 1){
    $('#imagePreview').attr("src", "");
    $('#imagePreview').attr("src", fileName);
    $('#fileInput').attr("value", fileName);
    $('.uploadProcess').hide();
    location.reload();
  }else{
    $('.uploadProcess').hide();
    alert('There was an error during file upload!');
  }
  return true;
}
</script>
