<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['addUser'])) {
    $name = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password == $confirmpassword) {

        $checkemail = "SELECT email FROM users WHERE email='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            //Taken Already exists
            $_SESSION['status'] = "Email id is already taken.!";
            header("Location: index.php");
        } else {
            //Available = Record not found
            $user_query = "INSERT INTO users (username,phonenumber,email,password) VALUES ('$name','$phone','$email','$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {
                $_SESSION['status'] = "User Added Successfully";
                header("Location: index.php");
            } else {
                $_SESSION['status'] = "User Registration Failed";
                header("Location: index.php");
            }
        }
    } else {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: registered.php");
    }
}


?>

<?php
if (isset($_POST['login_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: ../admin/login.php');
    exit(0);
}
if (isset($_POST['signup_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: ../admin/signup.php');
    exit(0);
}
if (isset($_POST['logout_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status'] = "Logged out successfully";
    header('Location: index.php');
    exit(0);
}

if (isset($_POST['adminlogin_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: ../admin/adminlogin.php');
    exit(0);
}

if (isset($_POST['check_Emailbtn'])) {
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($con, $checkemail);

    if (mysqli_num_rows($checkemail_run) > 0) {
        echo "Email id already taken.!";
    } else {
        echo "It's Available";
    }
}

?>
<?php
include('config/dbcon.php');
if (isset($_SESSION['auth_user'])) {
    if (isset($_POST['UpdatePatient'])) {
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $contactdetails = $_POST['contactdetails'];
        $notificationpreferences = $_POST['notificationpreferences'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_id = $_SESSION['auth_user']['UserID'];

        $patient_query = "UPDATE patients SET Firstname='$firstname', Lastname='$lastname', Address='$address', ContactDetails='$contactdetails',NotificationPreferences='$notificationpreferences' WHERE UserID ='$user_id'";
        $patient_query_run = mysqli_query($con, $patient_query);
        if($patient_query_run)
        {
            $user_query = "UPDATE users SET Username='$username',Email='$email',Password='$password' WHERE UserID ='$user_id'";
            if ($con->query($user_query) === TRUE) {
                $_SESSION['status'] = "Update Patient Details Successfully";
                header("Location: userprofile.php");
            } else {
                $_SESSION['status'] = "Failed to Update Patient Details";
                header("Location: userprofile.php");
            }
        }
        else {
            $_SESSION['status'] = "Failed to Update Patient Details";
            header("Location: userprofile.php");
        }

    }
}
else{
    $_SESSION['status'] = "Failed to Update Patient Details";
    header("Location: userprofile.php");
}

if (isset($_POST['GetPatientID'])) {
    
    $UserID = $_SESSION['auth_user']['UserID'];
    $query = "SELECT PatientID  FROM patients WHERE UserID='$UserID' LIMIT 1";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        
        if (mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_assoc($query_run);
            $patientID = $row['PatientID'];
            echo $patientID;
        } else {
            echo 'Patient ID not found';
        }
    } else {
        echo 'Error executing query';
    }
    exit;
}
?>
 <?php 

 
if (isset($_POST['SubmitReport']))
 {
     
    $ReportTitle = $_POST["reporttitle"];
    $File = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = 'report';
    $UserID = $_SESSION['auth_user']['UserID'];
    $Date = date('Y-m-d');

    move_uploaded_file($tname, $uploads_dir.'/'.$File);

    
    $patient_query = "SELECT PatientID  FROM patients WHERE UserID='$UserID' LIMIT 1";
    $patient_query_run = mysqli_query($con, $patient_query);
    if ($patient_query_run) {
        
        if (mysqli_num_rows($patient_query_run) > 0) {
            $row = mysqli_fetch_assoc($patient_query_run);
            $PatientID = $row['PatientID'];
            $sql = "INSERT into medicalreports(PatientID,ReportTitle,File,Date,UploadBy) VALUES('$PatientID','$ReportTitle','$File','$Date','Patient')";
 
            if(mysqli_query($con,$sql)){
                $_SESSION['status'] = "File Sucessfully uploaded";
                header("Location: medicalreport.php");
            }
            else{
                $_SESSION['status'] = "File upload Failed";
                header("Location: medicalreport.php");
            }
        } else {
            $_SESSION['status'] = "Patient ID not found";
            header("Location: medicalreport.php");
        }
    } else {
        echo 'Error executing query';
    }
    
}
 
if(isset($_POST['DeleteReport']))
{
    $ReportID  = $_POST['delete_id'];
   
    $query = "DELETE FROM medicalreports WHERE ReportID ='$ReportID' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "File Deleted Successfully";
        header("Location: medicalreport.php");
    }
    else
    {
        $_SESSION['status'] = "File Deleting Failed";
        header("Location: medicalreport.php");
    }

}

if (isset($_POST['EmergencyDoctor']))
 {
     
    
    $UserID = $_SESSION['auth_user']['UserID'];
    $DoctorID = $_POST["doctorid"];
    $Diagnosis = $_POST["diagnosis"];
    $Date = date('Y-m-d');

    

    
    $patient_query = "SELECT PatientID  FROM patients WHERE UserID='$UserID' LIMIT 1";
    $patient_query_run = mysqli_query($con, $patient_query);
    if ($patient_query_run) {
        
        if (mysqli_num_rows($patient_query_run) > 0) {
            $row = mysqli_fetch_assoc($patient_query_run);
            $PatientID = $row['PatientID'];
            $sql = "INSERT into patientrecords(PatientID,DoctorID,Date,Diagnosis) VALUES('$PatientID','$DoctorID','$Date','$Diagnosis')";
 
            if(mysqli_query($con,$sql)){
                $_SESSION['status'] = "Diagnosis Sucessfully Send to the Doctor";
                header("Location: emergencydoctor.php");
            }
            else{
                $_SESSION['status'] = "Diagnosis Send Failed";
                header("Location: emergencydoctor.php");
            }
        } else {
            $_SESSION['status'] = "Patient ID not found";
            header("Location: emergencydoctor.php");
        }
    } else {
        echo 'Error executing query';
    }
    
}
 
?>







