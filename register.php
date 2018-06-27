<?php	
include("config.php");	
	$sql = "SELECT * FROM membership";
	
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
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/Adminlte.min.css">
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
    <a href="../../index2.html"><b>SLA</b>Smart</a>
  </div>

   <div class="card">
    <div class="card-body register-card-body">
    <p class="login-box-msg">Register a new user</p>

    <form action="connect/reg.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Company name" name="name" id="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>


 <div class="form-group">
             
                <select class="form-control select2" id="plan" name="plan" style="width: 100%;">
                   <option selected="selected">Select Plan Type</option>
                 
						<?php 
					
						foreach($res as $r) { 
							echo "<option value=\"$r[id]\">$r[plan_type]</option>" ;
						}
					        ?>
                </select>
              </div>



      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>


<div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Tpin" name="tpin" id="tpin">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


<div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Address" name="address" id="address">
        <span class="fa fa-info form-control-feedback"></span>
      </div>


<div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
   
      <div class="row">
        <div class="col-xs-8">
           <a href="login.php" class="text-center">Proceed to login</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  

  
  </div>
  <!-- /.form-box -->
</div>
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
