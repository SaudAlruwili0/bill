<?php 
include_once 'template/header.php';
include_once 'config/database.php';

// die('ddd');

$email = '';  
$errors =[];

?>

<?php

// print_r($_POST);
// die($errors)
// print_r($errors);
if($_SERVER['REQUEST_METHOD']='POST'){
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    if(empty($email)){
        // array_push($errors,'الايميل مطلوب');
    }

    if(!count($errors)){
        $userExists = $mysqli->query("select * from users where email='$email' limit 1");
        if($userExists->num_rows){
                // echo "foun user";
$userId = $userExists->fetch_assoc()['user_id'];

// echo $userId;
$token = bin2hex(random_bytes(16));
$expiresAt = date('Y-m-d H:i:s',strtotime('+1 day'));
$mysqli->query("insert into password_rests (user_id,token,expires_at) values('$userId','$token','$expiresAt')");
echo $token;


}

$_SESSION['success_message']= 'وصلتك رسالة استعادة كلمة المرور على الايميل';
header('location:password_rest.php');
die();
}
}
?>

<h2>استعادة كلمة المرور</h2>
<?php  include_once 'template/errors.php'; ?>
<form action="" method="post">
<div class="form-group mb-3">
    <label for="email">الايميل</label>
    <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>">
</div>
<button class="btn btn-primary" type="submit" name="rest">استعادة كلمة المرور</button>
</form>


<?php include_once 'template/footer.php'; ?>