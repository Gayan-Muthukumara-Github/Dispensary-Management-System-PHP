<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $log_query = "SELECT u.*,up.Privilege FROM users as u join userprivileges as up on up.UserID = u.UserID WHERE Email='$email' AND Password='$password' LIMIT 1";
    $log_query_run = mysqli_query($con, $log_query);

    if(mysqli_num_rows($log_query_run) > 0)
    {
        foreach($log_query_run as $row)
        {
            $UserID = $row['UserID'];
            $Username = $row['Username'];
            $Privilege = $row['Privilege'];
        } 
        if($Privilege == 'systemadmin')
        {
            $uType_ID = 1;
        }
        elseif($Privilege == 'patient')
        {
            $uType_ID = 2;
        }
        elseif($Privilege == 'doctor')
        {
            $uType_ID = 3;
        }
        elseif($Privilege == 'pharmacist')
        {
            $uType_ID = 4;
        }
        elseif($Privilege == 'labadmin')
        {
            $uType_ID = 5;
        }
        else
        {
            $uType_ID = 0;
        }
        $_SESSION['auth'] = "$uType_ID";
        $_SESSION['auth_user'] = [
            'UserID' =>$UserID,
            'Username' =>$Username
        ];
        $_SESSION['status'] = "Logged In Successfully";
        header('Location: index.php');

    }
    else
    {
        $_SESSION['status'] = "Invalid Email of password";
        header('Location: login.php');
    }

    
}
else
{
    $_SESSION['status'] = "Access Denied";
    header('Location: login.php');
}
