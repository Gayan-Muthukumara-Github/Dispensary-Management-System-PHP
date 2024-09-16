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
        <h5 class="modal-title" id="exampleModalLabel">Delete Doctor Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="delete_id" class="delete_location_id">
          <input type="hidden" name="role" value="doctor">
          <p>
            Are you sure. you want to delete this data?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="deleteUser_By_Admin" class="btn btn-primary">Yes, Delete.!</button>
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
                Doctor
                <a href="add-user.php" class="btn btn-primary float-right">Add Doctor</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Doctor ID</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Specialization</th>
                    <th>Edit</th>
                    <th>Delete</th></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM doctors";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                  ?>
                      <tr>
                        <td>
                          <?php echo $row['DoctorID'] ?>
                        </td>
                        <td>
                          <?php echo $row['UserID'] ?>
                        </td>
                        <td>
                          <?php echo $row['Firstname'] ?>
                        </td>
                        <td>
                          <?php echo $row['Lastname'] ?>
                        </td>
                        <td>
                          <?php echo $row['ContactDetails'] ?>
                        </td>
                        <td>
                          <?php echo $row['Address'] ?>
                        </td>
                        <td>
                          <?php echo $row['Specialization'] ?>
                        </td>
                        <td>
                          <a href="doctor-edit.php?DoctorID=<?php echo $row['DoctorID']; ?>" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        <td>
                           <button type="button" value="<?php echo $row['DoctorID']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="9">No Record Found</td>
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