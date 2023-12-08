<?php
require_once 'template/header.php';
include_once 'config/database.php';
if(isset($_SESSION['logged_in'])){
    header('location:index.php');
}
?>

<?php
$emailError = '';
$email = $password ='';
$errors =[];

$passwordErorr = '';
function filterEmail($field)
{
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return $field;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filterEmail($_POST['email']);
    $password =$_POST['pass'];
    // $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    if (!$email) {
        $emailError = 'your email required';
    }
    if(!$password){
        $passwordErorr = 'ادخل كلمة المرور';
    }

    if(!count($errors)){
        $userExists = $mysqli->query("select * from users where email='$email' limit 1");
       // التاكد من عدم وجود الايميل  في حالة وجود الايميل يظهر خطأ
        if(!$userExists->num_rows){
            array_push($errors,"الايميل غير مسجل");
        }else{
            $foundUser = $userExists->fetch_assoc();

            // echo $foundUser['user_id'];
            if(password_verify($password,$foundUser['user_password'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id']= $foundUser['usdr_id'];
                $_SESSION['success_message'] = 'اهلا بعودتك مرة اخرى';
                header('location:index.php');
                die();

            }else{
                array_push($errors , 'خطأ في الايميل او كلمة المرور');
            }

        }
    }
}
require_once 'template/errors.php';

?>

<form action="" method="POST">


    <div class="container mt-5">
        <div class="row">
            <h2 class="mb-5">تسجيل جديد</h2>
            <div class="form-group">
                <lable id="email">ادخل الايميل</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                    <span class="text-danger">
                        <?php echo $emailError ?>
                    </span>
            </div>
            <div class="form-group">
                <label for="pass">كلمة المرور</label>
                <input type="password" class="form-control" name="pass" id="pass" value="<?php echo $password ?>">
                <span class="text-danger"> <?php echo $passwordErorr  ?></span>
            </div>
            <a href="password_rest.php" class=" mt-1">هل نسيت كلمة المرور؟</a>
        </div>
        <button  class="btn btn-primary mt-3"type="submit">تسجيل</button>
    </div>

</form>

<?php include 'template/footer.php' ?>