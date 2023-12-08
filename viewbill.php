<?php
require_once 'template/header.php';
require_once 'config/database.php';
// phpinfo();
// die('ddd');
$sql = "select * from bills";
$bills = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
// print_r($bills);

// $add = $mysqli->query($sql);

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $bills = $mysqli->prepare("delete from bills where bill_id =?");
    $billId = $_POST['bill_id'];
    $bills->bind_param('i',$billId);
    

    
    $bills->execute();
  
    echo "|<script>location.href ='viewbill.php'</script>";
}
?>

<table class="table">
    <tr>
        <th>م</th>
        <th>الكاش</th>
        <th>الشبكة</th>
        <th>المجموع</th>
        <th>الصورة</th>
        <th>التاريخ</th>
        <th>الخيارات</th>
    </tr>
    <?php foreach ($bills as $bill) {
        ?>
        <tr>
<td><?php echo $bill['bill_id'];?> </td>
            <td>
                <?php echo $bill['cash_amount']; ?>
            </td>
            <td>
                <?php echo $bill['mada_amount']; ?>
            </td>
            <td>
                <?php echo $bill['total_amount']; ?>
            </td>
            <td><img src="<?php echo $bill['image_path'] ?>" alt="img" class=""></td>
            <td>2023/2/2</td>
            <td><a href="" class="btn btn-primary">عرض</a><a href="" class="btn btn-warning">تعديل</a>
            <!-- img-responsive -->
            <form action="" method="post" style="display:inline">
                <input type="hidden" name="bill_id" value="<?php echo $bill['bill_id']?>">
                <button type="submit" class="btn btn-danger">حذف</button>
            </form></td>
           
        </tr>
    <?php } ?>
</table>


<?php require_once 'template/footer.php' ?>