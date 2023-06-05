<?php
include('connectdb.php');
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit; 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $customer_id = $_POST['customer_id'];
    $drone_id = $_POST['drone_id'];
    $des = $_POST['des'];

    $sql = "INSERT INTO `bookings` (`id`, `booking_date`, `booking_time`, `customer_id`, `drone_id`, `des`) 
    VALUES (NULL, '$booking_date', '$booking_time', '$customer_id', '$drone_id', '$des'); ";

    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("จองคิวเรียบร้อยแล้ว");</script>';
    } else {
        echo '<script>alert("เกิดข้อผิดพลาดในการจองคิวเรียบร้อยแล้ว: ' . mysqli_error($connection) . '");</script>';
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
        <h2 class="text-dark">ตารางแสดงข้อมูลรายละเอียดตารางงาน</h2>
        <div class="table-responsive">
            <table id="bookingTable" class="table table-striped table-bordered text-dark">
                <thead class="thead-light">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>วันที่เริ่ม</th>
                        <th>วันสิ้นสุด</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ชื่อโดรน</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sql = "SELECT *
                    FROM bookings
                    INNER JOIN customer ON bookings.customer_id = customer.customer_id
                    INNER JOIN drones ON bookings.drone_id = drones.drone_id;
                    ";
                    $result = $connection->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . $row['booking_date'] . "</td>";
                        echo "<td>" . $row['booking_time'] . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['drone_name'] . "</td>";
                        echo "<td>
    <a class='btn btn-dark'  href='updategooking.php?id=" . $row['id'] . "'>Update</a>
</td>";

                        echo "<td><a class='btn btn-danger' href='deletebooking.php?id=" . $row['id'] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#bookingModal">
            Booking
        </button>
        <a  class="btn btn-dark" href="customer.php">Customer List</a>
        <a  class="btn btn-dark" href="drone.php">Drone List</a>
        <a  class="btn btn-danger" href="logout.php">Logout</a>
    </div>


    
    <!-- Modal -->
    <div class="modal fade modal-light" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
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
                        <div class="form-group">
                        <label for="des">details:</label>
                        <textarea class="form-control" id="des" name="des" rows="3"></textarea>
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bookingTable').DataTable();
        });
    </script>

</body>

</html>
