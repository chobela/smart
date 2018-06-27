<?php	
include("../config.php");	

$uid = $_GET['uid'];
	$sql = "SELECT * FROM paytypes";
	
 $res = mysqli_query($db,$sql);
 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Easy Bills</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Easy</b>Bills</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">4 of 5</p>

   <form role="form" action="" method="post">
 <input type="hidden" name="submitd" value="true"/>

<div class="form-group has-feedback">
        <input type="hidden" class="form-control" placeholder="uid" value="<?php echo $uid;?>" name="uid" id="uid">
        <span class="fa fa-info form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Next of Kin Name" name="kin_name" id="kin_name">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Next of Kin Relationship" name="relationship" id="relationship">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Next of Kin Address" name="kin_address" id="kin_address">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


<div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Next of Kin Phone" name="kin_phone" id="kin_phone">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


<div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Next of Kin Employer" name="kin_emp" id="kin_emp">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


      <div class="form-group has-feedback">
        <input type="text-area" class="form-control" placeholder="Referee(1): Name, Address and phone" name="ref1" id="ref1">
        <span class="fa fa-info form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
        <input type="text-area" class="form-control" placeholder="Referee(2): Name, Address and phone" name="ref2" id="ref2">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


 
   
      <div class="row">
        <div class="col-xs-8">
           <a href="login.php" class="text-center"></a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Next</button>
        </div>
        <!-- /.col -->
      </div>
<?php
if (isset($_POST['submitd'])){   
$uid = $_POST['uid'];
$kname = $_POST['kin_name'];
$r = $_POST['relationship'];
$kaddress = $_POST['kin_address'];
$kphone = $_POST['kin_phone'];
$kemp = $_POST['kin_emp'];
$ref1 = $_POST['ref1'];
$ref2 = $_POST['ref2'];

mysqli_query ($db, "UPDATE profile set kin_name = '$kname', relationship = '$r', kin_address = '$kaddress', kin_phone = '$kphone', kin_emp = '$kemp', ref1 = '$ref1', ref2 = '$ref2' WHERE uid = '$uid'");

 echo "<script>window.location.href = '5.php?uid=$uid';</script>";
}
?>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
