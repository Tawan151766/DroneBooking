<?php
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $customer_id = $_POST['customer_id'];
    $drone_id  = $_POST['drone_id'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูลในตาราง bookings
    $sql = "UPDATE `bookings` 
            SET `booking_date` = '$booking_date', `booking_time` = '$booking_time', 
                `customer_id` = '$customer_id', `drone_id` = '$drone_id' 
            WHERE `id` = $id";

    if ($connection->query($sql) === TRUE) {
        echo '<script>alert("Update Successfully");</script>';
        echo '<script>window.location.href = "booking.php";</script>';
    } else {
        echo '<script>alert("Update Error: ' . $connection->error . '");</script>';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Update Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container  mt-5  p-5">
  <h1>Form Update Booking</h1>
  </div>
    <div class="container w-50 shadow p-5">
    
    <?php
    $i = 1;
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM bookings
            INNER JOIN customer ON bookings.customer_id = customer.customer_id
            INNER JOIN drones ON bookings.drone_id = drones.drone_id WHERE bookings.id = $id;
            ";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) { ?>
        <form action="" method="POST">
        <h2>Customer Name : <?php echo $row['customer_name']?></h2>
            <div class="form-group">
                <label for="booking_date">Date Start:</label>
                <input type="text" class="form-control" placeholder="วันที่เก่า <?php echo $row['booking_date']?>" readonly>
                <input type="date" class="form-control mt-1" id="booking_date" name="booking_date" placeholder="<?php echo $row['booking_date']?>" required>
            </div>
            <div class="form-group">
                <label for="booking_time">Date End:</label>
                <input type="text" class="form-control" placeholder="วันที่เก่า <?php echo $row['booking_time']?>" readonly>
                
                <input type="date" class="form-control mt-1" id="booking_time" name="booking_time" required>
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
    <?php } ?>
    </div>
</body>
</html>
