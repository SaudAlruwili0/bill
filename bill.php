<?php
require_once 'template/header.php';
include_once 'includes/uploader.php';
?>
<?php
$documentError = '';
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
        return 'file type not allowed';
    }
    ;


    if ($fileSize > $maxFileSize) {
        return 'the file size bigger than' . $maxFileSize;
    }
    return true;

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "<pre>";
    // print_r($_POST);
    // print_r($_FILES);
    // echo "</pre>";



}


?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

 

   <div class="form-group col-s-12">
        <label for="date">التاريخ</label>
        <input type="date" name="date" id="date" class="form-control mt-1">
    </div>
    <div class="form-group">
        <label for="cash">الكاش</label>
        <input type="number" name="cash" id="cash" class="form-control mt-1">
    </div>
    <div class="form-group">
        <label for="mada">الشبكة</label>
        <input type="number" name="mada" id="mada" class="form-control mt-1">
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