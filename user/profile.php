<?php
    include("../includes/header.php");
    $query = $DBcon->query("SELECT * FROM users_details WHERE user_code ='$eid'");
    $row = $query->fetch_array();
    $userPicture = !empty($row['user_image'])?$row['user_image']:'no-image.png';
    $user_image_url = '../uploads/'.$userPicture;
?>

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
          <div class="box box-primary">
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
                <iframe id="uploadTarget" name="uploadTarget" src="#" style="width:0;height:0;border:0 :solid #fff;"></iframe>
                                     <!-- Image update link -->
                  <a class="editLink" href="javascript:void(0);"><img src="../images/edit.png"/></a>
                         <!-- Profile image -->
                  <img src="<?php echo  $user_image_url ; ?>" id="imagePreview" style ="height: 200px;" >
              </div>
              <div class="name">
                    <h4 class="text-center"><?php echo $row['user_fname']."  ".$row['user_lname']; ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><b><?php echo $row['user_fname'] ."   " .$row['user_lname'] ;?></b></h3>
            </div>
            <div class="panel-body">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td><strong>Role</strong></td>
                      <td><?php echo $row['user_role'];?></td>
                    </tr>
                    <tr>
                      <td><strong>User Since</strong></td>
                      <td><?php echo $row['user_since'];?></td>
                    </tr>
                    <tr>
                      <td><strong>Email</strong></td>
                      <td><?php echo $row['user_email'];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
        </div>

      <div class="col-md-5">
        <div class="panel panel-info">
          <div class="panel-heading">
             <h3 class="panel-title"><b> Recent Requests</b></h3>
          </div>
          <div class="panel-body">
             <table class="table table-user-information">
                <tbody>
                  <?php
                    $qry = "SELECT * FROM users_bookings WHERE customer ='$eid' ORDER BY book_date DESC LIMIT 10";
                    $result = mysqli_query($DBcon,$qry) or die(mysqli_error($DBcon));
                    if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result)){
                  ?>
                  <tr>
                     <td><?php echo $row['book_date']; ?></td>
                     <td><?php echo $row['bus_time']; ?></td>
                    <td><?php echo $row['bus_route']; ?></td>
                  </tr>
                  <?php }} else echo "No activity !" ;?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
  </div>
  </section>
  </div>
  <?php  include("../includes/footer.php"); ?>
