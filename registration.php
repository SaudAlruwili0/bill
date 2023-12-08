<?php
require_once 'template/header.php';
// require_once 'config/database.php';
include_once 'config/database.php';
// session_start();
if(isset($_SESSION['logged_in'])){
    // die('dddd');
    header('location:index.php');
}
$errors = [];
$email = '';


?>  
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($mysqli , $_POST['email']);
    $password = mysqli_real_escape_string($mysqli ,$_POST['pass']);
    $passwordConfirm = mysqli_real_escape_string($mysqli,$_POST['passc']);
    if(empty($email)){ array_push($errors, "الايميل مطلوب");}
    if(empty($password)){ array_push($errors, "ادخل كلمة مرور");}
    if(empty($passwordConfirm)){ array_push($errors, "ادخل تأكيد كلمة المرور ");}
    if($password != $passwordConfirm && !empty($passwordConfirm)){ array_push($errors , 'كلمات المرور لا تتشابه');}
    // die($email);
    // echo "<pre>"; print_r($_POST); echo "</pre>";
    //  التحقق من وجود المستخدم 
    if(!count($errors)){
        $userExist = $mysqli->query("select user_id , email from users where email='$email' limit 1");
        // echo $userExist->num_rows;
    }
    if(!count($errors)){
        $password = password_hash($password , PASSWORD_DEFAULT);
        // echo $password;
        $query = "insert into users (user_password,email) VALUES('$password','$email')";
        $mysqli->query($query);
  $_SESSION['logged_in']  = true; 
  //  جلب رقم الاي دي
  $_SESSION['user_id'] = $mysqli->insert_id;
  $_SESSION['success_message']= 'مرحبا بك في موقعنا';
  header('location:index.php');
    }
}?>
<h2 class="text-center">تسجيل حساب جديد</h2>
<?php  include 'template/errors.php'
?>
<form action="" method="post" inctype="multipart/form-data">
<div class="form-group">
    <label for="email">ادخل ايميلك</label>
    <input type="email" name="email" id="email" class="form-control" value="<?php echo $email?>">
</div>

<div class="form-group">
    <label for="pass">ادخل كلمة المرور</label>
    <input type="password" name="pass" id="pass" class="form-control" >
</div>

<div class="form-group">
    <label for="passc"> تأكيد كلمة المرور</label>
    <input type="password" name="passc" id="passc" class="form-control">
</div>

<button type="submit" name="reg" class="btn btn-primary mt-4">تسجيل جديد</button>



</form>

<?php  include 'template/footer.php'; ?>
