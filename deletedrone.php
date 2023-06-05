<?php
include('connectdb.php');

$drone_id = $_GET['id'];

// สร้างคำสั่ง SQL สำหรับลบข้อมูล
$sql = "DELETE FROM `drones` WHERE `drone_id` = $drone_id";
if (mysqli_query($connection, $sql)) {
    echo '<script>alert("ลบรายการจองเรียบร้อยแล้ว");</script>';
} else {
    echo '<script>alert("เกิดข้อผิดพลาดในการลบรายการจอง: ' . mysqli_error($connection) . '");</script>';
}
$connection->close();
header("Location: drone.php");
exit;
?>