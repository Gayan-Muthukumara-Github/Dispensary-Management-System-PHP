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
            <li class="breadcrumb-item active">Edit - User Details</li>
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
                Edit - User Details
              </h3>
              <a href="users.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <?php
                      if (isset($_GET['UserID'])) {
                        $UserID = $_GET['UserID'];
                        $query = "SELECT * FROM users WHERE UserID='$UserID' LIMIT 1";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                      ?>
                            <input type="hidden" name="doctorid" value="<?php echo $row['UserID'] ?>">
                            <div class="form-group">
                              <lable for="">User ID</lable>
                              <input type="text" name="userid" value="<?php echo $row['UserID'] ?>" class="form-control" placeholder="Patient ID" readonly>
                            </div>
                            <div class="form-group">
                              <lable for="">User Name</lable>
                              <input type="text" name="username" value="<?php echo $row['Username'] ?>" class="form-control" placeholder="User ID" >
                            </div>
                            <div class="form-group">
                              <lable for="">Email</lable>
                              <input type="text" name="email" value="<?php echo $row['Email'] ?>" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group">
                              <lable for="">Password</lable>
                              <input type="password" name="password" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="Address">
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
                      <button type="submit" name="updateUser_By_Admin" class="btn btn-info">Update</button>
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