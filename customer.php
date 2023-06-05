<?php
include('connectdb.php');
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit; 
}
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
    <title>Form Booking Drone</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5 p-3 text-dark">
        <h2 class="text-dark">ตารางแสดงข้อมูลลูกค้า</h2>
        <div class="table-responsive">
            <table id="customerTable" class="table table-striped table-bordered text-dark">
                <thead class="thead-light">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อ</th>
                        <th>เบอร์โทร</th>
                        <th>ที่อยู่</th>
                        <th>หมายเหตุ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sql = "SELECT * FROM `customer`;";
                    $result = $connection->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['comment'] . "</td>";
                        echo "<td>
    <a class='btn btn-dark'  href='updatecustomer.php?id=" . $row['customer_id'] . "'>Update</a>
</td>";

                        echo "<td><a class='btn btn-danger' href='deletecustomer.php?id=" . $row['customer_id'] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#bookingModal">
            Open Booking Modal
        </button> -->
        <a  class="btn btn-dark" href="booking.php">Booking List</a>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addCustomerModal">Crate Customer ?</button>
        <a  class="btn btn-danger" href="logout.php">Logout</a>
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
    <!-- Modal -->
    <!-- <div class="modal fade modal-light" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Form Booking Drone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light text-dark">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="booking_date">Date Start:</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                        </div>
                        <div class="form-group">
                            <label for="booking_time">Date End:</label>
                            <input type="date" class="form-control" id="booking_time" name="booking_time" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_id">Select Customer:</label>
                            <select class="form-control" id="customer_id" name="customer_id" required>
                                <?php
                                $sql = "SELECT * FROM `customer`";
                                $result = $connection->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="drone_id">Select Drone:</label>
                            <select class="form-control" id="drone_id" name="drone_id" required>
                                <?php
                                $sql1 = "SELECT * FROM `drones`";
                                $result1 = $connection->query($sql1);
                                while ($row1 = $result1->fetch_assoc()) {
                                    echo "<option value='" . $row1['drone_id'] . "'>" . $row1['drone_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable();
        });
    </script>

    <?php
    $connection->close();
    ?>
</body>

</html>
