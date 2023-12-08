<!DOCTYPE html>
<html lang="ar" dir="rtl">
    
    <head>
        
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel ="stylesheet" href="style/master.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <!-- <body>
<?php session_start(); ?>
      
        <nav>
            <a>كافية ربع</a>
            <a>الرئيسية</a>
            <a>منتجاتنا</a>
            <a>تواصل معنا</a>
            <a href="registration.php">تسجيل جديد</a>
            <a href="login.php">تسجيل دخول</a>
        </nav> -->

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">شعار كافي ربع</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="bill.php">الرئيسية</a>
        <?php if(!isset($_SESSION['logged_in'])): 
          ?>
          <a class="nav-link" href="login.php">تسجيل دخول</a>
        <a class="nav-link" href="registration.php">تسجيل جديد</a>
        <?php  else: ?>
        <a class="nav-link  bg-success" href="logout.php">تسجيل خروج</a>
          <?php endif ?>
        <a class="nav-link" href="viewbill.php">الفواتير</a>
        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </div>
</nav>

<div class="container pt-5">

<?php

include 'template/messages.php'  ?>