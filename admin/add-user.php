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
                Add - User
              </h3>
              <a href="index.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <div class="row">
                          <div class="form-group col-md-6">
                              <lable for="text" >First Name</lable>
                              <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                          </div>
                          <div class="form-group col-md-6">
                              <lable for="text" >Last Name</lable>
                              <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <lable for="">Address</lable>
                          <input type="text-area" name="address" class="form-control" placeholder="Address" required>
                      </div>
                      <div class="row">
                          <div class="form-group col-md-6">
                              <lable for="">Phone Number</lable>
                              <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number" required>
                          </div>
                          <div class="form-group col-md-6">
                              <lable for="" class="text-dark">Email</lable>
                              <input type="text" name="email" class="form-control" placeholder="Email" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-md-6">
                              <lable for="" class="text-dark">User Name</lable>
                              <input type="text" name="username" class="form-control" placeholder="User Name" required>
                          </div>
                          <div class="form-group col-md-6">
                                <lable for="" class="text-dark">Role</lable>
                                <select name="role" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="labadmin">Lab Admin</option>
                                    <option value="pharmacist">Pharmacist</option>
                                    <option value="patient">Patient</option>
                                </select>
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-md-6">
                              <lable for="" class="text-dark">Password</lable>
                              <input type="password" id="password" name="password" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                          </div>
                          <div class="form-group col-md-6">
                              <lable for="" class="text-dark">Confirm Password</lable>
                              <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="addUser_By_Admin" class="btn btn-info">Save</button>
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