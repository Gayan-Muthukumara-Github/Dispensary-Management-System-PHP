<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<script type="text/javascript" src="assets/dist/js/jquery.js"></script>
<script type="text/javascript" src="assets/dist/js/qrcode.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content mt-4">
    
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>
          <div class="card">
            <div class="card-header">
              <h4>
                Patient Diagnosis
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Patient Record ID </th>
                    <th>Patient ID </th>
                    <th>Doctor ID </th>
                    <th>Date</th>
                    <th>Diagnosis</th>
                    <th>Comments</th>
                    <th>Give Comment</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $UserID = $_SESSION['auth_user']['UserID'];
                  $query = "SELECT * FROM patientrecords AS PR JOIN doctors AS D ON D.DoctorID = PR.DoctorID WHERE D.UserID='$UserID'";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                  ?>
                      <tr>
                        <td>
                          <?php echo $row['PatientRecordID'] ?>
                        </td>
                        <td>
                          <?php echo $row['PatientID'] ?>
                        </td>
                        <td>
                          <?php echo $row['DoctorID'] ?>
                        </td>
                        <td>
                          <?php echo $row['Date'] ?>
                        </td>
                        <td>
                          <?php echo $row['Diagnosis'] ?>
                        </td>
                        <td>
                          <?php echo $row['Comments'] ?>
                        </td>
                        <td>
                          <a href="patientdiagnosis-edit.php?PatientRecordID=<?php echo $row['PatientRecordID']; ?>" class="btn btn-info btn-sm">Give Comment</a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="8">No Record Found</td>
                    </tr>
                  <?php
                  }
                  ?>

                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    
  </section>
</div>

<?php include('includes/script.php'); ?>

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
<script type="text/javascript" src="assets/dist/js/qrReader.js"></script>

<?php include('includes/footer.php'); ?>