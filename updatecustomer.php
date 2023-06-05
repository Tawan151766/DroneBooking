<?php
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address  = $_POST['address'];
    $comment  = $_POST['comment'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูลในตาราง customer
    $sql = "UPDATE `customer` 
            SET `customer_name` = '$customer_name', `phone` = '$phone', 
                `address` = '$address', `comment` = '$comment' 
            WHERE `customer_id` = $id";

    if ($connection->query($sql) === TRUE) {
        echo '<script>alert("Update Successfully");</script>';
        echo '<script>window.location.href = "customer.php";</script>';
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
    <h1>Form Update Customer</h1>
  </div>
  <div class="container w-50 shadow p-5">
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM customer WHERE customer_id = $id";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) { ?>
        <form action="" method="POST">
          <h2>Customer Name: <?php echo $row['customer_name']?></h2>
          <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input name="customer_name" type="text" class="form-control" placeholder="<?php echo $row['customer_name']?>" value="<?php echo $row['customer_name']?>" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input name="phone" type="text" class="form-control" placeholder="<?php echo $row['phone']?>" value="<?php echo $row['phone']?>" required>
          </div>
          <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $row['address']?></textarea>
          </div>
          <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required><?php echo $row['comment']?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php } ?>
  </div>
</body>
</html>
