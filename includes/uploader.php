<?php
// die('ddd');
include_once __DIR__.'/../config/database.php';
$filePath ='';
$documentError = $dateError=  $cashError =$madaError ='';
if(!$documentError && !$dateError && !$cashError && !$madaError){
    // $insetBill = "insert into bills (cash_amount)
    // values(2)";
    // $mysqli->query($insetBill);
}
if (isset($_FILES['bill']) && $_FILES['bill']['error'] == 0) {
    $canUpload = canUpload($_FILES['bill']);
  
    if ($canUpload == true) {
        // die('upload');
        $uploadDir = 'uploads';
        if (!is_dir($uploadDir)) {
            umask(0);
            mkdir($uploadDir, 0775);
        }
        $fileName = time() . $_FILES['bill']['name'];
        if (file_exists($uploadDir . '/' . $fileName)) {
            $documentError = 'file already exists';
        }
  
    $filePath = $uploadDir . '/' . $fileName;
    // die($filePath);
        move_uploaded_file($_FILES['bill']['tmp_name'], $uploadDir . '/' . $fileName);
    } else {
        $documentError = $canUpload;
    }

}
?>