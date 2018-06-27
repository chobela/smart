 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
      
    </ul>

  <!-- SEARCH FORM -->
    <form class="form-inline ml-3" 

<?php

if ($_SERVER['PHP_SELF'] == '/smart/index.php') {

echo 'action="pages/client.php"';

} else {

echo 'action="client.php"';

}

?>
 method="post">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="name" id="name">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form> 

<?php
$sq = "SELECT * FROM messages LEFT JOIN clients ON messages.uid = clients.unique_id WHERE messages.date = CURDATE()";
 
$rd = mysqli_query($db,$sq);
$co = mysqli_num_rows($rd);


$a = "SELECT * FROM clients WHERE CONVERT(created_at, DATE) = CURDATE();";
 
$b = mysqli_query($db,$a);
$c = mysqli_num_rows($b);

?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $co;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
 <?php

 if ($co > 0) {

              while ($roww = mysqli_fetch_array($rd)) { $uid = $roww['id'];?>


  <a 
<?php

//$rname = $roww['name'];

if ($_SERVER['PHP_SELF'] == '/smart/index.php') {


echo 'href= pages/client.php?name='.$roww['name'].'';

} else {


echo 'href= client.php?name='.$roww['name'].'';


}
?>
 class="dropdown-item">
           <!-- Message Start -->
            <div class="media">
              <img src="dist/img/userr.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo $roww['name'];?>
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm" ><?php echo $roww['message'];?></p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i><?php echo $roww['date'];?></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>

  <?php } }?>  
 
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->



      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $c?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $c?> New users today</span>
          <div class="dropdown-divider"></div>


 <?php

 if ($c > 0) {

              while ($rj = mysqli_fetch_array($b)) { $uid = $rj['unique_id'];?>

          <a href="pages/profile.php?uid=<?=$uid?>&name=<?=$rj['name']?>&wallet=<?=$rj['wallet']?>&spent=<?=$rj['spent']?>&debt=<?=$rj['spent']?>" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> <?php echo $rj['name'];?>       
          </a>

  <?php } }?>  
         
           
          </a>
        
      </li>
   
    </ul>
  </nav>
  <!-- /.navbar -->
