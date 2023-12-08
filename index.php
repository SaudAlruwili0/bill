<?php
require_once 'template/header.php';
include_once 'includes/uploader.php';
?>
<?php
// session_start();
if(isset($_SESSION['logged_in'])){
$documentError = $madaError =$cashError = $dateError ='';
function filterString($field)
{
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if (empty($field)) {
        return false;
    } else {
        return $field;
    }
}
function canUpload($file)
{
    $allowed = [
        'jpg' => 'image/jpeg',
        // 'png' => 'image/png',
        'gif' => 'image/gif',
    ];
    $maxFileSize = 10 * 1024;
    $fileMimeType = mime_content_type($file['tmp_name']);
    $fileSize = $file['size'];
    if (!in_array($fileMimeType, $allowed)) {
        $documentError = 'اختر صورة';
        return 'file type not allowed';
    } 
    if ($fileSize > $maxFileSize) {
        return 'the file size bigger than' . $maxFileSize;
    }
    return true;
}
$documentError = $madaError =$cashError = $dateError ='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $cash = $_POST['cash'];
    $mada = $_POST['mada'];
    // $date = date('Y-m-d',strtotime($_POST['date']));
    $date = $_POST['date'];
    // print_r($_POST);
    $total = (intval($cash) + intval($mada));
    // $filePath = 'ddd';  
    (!$_POST['date']) ? $dateError = 'ادخل التاريخ' : null ;
    (!$_POST['cash']) ? $cashError= 'ادخل مبلغ الكاش': null;
    (!$_POST['mada'])?  $madaError= 'ادخل مبلغ الشبكة' : null;
        // die(var_dump($filePath));
    if(!$documentError && !$madaError && !$cashError && !$dateError){
        $insertBill= $mysqli->query("insert into bills(cash_amount,mada_amount,total_amount,date_bill,image_path) 
         VALUES($cash,$mada,$total,'$date','$filePath')");  
        $mada = $cash =$date = '';  
    }
}
    // echo "<pre>";
    // print_r($_POST);
    // print_r($_FILES);
    // echo "</pre>";
  
// $cash = null;

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
   <div class="form-group col-s-12">
        <label for="date">التاريخ</label>
        <input type="date" name="date" id="date" class="form-control mt-1" value="<?php echo $date ?>">
        <span class="text-danger"><?php echo $dateError ?></span>
    </div>
    <div class="form-group">
        <label for="cash">الكاش</label>
        <input type="number" name="cash" id="cash" class="form-control mt-1" value="<?php echo $cash ?>">
        <span class="text-danger"><?php echo $cashError ?></span>
    </div>
    <div class="form-group">
        <label for="mada">الشبكة</label>
        <input type="number" name="mada" id="mada" class="form-control mt-1" value="<?php echo $mada ?>">
        <span class="text-danger"> <?php echo $madaError ?></span>
    </div>
    <div class="form-group">
        <label for="bill">الصورة</label>
        <input type="file" name="bill" id="bill" class="form-control mt-1">
        <span class="text-danger">
            <?php echo $documentError ?>
        </span>
    </div>
    <button type="submit" class="mt-4 btn btn-primary">رفع التقرير</button>
 
</form>

<?php } ?>

<?php include_once 'template/footer.php' ?>