<?php
include('connectdb.php');

$customer_id = $_GET['id'];

// สร้างคำสั่ง SQL สำหรับลบข้อมูล
$sql = "DELETE FROM `customer` WHERE `customer_id` = $customer_id";
if (mysqli_query($connection, $sql)) {
    echo '<script>alert("ลบรายการจองเรียบร้อยแล้ว");</script>';
} else {
    echo '<script>alert("เกิดข้อผิดพลาดในการลบรายการจอง: ' . mysqli_error($connection) . '");</script>';
}
$connection->close();
header("Location: customer.php");
exit;
?>