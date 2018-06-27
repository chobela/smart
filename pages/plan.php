<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
include("../classes/Menu.php");
include("Money.php");
session_start();
$link = $_SERVER['PHP_SELF']; 




if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['usergroup']) && !isset ($_SESSION ['firstname'])   && !isset ($_SESSION ['email'])) {

 header('Location:../login.php');

} else

if ($_SESSION ['usergroup'] != '1') {

 header('Location:user.php');

} 

$uid = $_GET['uid'];

$sql = "SELECT * FROM transactions WHERE uid = '$uid'";
 
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);

$name = $_SESSION ['firstname'];
$menu = new Menu;
$money = new Money;
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Easy Bills</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


<?php
 include("../includes/header.php");
 include("../includes/sidebar.php");
?>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> <?php echo $nname; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Subscriptions</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
     
      


 <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">All Transactions</h3>

                <div class="card-tools">

                <button type="button" class="btn btn-block btn-default btn-flat">Add new plan</button>
                 
                </div>
              </div>
             

 <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Transaction ID</th>
                      <th>Service Request</th>
                      <th>Cost of service</th>
                      <th>Date of Request</th>
                      <th>Aproved date</th>
                      <th>Status</th>
                      <th>Debt due to us</th>
                      <th>Service Plan</th>
                    </tr>
                    </thead>
                   
                <tbody>
                
	<?php 

 if ($countt > 0) {

              while ($row = mysqli_fetch_array($res)) { $tid = $row['uid'];?>

    <tr>
        <td><a href="pages/examples/invoice.html"><?php echo $row['transaction_id'];?></a></td>
 	<td><?php echo $row['service'];?></td>
	<td>K <?php echo number_format($row['amount'],2);?></td>
	<td><?php echo $row['request_date'];?></td>
        <td><?php echo $row['aproved_date'];?></td>
<?php

$status = $row ['status'] ;

  if ($status == 1) {
						$css = "badge-danger" ;
				}
				elseif($status == 2) {
						$css = "badge-success" ;
}

?>

	<td><span class="badge <?php echo $css; ?>"><?php echo $row['status_type'];?></span></td>



        <td><?php 

$days = $row['days'];

if ($days <= 30) {

$debt = (($row['interest'] * $row['amount']) * $days) + $row['amount'];

} else if ($days >= 31 && $days <= 35) {

$debt = (0.20 * $row['amount']) + $row['amount'];

} else if ($days >= 36 && $days <= 40) {

$debt = (0.25 * $row['amount']) + $row['amount'];

} else if ($days >= 41 && $days <= 45) {

$debt = (0.30 * $row['amount']) + $row['amount'];

}


echo 'K ' . number_format($debt ,2);?>


</td>

<td  style="text-align:center"><a href="profile.php?tid=<?=$tid?>">Schedule</a></td>
       
  </tr>

<?php } }?>
                </tbody>






                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include ("../includes/footer.php");?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="s../dist/js/demo.js"></script>
<!-- page script -->

</body>
</html>
