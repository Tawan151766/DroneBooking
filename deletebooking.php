<?php
include('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM `bookings` WHERE `id` = $id";

    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("ลบรายการจองเรียบร้อยแล้ว");</script>';
    } else {
        echo '<script>alert("เกิดข้อผิดพลาดในการลบรายการจอง: ' . mysqli_error($connection) . '");</script>';
    }
}

$connection->close();
header("Location: booking.php");
exit;
?>
