<?php
session_start();
include('config/dbcon.php');
include('config/dbcon.php');


if(isset($_POST['logout_btn']))
{
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    
    $_SESSION['status'] = "Logged out successfully";
    header('Location: login.php');
    exit(0);
}
if (isset($_POST['user_btn'])) {
    
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    header('Location: adminprofile.php');
}

//email check function for signup
if(isset($_POST['check_Emailbtn']))
{
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($con, $checkemail);

    if(mysqli_num_rows($checkemail_run)>0)
    {
        echo "Email id already taken.!";
    }
    else
    {
        echo "It's Available";
    }
}

//user table add data from website

if(isset($_POST['addUser_website']))
{
    $role = "patient";
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    function validate_phone_number($phone_num)
{
     // Allow +, - and . in phone number
     $filtered_phone_number = filter_var($phone_num, FILTER_SANITIZE_NUMBER_INT);

     // Check the lenght of number
     // This can be customized if you want phone number from a specific country
     if (strlen($filtered_phone_number) == 10 ) {
        return true;
     } else {
       return false;
     }
}

    if($password == $confirmpassword)
    {
        if (validate_phone_number($phone) == true) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == true)
            {
                $checkemail = "SELECT email FROM users WHERE email='$email'";
                $checkemail_run = mysqli_query($con, $checkemail);

                if(mysqli_num_rows($checkemail_run)>0)
                {
                    //Taken Already exists
                    $_SESSION['status'] = "Email id is already taken.!";
                    header("Location: signup.php");
                }
                else
                {
                    //Available = Record not found
                    $user_query = "INSERT INTO users (Username,Email,Password) VALUES ('$username','$email','$password')";
                    $user_query_run = mysqli_query($con, $user_query);

                    if($user_query_run)
                    {
                        $_SESSION['status'] = "User Added Successfully";

                        $last_id = mysqli_insert_id($con);
                        $user_privilege = "INSERT INTO UserPrivileges (UserID, Privilege) VALUES ('$last_id', '$role')";
                        if ($con->query($user_privilege) === TRUE) {
                            switch ($role) {
                                case "patient":
                                    $sql_patient = "INSERT INTO patients (UserID,Firstname,Lastname,Address,ContactDetails,NotificationPreferences) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone', 'SMS')";
                                    $con->query($sql_patient);
                                    break;
                                case "doctor":
                                    $sql_doctor = "INSERT INTO doctors (UserID,Firstname,Lastname,Address,ContactDetails) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone')";
                                    $con->query($sql_doctor);
                                    break;
                                case "pharmacist":
                                    $sql_pharmacist = "INSERT INTO pharmacists (UserID,Firstname,Lastname,Address,ContactDetails) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone')";
                                    $con->query($sql_pharmacist);
                                    break;
                                case "labadmin":
                                    $sql_labadmin = "INSERT INTO labadmins (UserID,Firstname,Lastname,Address,ContactDetails) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone')";
                                    $con->query($sql_labadmin);
                                    break;
                            }
                            
                            $_SESSION['status'] = "Registration successful!";
                        } else {
                            $_SESSION['status'] = "Error inserting privilege: " . $user_privilege . "<br>" . $con->error;
                        }
                        header("Location: login.php");
                    }
                    else
                    {
                        $_SESSION['status'] = "User Registration Failed";
                        header("Location: signup.php");
                    }
                }  

            }
            else
            {
                $_SESSION['status'] = "Not a valid email address";
                header("Location: signup.php");
            }
        } 
        else 
        {
            $_SESSION['status'] = "Not a valid phone number";
            header("Location: signup.php");
        }
          
    }
    else
    {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: signup.php");
    }
}

if(isset($_POST['addUser_By_Admin']))
{
    $role = $_POST['role'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    function validate_phone_number($phone_num)
{
     // Allow +, - and . in phone number
     $filtered_phone_number = filter_var($phone_num, FILTER_SANITIZE_NUMBER_INT);

     // Check the lenght of number
     // This can be customized if you want phone number from a specific country
     if (strlen($filtered_phone_number) == 10 ) {
        return true;
     } else {
       return false;
     }
}

    if($password == $confirmpassword)
    {
        if (validate_phone_number($phone) == true) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == true)
            {
                $checkemail = "SELECT email FROM users WHERE email='$email'";
                $checkemail_run = mysqli_query($con, $checkemail);

                if(mysqli_num_rows($checkemail_run)>0)
                {
                    //Taken Already exists
                    $_SESSION['status'] = "Email id is already taken.!";
                    header("Location: signup.php");
                }
                else
                {
                    //Available = Record not found
                    $user_query = "INSERT INTO users (Username,Email,Password) VALUES ('$username','$email','$password')";
                    $user_query_run = mysqli_query($con, $user_query);

                    if($user_query_run)
                    {
                        $_SESSION['status'] = "User Added Successfully";

                        $last_id = mysqli_insert_id($con);
                        $user_privilege = "INSERT INTO UserPrivileges (UserID, Privilege) VALUES ('$last_id', '$role')";
                        if ($con->query($user_privilege) === TRUE) {
                            switch ($role) {
                                case "patient":
                                    $sql_patient = "INSERT INTO patients (UserID,Firstname,Lastname,Address,ContactDetails,NotificationPreferences) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone', 'SMS')";
                                    $con->query($sql_patient);
                                    break;
                                case "doctor":
                                    $sql_doctor = "INSERT INTO doctors (UserID,Firstname,Lastname,Address,ContactDetails) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone')";
                                    $con->query($sql_doctor);
                                    break;
                                case "pharmacist":
                                    $sql_pharmacist = "INSERT INTO pharmacists (UserID,Firstname,Lastname,Address,ContactDetails) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone')";
                                    $con->query($sql_pharmacist);
                                    break;
                                case "labadmin":
                                    $sql_labadmin = "INSERT INTO labadmins (UserID,Firstname,Lastname,Address,ContactDetails) VALUES ('$last_id', '$firstname', '$lastname', '$address', '$phone')";
                                    $con->query($sql_labadmin);
                                    break;
                            }
                            
                            $_SESSION['status'] = "Registration successful!";
                        } else {
                            $_SESSION['status'] = "Error inserting privilege: " . $user_privilege . "<br>" . $con->error;
                        }
                        switch ($role) {
                            case "patient":
                                header("Location: patient.php");
                                break;
                            case "doctor":
                                header("Location: doctor.php");
                                break;
                            case "pharmacist":
                                header("Location: pharmacist.php");
                                break;
                            case "labadmin":
                                header("Location: labadmin.php");
                                break;
                        }
                        
                    }
                    else
                    {
                        $_SESSION['status'] = "User Registration Failed";
                        switch ($role) {
                            case "patient":
                                header("Location: patient.php");
                                break;
                            case "doctor":
                                header("Location: doctor.php");
                                break;
                            case "pharmacist":
                                header("Location: pharmacist.php");
                                break;
                            case "labadmin":
                                header("Location: labadmin.php");
                                break;
                        }
                    }
                }  

            }
            else
            {
                $_SESSION['status'] = "Not a valid email address";
                header("Location: add-user.php");
            }
        } 
        else 
        {
            $_SESSION['status'] = "Not a valid phone number";
            header("Location: add-user.php");
        }
          
    }
    else
    {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: add-user.php");
    }
}

if (isset($_POST['updateDoctor_By_Admin'])) {
    $role = $_POST['role'];
    $doctorid = $_POST['doctorid']; // Change to doctorid
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contactdetails = $_POST['contactdetails'];
    $specialization = $_POST['specialization'];

    $query = "UPDATE doctors SET Firstname='$firstname', Lastname='$lastname', Address='$address', ContactDetails='$contactdetails', Specialization='$specialization' WHERE DoctorID='$doctorid'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Doctor Details Updated Successfully";
    } else {
        $_SESSION['status'] = "Doctor Details Updated Failed";
    }

    header("Location: doctor.php");
    exit();
}

if (isset($_POST['updateLabAdmin_By_Admin'])) {
    $labadminid = $_POST['labadminid']; // Change to labadminid
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contactdetails = $_POST['contactdetails'];

    $query = "UPDATE labadmins SET Firstname='$firstname', Lastname='$lastname', Address='$address', ContactDetails='$contactdetails' WHERE LabAdminid='$labadminid'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Lab Admin Details Updated Successfully";
    } else {
        $_SESSION['status'] = "Lab Admin Details Updated Failed";
    }

    header("Location: labadmin.php");
    exit();
}

if (isset($_POST['updatePharmacist_By_Admin'])) {
    $pharmacistid = $_POST['pharmacistid']; // Change to pharmacistid
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contactdetails = $_POST['contactdetails'];

    $query = "UPDATE pharmacists SET Firstname='$firstname', Lastname='$lastname', Address='$address', ContactDetails='$contactdetails' WHERE PharmacistID='$pharmacistid'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Pharmacist Details Updated Successfully";
    } else {
        $_SESSION['status'] = "Pharmacist Details Updated Failed";
    }

    header("Location: pharmacist.php");
    exit();
}

if(isset($_POST['updatePatient_By_Admin']))
{
    $patientid = $_POST['patientid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contactdetails = $_POST['contactdetails'];
    $notificationpreferences = $_POST['notificationpreferences'];

    $query = "UPDATE patients SET Firstname='$firstname', Lastname='$lastname', Address='$address', ContactDetails='$contactdetails',NotificationPreferences='$notificationpreferences'  WHERE PatientID='$patientid' ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['status'] = "Patient Details Updated Successfully";
        header("Location: patient.php");    
    }
    else
    {
        $_SESSION['status'] = "Patient Details Updated Failed";
        header("Location: patient.php");       
    }

}

if (isset($_POST['updateUser_By_Admin'])) {
    $UserID  = $_POST['userid']; 
    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    $query = "UPDATE users SET Username='$Username', Email='$Email', Password='$Password' WHERE UserID='$UserID'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "User Details Updated Successfully";
    } else {
        $_SESSION['status'] = "User Details Updated Failed";
    }

    header("Location: users.php");
}

//user table delete data from admin panel
if(isset($_POST['deleteUser_By_Admin']))
{
    $user_id = $_POST['delete_id'];
    $role= $_POST['role'];
    switch ($role) {
        case "patient":
            $query = "DELETE FROM patients WHERE PatientID='$user_id' ";
            break;
        case "doctor":
            $query = "DELETE FROM doctors WHERE DoctorID='$user_id' ";
            break;
        case "pharmacist":
            $query = "DELETE FROM pharmacists WHERE PharmacistID='$user_id' ";
            break;
        case "labadmin":
            $query = "DELETE FROM labadmins WHERE LabAdminID='$user_id' ";
            break;
    }

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        switch ($role) {
            case "patient":
                $_SESSION['status'] = "Patient Details Deleted Successfully";
                header("Location: patient.php");
                break;
            case "doctor":
                $_SESSION['status'] = "Doctor Details Deleted Successfully";
                header("Location: doctor.php");
                break;
            case "pharmacist":
                $_SESSION['status'] = "Pharmacist Details Deleted Successfully";
                header("Location: pharmacist.php");
                break;
            case "labadmin":
                $_SESSION['status'] = "LabAdmin Details Deleted Successfully";
                header("Location: labadmin.php");
                break;
        }
        
    }
    else
    {
        switch ($role) {
            case "patient":
                $_SESSION['status'] = "Patient Details Deleted Failed";
                header("Location: patient.php");
                break;
            case "doctor":
                $_SESSION['status'] = "Doctor Details Deleted Failed";
                header("Location: doctor.php");
                break;
            case "pharmacist":
                $_SESSION['status'] = "Pharmacist Details Deleted Failed";
                header("Location: pharmacist.php");
                break;
            case "labadmin":
                $_SESSION['status'] = "LabAdmin Details Deleted Failed";
                header("Location: labadmin.php");
                break;
        }
    }

}

if (isset($_POST['updatePatientComments'])) {
    $PatientRecordID  = $_POST['patientrecordid']; // Change to labadminid
    $Diagnosis = $_POST['diagnosis'];
    $Comments = $_POST['comments'];

    $query = "UPDATE patientrecords SET Diagnosis='$Diagnosis', Comments='$Comments' WHERE PatientRecordID='$PatientRecordID'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Patient Comment Updated Successfully";
    } else {
        $_SESSION['status'] = "Patient Comment Updated Failed";
    }

    header("Location: patientdiagnosis.php");
    exit();
}

if(isset($_POST['deleteMedicalReport']))
{
    $ReportID  = $_POST['delete_id'];
    $query = "DELETE FROM medicalreports WHERE ReportID ='$ReportID' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Medical Report Deleted Successfully";
        header("Location: patientmedicalreport.php");
    } else {
        $_SESSION['status'] = "Medical Report Deleted Failed";
        header("Location: patientmedicalreport.php");
    }

    
    

}

if (isset($_POST['SubmitReport']))
 {
     
    $ReportTitle = $_POST["reporttitle"];
    $PatientID = $_POST["patientid"];
    $File = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = '../JT/report';
    $UserID = $_SESSION['auth_user']['UserID'];
    $Date = date('Y-m-d');

    move_uploaded_file($tname, $uploads_dir.'/'.$File);

    
    $labadmin_query = "SELECT LabAdminID  FROM labadmins WHERE UserID='$UserID' LIMIT 1";
    $labadmin_query_run = mysqli_query($con, $labadmin_query);
    if ($labadmin_query_run) {
        
        if (mysqli_num_rows($labadmin_query_run) > 0) {
            $row = mysqli_fetch_assoc($labadmin_query_run);
            $LabAdminID = $row['LabAdminID'];
            $sql = "INSERT into medicalreports(PatientID,LabAdminID,ReportTitle,File,Date,UploadBy) VALUES('$PatientID','$LabAdminID','$ReportTitle','$File','$Date','Lab Admin')";
 
            if(mysqli_query($con,$sql)){
                $_SESSION['status'] = "File Sucessfully uploaded";
                header("Location: patientmedicalreport.php");
            }
            else{
                $_SESSION['status'] = "File upload Failed";
                header("Location: patientmedicalreport.php");
            }
        } else {
            $_SESSION['status'] = "You are Not A Lab Admin";
            header("Location: patientmedicalreport.php");
        }
    } else {
        echo 'Error executing query';
    }
    
}

?>


