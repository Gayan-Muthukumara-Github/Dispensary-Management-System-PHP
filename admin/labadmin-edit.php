<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit - Lab Admin</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                Edit - Lab Admin
              </h3>
              <a href="labadmin.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <?php
                      if (isset($_GET['LabAdminID'])) {
                        $LabAdminID = $_GET['LabAdminID'];
                        $query = "SELECT * FROM labadmins WHERE LabAdminID='$LabAdminID' LIMIT 1";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                      ?>
                            <input type="hidden" name="labadminid" value="<?php echo $row['LabAdminID'] ?>">
                            <div class="form-group">
                              <lable for="">Lab Admin ID</lable>
                              <input type="text" name="labadminid" value="<?php echo $row['LabAdminID'] ?>" class="form-control" placeholder="Patient ID" readonly>
                            </div>
                            <div class="form-group">
                              <lable for="">User ID</lable>
                              <input type="text" name="userid" value="<?php echo $row['UserID'] ?>" class="form-control" placeholder="User ID" readonly>
                            </div>
                            <div class="form-group">
                              <lable for="">First Name</lable>
                              <input type="text" name="firstname" value="<?php echo $row['Firstname'] ?>" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group">
                              <lable for="">Last Name</lable>
                              <input type="text" name="lastname" value="<?php echo $row['Lastname'] ?>" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                              <lable for="">Address</lable>
                              <input type="text" name="address" value="<?php echo $row['Address'] ?>" class="form-control" placeholder="Address">
                            </div>
                            <div class="form-group">
                              <lable for="">Contact Details</lable>
                              <input type="text" name="contactdetails" value="<?php echo $row['ContactDetails'] ?>" class="form-control" placeholder="Contact Details">
                            </div>
                      <?php
                          }
                        } else {
                          echo "<h4>No Record Found.!</h4>";
                        }
                      }
                      ?>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="updateLabAdmin_By_Admin" class="btn btn-info">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>