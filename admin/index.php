<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<?php
$query = "SELECT privilege, COUNT(privilege) as count FROM `userprivileges` GROUP BY privilege";
$query_run = mysqli_query($con, $query);

$dataPoints = array();

if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        $dataPoints[] = array("label" => $row['privilege'], "y" => $row['count']);
    }
} else {
    // Handle case where query execution fails
}
 ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php');  ?>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
            <?php
              $query1 = "SELECT count(*) as count FROM patients";
              $query_run1 = mysqli_query($con, $query1);

              if ($query_run1) {
                  while ($row1 = mysqli_fetch_assoc($query_run1)) {
                      ?>
                      
                      <h3><?php echo $row1['count'] ?></h3>
                      <?php
                  }
              } else {
                  // Handle case where query execution fails
              }
              ?>

              <p>Total Patients</p>
            </div>
            <div class="icon">
              <i class="ion ion-heart-broken"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
            <?php
              $query1 = "SELECT count(*) as count FROM patientrecords";
              $query_run1 = mysqli_query($con, $query1);

              if ($query_run1) {
                  while ($row1 = mysqli_fetch_assoc($query_run1)) {
                      ?>
                      
                      <h3><?php echo $row1['count'] ?></h3>
                      <?php
                  }
              } else {
                  // Handle case where query execution fails
              }
              ?>

              <p>Total Diagnosis</p>
            </div>
            <div class="icon">
              <i class="ion ion-chatboxes"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
            <?php
              $query1 = "SELECT count(*) as count FROM users";
              $query_run1 = mysqli_query($con, $query1);

              if ($query_run1) {
                  while ($row1 = mysqli_fetch_assoc($query_run1)) {
                      ?>
                      
                      <h3><?php echo $row1['count'] ?></h3>
                      <?php
                  }
              } else {
                  // Handle case where query execution fails
              }
              ?>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
              $query1 = "SELECT count(*) as count FROM medicalreports ";
              $query_run1 = mysqli_query($con, $query1);

              if ($query_run1) {
                  while ($row1 = mysqli_fetch_assoc($query_run1)) {
                      ?>
                      
                      <h3><?php echo $row1['count'] ?></h3>
                      <?php
                  }
              } else {
                  // Handle case where query execution fails
              }
              ?>
              <p>Total Report</p>
            </div>
            <div class="icon">
              <i class="ion ion-document-text"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>