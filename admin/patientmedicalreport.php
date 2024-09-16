<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<script type="text/javascript" src="assets/dist/js/jquery.js"></script>
<script type="text/javascript" src="assets/dist/js/qrcode.js"></script>
<!--Delete Patient Modal -->
<div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Medical Report</h5>
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
          <button type="submit" name="deleteMedicalReport" class="btn btn-primary">Yes, Delete.!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete Patient Model-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content mt-4">
    
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>
          <div class="card">
            <div class="card-header">
              <h4>
                Patient Medical Report
                <?php
                  if ($_SESSION['auth']== "5" || $_SESSION['auth']== "1" ) {
                ?>
                <a href="add-medicalreport.php" class="btn btn-primary float-right">Add Medical Report</a>
                <?php
                  }
                ?>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Report ID</th>
                    <th>Patient ID</th>
                    <th>LabAdmin ID</th>
                    <th>Report Title</th>
                    <th>Report File</th>
                    <th>Uploaded Date</th>
                    <th>Uploaded By</th>
                    <th>View Report</th>
                    <?php
                      if ($_SESSION['auth']== "5" || $_SESSION['auth']== "1" ) {
                    ?>
                    <th>Delete Report</th>
                    <?php
                      }
                    ?>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM medicalreports";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                  ?>
                      <tr>
                        <td>
                          <?php echo $row['ReportID'] ?>
                        </td>
                        <td>
                          <?php echo $row['PatientID'] ?>
                        </td>
                        <td>
                          <?php echo $row['LabAdminID'] ?>
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
                        <?php
                          if ($_SESSION['auth']== "5" || $_SESSION['auth']== "1" ) {
                        ?>
                        <td>
                          <button type="button" value="<?php echo $row['ReportID']; ?>" class="btn btn-danger btn-sm deletebtn">Delete Report</a>
                        </td>
                        <?php
                          }
                        ?>
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