<?php
include('connectdb.php');
// สร้างคำสั่ง SQL สำหรับดึงข้อมูลงาน
$sql = "SELECT *
FROM bookings
INNER JOIN customer ON bookings.customer_id = customer.customer_id
INNER JOIN drones ON bookings.drone_id = drones.drone_id";

// รับผลลัพธ์
$result = $connection->query($sql);

// สร้างอาร์เรย์ของเหตุการณ์
$events = array();

// วนลูปผลลัพธ์และเพิ่มข้อมูลลงในอาร์เรย์
while ($row = $result->fetch_assoc()) {
    $event = array();
    $event['title'] = $row['des'];
    $event['start'] = $row['booking_date'];
    $event['end'] = $row['booking_time'];
    $events[] = $event;
}

// ส่งค่ากลับเป็น JSON
header('Content-Type: application/json');
echo json_encode($events);

// ปิดการเชื่อมต่อฐานข้อมูล
$connection->close();
?>