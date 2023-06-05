<?php
session_start();

include('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];

    // สร้างคำสั่ง SQL สำหรับเลือกผู้ใช้งานที่มี username และ password ตรงกับที่ระบุ
    $sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        // ล็อกอินสำเร็จ
        $_SESSION['username'] = $username;
        header("Location: booking.php");
        exit();
    } else {
      // ล็อกอินไม่สำเร็จ
      echo '<script>alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");</script>';
      echo '<script>window.location.href = "index.php";</script>';
  }
  
}
?>