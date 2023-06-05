<?php
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $drone_name = $_POST['drone_name'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูลในตาราง customer
    $sql = "UPDATE `drones` 
            SET `drone_name` = '$drone_name' WHERE `drone_id` = $id";

    if ($connection->query($sql) === TRUE) {
        echo '<script>alert("Update Successfully");</script>';
        echo '<script>window.location.href = "drone.php";</script>';
    } else {
        echo '<script>alert("Update Error: ' . $connection->error . '");</script>';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Update Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container  mt-5  p-5">
    <h1>Form Update Drone</h1>
  </div>
  <div class="container w-50 shadow p-5">
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM drones WHERE drone_id = $id";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) { ?>
        <form action="" method="POST">
          <h2>Drone Name: <?php echo $row['drone_name']?></h2>
          <div class="form-group">
            <label for="drone_name">Drone Name:</label>
            <input name="drone_name" type="text" class="form-control" placeholder="<?php echo $row['drone_name']?>" value="<?php echo $row['drone_name']?>" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php } ?>
  </div>
</body>
</html>
