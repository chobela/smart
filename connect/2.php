<?php	
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
include("../config.php");	

$uid = $_GET['uid'];
	$sql = "SELECT * FROM paytypes";
	
 $res = mysqli_query($db,$sql);

$sql = "SELECT * FROM emptypes";
	
 $ress = mysqli_query($db,$sql);
 
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
    <p class="login-box-msg">2 of 5</p>

     <form role="form" action="" method="post">
 <input type="hidden" name="submitb" value="true"/>

 <div class="form-group has-feedback">
        <input type="hidden" class="form-control" placeholder="uid" value="<?php echo $uid; ?>" name="uid" id="uid">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nationality" name="nationality" id="nationality">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Date of Birth" name="birth" id="birth">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="NRC Number" name="nrc" id="nrc">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


<div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Profession" name="profession" id="profession">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


 <div class="form-group">
             
                <select class="form-control select2" id="payment" name="payment" style="width: 100%;">
                   <option selected="selected">Mode of Payment</option>
                 
						<?php 
					
						foreach($res as $r) { 
							echo "<option value=\"$r[id]\">$r[pay_type]</option>" ;
						}
					        ?>
                </select>
              </div>


<div class="form-group has-feedback">
	<div class="input-group">
<div class="input-group-addon">260</div>
        <input type="number" class="form-control" placeholder="Other phone contact" name="phone2" maxlength="9"  id="phone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span></div>
      </div>



   
      <div class="row">
        <div class="col-xs-8">
           <a href="login.php" class="text-center"></a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Done</button>
        </div>
        <!-- /.col -->
      </div>

<?php
/*********** post an event **********/

if (isset($_POST['submitb'])){
    
   // include('connect-mysql.php');
    $uid = $_POST['uid'];
    $nat = $_POST['nationality'];
    $birth = $_POST['birth'];
    $nrc = $_POST['nrc'];
    $prof = $_POST['profession'];
    $payment = $_POST['payment'];
    $phone2 = $_POST['phone2'];
  

   mysqli_query ($db, "INSERT INTO profile (uid, nationality, birth, nrc, profession, payment, phone2) VALUES ('$uid', '$nat', '$birth', '$nrc', '$prof', '$payment', '$phone2')");
    
  
header("Location: 3.php?uid=$uid");
exit();
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
