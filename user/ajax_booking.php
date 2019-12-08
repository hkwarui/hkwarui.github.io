<?php
require_once('../includes/Dbconnect.php');
$request = $_POST['request'];
//$request = 2;


if($request == 1){
  //$routeId = 'kariobangi';
  $routeId = $_POST['routeId'];
  $response = array();
  $query = "SELECT * FROM bus_timing  WHERE route_Id = '$routeId'";
  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
   while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $response[] = array ('id'=> $row['id'],
                              'bus_time' =>$row['bus_time'],
                              'price' => $row['price'],
                              'bus_reg'=>$row['bus_reg']);
  }
  
  echo json_encode($response);
  exit;
}

if($request == 2){
  //$routeId = 'kariobangi';
  $busTime = $_POST['busTime'];

  $response = array();
  $query = "SELECT bus_reg ,price FROM bus_timing  WHERE  bus_time = '$busTime'";
  $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
   $row = $result->fetch_array() ;
   $count = $result->num_rows;
     if($count == 1) {
        $response[] = array ('price' => $row['price'],
                            'bus_reg'=>$row['bus_reg']);
     } else {
       $response[] = array(  'price' => 'No Buses Available at this hour!');
     }
          
  echo json_encode($response);
  exit;
}

?>
