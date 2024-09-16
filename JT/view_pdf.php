<?php
session_start();
include('config/dbcon.php');
?>
<?php
if (isset($_GET['pdfFileName'])) {
    $pdfFileName = $_GET['pdfFileName'];
    $pdfFilePath = 'report/' . $pdfFileName; 

    if (file_exists($pdfFilePath)) {
       
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $pdfFileName . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($pdfFilePath);
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
