<?php
session_start();
include('config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dispensary Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="shortcut icon" href="images/logo.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/style-starter.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <style>
    .center-image {
      display: block;
      margin: 0 auto;
      width: 25%;
    }
  </style>
  <script type="text/javascript" src="js/jquery.js"></script>
</head>

<body>
<!--Delete Patient Modal -->
<div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="delete_id" class="delete_location_id">
          <input type="hidden" name="role" value="patient">
          <p>
            Are you sure. you want to delete this file?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="DeleteReport" class="btn btn-primary">Yes, Delete.!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete Patient Model-->
  <div class="site-wrap">
  <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input class="form-control border-0" type="search" placeholder="Search" aria-label="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone">DISPENSARY</a>
                <a href="index.php" class="js-logo-clone">MANEGEMENT</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li>
                    <h5>
                      <?php
                      if (isset($_SESSION['auth'])) {
                        echo "Hello " . $_SESSION['auth_user']['Username'];
                      } else {
                        echo "Not Logged in";
                      }
                      ?>
                    </h5>
                  </li>
                  <li>

                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-person"></span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form action="code.php" method="POST">
                          <button type="submit" name="login_btn" class="dropdown-item">Login</button>
                          <button type="submit" name="signup_btn" class="dropdown-item">Sign Up</button>
                          <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                          <button type="submit" name="adminlogin_btn" class="dropdown-item">Admin Panel</button>
                        </form>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="logincode.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="User Name">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addUser" class="btn btn-dark">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Sign Up</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="code.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <span class="email_error"></span>
                  <input type="email" name="email" class="form-control email_id" placeholder="Email">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addUser" class="btn btn-dark">Sign Up</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <nav class="site-navigation text-right text-md-center bg-success" role="navigation">
        <div class="">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li><a href="index.php">Home</a></li>
            <?php
              if (isset($_SESSION['auth'])) {
            ?>
            <li><a href="patientid.php">Get Patient ID</a></li>
            <li><a href="medicalreport.php" class="text-warning">Upload Patient Medical Report</a></li>
            <li><a href="emergencydoctor.php">Emergency Contact Doctor</a></li>
            <li><a href="userprofile.php">User Profile</a></li>
            <li><a href="dashboard.php">Analytical Dashboard</a></li>
            <?php
              }
            ?>
          </ul>
        </div>
      </nav>
    </header>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Medical Report</strong></div>
                </div>
            </div>
        </div>

        


        <div class="container py-lg-5">
        <?php
      include('../admin/message.php');
    ?>
            <h3 class="hny-title text-center mb-0 ">Medical<span class="text-success"> Report</span></h3>
            <p class="mb-2 text-center">What shoud you do</p>

        </div>


        <div class="container">
            <div class="row mb-5">
              <div class="col-md-12">
                <form id="contact-form" action="code.php" method="POST" enctype="multipart/form-data">
                  <div class="p-lg-5 border">
                    <div class="form-group row">
                      <div class="col-lg-4">
                        <label for="title" class="text-black">Report Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="reporttitle" name="reporttitle">
                      </div>
                      <div class="col-lg-4">
                        <label>File Upload</label>
                        <input type="File" name="file" id="file" class="form-control" value="">
                      </div>
                      <div class="col-lg-4">
                        <label></label>
                        <input type="submit" name="SubmitReport" id="" class="btn btn-info btn-lg btn-block" value="Submit">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Report ID</th>
                    <th>Report Title</th>
                    <th>Report File</th>
                    <th>Uploaded Date</th>
                    <th>Report Upload By</th>
                    <th>View Report</th>
                    <th>Delete Report</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $UserID = $_SESSION['auth_user']['UserID'];
                  $query = "SELECT * FROM medicalreports AS MR JOIN patients AS P ON
                  P.PatientID  = MR.PatientID WHERE P.UserID = '$UserID'";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                  ?>
                      <tr>
                        <td>
                          <?php echo $row['ReportID'] ?>
                        </td>
                        <td>
                          <?php echo $row['ReportTitle'] ?>
                        </td>
                        <td>
                          <?php echo $row['File'] ?>
                        </td>
                        <td>
                          <?php echo $row['Date'] ?>
                        </td>
                        <td>
                          <?php echo $row['UploadBy'] ?>
                        </td>
                        <td>
                          <a href="view_pdf.php?pdfFileName=<?php echo $row['File']; ?>" class="btn btn-info btn-sm">View Report</a>
                        </td>
                        <td>
                          <button type="button" value="<?php echo $row['ReportID']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="7">No Record Found</td>
                    </tr>
                  <?php
                  }
                  ?>

                </tbody>
              </table>
              </div>
            </div>
        </div>
       
        <footer class="site-footer border-top bg-info">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-6 ">
                <ul class="list-unstyled text-dark">
                  <li><a class="text-dark" href="index.php">Home</a></li>
                  <?php
                    if (isset($_SESSION['auth'])) {
                  ?>
                  <li><a class="text-dark" href="patientid.php">Get Patient ID</a></li>
                  <li><a class="text-dark" href="medicalreport.php">Upload Patient Medical Report</a></li>
                  <li><a class="text-dark" href="emergencydoctor.php">Emergency Contact Doctor</a></li>
                  <li><a class="text-dark" href="userprofile.php">User Profile</a></li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4" >Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address text-dark">No:80, Donel Road, Colombo 2</li>
                <li class="phone text-dark"><a class="text-dark" href="tel://23923929210">+94 77 946 9179</a></li>
                <li class="email text-dark"><a class="text-dark" href="mailto:formagreen@gmail.com">dispensarymanagement@gmail.com</a></li>
              </ul>
            </div>

            
          </div>
        </div>
        <div class="text-center text-dark">
          © 2020 Copyright:
          <a class="text-dark" href="index.php">www.dispensarymanagement.com</a>
        </div>
      </div>
    </footer>
    </div>
    <script>
      $(document).ready(function() {
        $('.deletebtn').click(function(e) {
          e.preventDefault();

          var location_id = $(this).val();
          $('.delete_location_id').val(location_id);
          $('#DeletModal').modal('show');

        });
      });
    </script>


    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>

    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script>
    <script src="js/background.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

</body>

</html>