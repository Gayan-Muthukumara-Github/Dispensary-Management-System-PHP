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
            <li class="breadcrumb-item active">Add - User</li>
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
                Add - Medical Report
              </h3>
              <a href="patientmedicalreport.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="form-group">
                        <lable for="text" >Report Title</lable>
                        <input type="text" name="reporttitle" class="form-control" placeholder="First Name" required>
                      </div>
                      <div class="form-group">
                        <lable for="text" >File Upload</lable>
                        <input type="File" name="file" id="file" class="form-control" value="">
                      </div>
                      <div class="form-group">
                                <lable for="" class="text-dark">Patient ID</lable>
                                <select name="patientid" class="form-control" required>
                                <?php
                                $query = "SELECT PatientID FROM patients";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                  foreach ($query_run as $row) {
                                ?>
                                  <option value="<?php echo $row['PatientID']; ?>"><?php echo $row['PatientID']; ?></option>
                                  <?php
                                  }
                                  } else {
                                    ?>
                                    <tr>
                                      <option value="">No Record Found</option>
                                    </tr>
                                  <?php
                                  }
                                  ?>
                                </select>
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="SubmitReport" class="btn btn-info">Submit</button>
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