<?php
include('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์ม
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $comment  = $_POST['comment'];

    // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลลูกค้าในตาราง customer
    $sql = "INSERT INTO `customer` (`customer_id`, `customer_name`, `phone`, `address`, `comment`) 
    VALUES (NULL, '$customer_name', '$phone', '$address', '$comment')";

    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("ลงทะเบียนผู้ใช้งานเรียบร้อยแล้ว");</script>';
    } else {
        echo '<script>alert("เกิดข้อผิดพลาดในการลงทะเบียนผู้ใช้งาน: ' . mysqli_error($connection) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html>
    
<head>
    <title>Calendar Example</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-pzjw8f+ua7Kw1TIq+3Z45L3PJ1PZJ7zc8z5IcZ5F01J4icbmw1lRGvF5F6nEM7N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <title>แสดงข้อมูล</title>
    <!-- เรียกใช้ไฟล์ CSS ของ Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- เรียกใช้ไฟล์ CSS ของ DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-vdfA1zH9w46g5jWAmiObt4/4iC+GS/CwT9P1WMim7NojtvRS1pbrfF55FQ0RDz8xHtt+8awpO3ugRf8hjV+kww==" crossorigin="anonymous" />

    <!-- เรียกใช้ไฟล์ CSS สำหรับธีมสว่าง -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <style>
        .body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #calendar {
            width: 1000px;
            margin: 20px;
        }

        .fc-header-title {
            color: red;
        }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="body mt-5">
<div class="container">
    <div style="width:1000px;margin:20px;"><h1>ตารางคิวงานโดรน</h1></div>
    <div style="width:1000px;margin:20px;" id='calendar'></div>
    <div style="width:1000px;margin:20px;">
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addCustomerModal">ต้องการจองหรือไม่ ?</button>
        <a class="btn btn-dark text-light" data-toggle="modal" data-target="#login">Login</a>
    </div>
</div>
</div>

<!-- โมดัลสำหรับกรอกข้อมูลลูกค้าใหม่ -->
<div class="modal fade modal-dark" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title  text-dark" id="addCustomerModalLabel">ฟอร์มกรอกข้อมูลทั่วไป</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark">
                <!-- แบบฟอร์มสำหรับกรอกข้อมูลลูกค้าใหม่ -->
                <form action="" method="POST">
                    <div class="form-group">
                        <p class="text-danger p-2">***กรุณาทิ้งเบอร์ติดต่อไว้ ทางบริษัทจะติดต่อกลับไปเอง ขอบคุณครับ***</p>
                    </div>
                    <div class="form-group">
                        <label for="customer_name" class="text-light">ชื่อลูกค้า:</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="นาย ก" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="text-light">โทรศัพท์:</label>
                        <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+" placeholder="0999999999" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="text-light">ที่อยู่:</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="ตัวอย่าง นครสรรค์" required>
                    </div>
                    <div class="form-group">
                        <label for="comment" class="text-light">หมายเหตุ:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- login-->
<div class="modal fade modal-dark" id="login" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-dark" id="addCustomerModalLabel">login</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="user" class="text-light">User:</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-light">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- เรียกใช้ไฟล์ JavaScript ของ jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- เรียกใช้ไฟล์ JavaScript ของ Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- เรียกใช้ไฟล์ JavaScript ของ fullCalendar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: {
                url: 'events.php',
                type: 'GET',
                error: function() {
                    alert('มีข้อผิดพลาดในการโหลดข้อมูลงาน');
                }
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            }
        });

        $('.fc-header-title').css('color', 'red');
    });
</script>

</body>
</html>
