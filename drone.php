<?php
include('connectdb.php');
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit; 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $drone_name = $_POST['drone_name'];

    $sql = "INSERT INTO `drones` (`drone_id`, `drone_name`) 
    VALUES (NULL, '$drone_name'); ";

    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("เพิ่มโดรนเรียบร้อยแล้ว");</script>';
    } else {
        echo '<script>alert("เกิดข้อผิดพลาดในการเพิ่มโดรน: ' . mysqli_error($connection) . '");</script>';
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
        <h2 class="text-dark">ตารางแสดงรายชื่อโดรน</h2>
        <div class="table-responsive">
            <table id="customerTable" class="table table-striped table-bordered text-dark">
                <thead class="thead-light">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อรุ่น</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sql = "SELECT * FROM `drones`;";
                    $result = $connection->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . $row['drone_name'] . "</td>";
                        echo "<td>
    <a class='btn btn-dark'  href='updatedrone.php?id=" . $row['drone_id'] . "'>Update</a>
</td>";

                        echo "<td><a class='btn btn-danger' href='deletedrone.php?id=" . $row['drone_id'] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#bookingModal">
            Crate Drone
        </button>
        <a  class="btn btn-dark" href="booking.php">Booking List</a>
        <a  class="btn btn-danger" href="logout.php">Logout</a>
    </div>


    
    <!-- Modal -->
    <div class="modal fade modal-light" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Form Craete Drone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light text-dark">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="drone_name">Drone Name:</label>
                            <input type="text" class="form-control" id="drone_name" name="drone_name" required>
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
            $('#customerTable').DataTable();
        });
    </script>

    <?php
    $connection->close();
    ?>
</body>

</html>
