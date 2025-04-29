<?php
include "db_conn.php";

$id = isset($_GET['cos_id']) ? $_GET['cos_id'] : die('ERROR: Record ID not found.');

// Get record data from database
$sql = "SELECT * FROM employees WHERE cos_id=$id";
$result = mysqli_query($conn, $sql);

if (!$result) {
   die("Error executing query: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

// Add this query BEFORE the form processing
$duties_sql = "SELECT duties FROM df WHERE cos_id='" . $row['cos_id'] . "'";
$duties_result = mysqli_query($conn, $duties_sql);
if (!$duties_result) {
    die("Error fetching duties: " . mysqli_error($conn));
}

// Fetch existing duties for this employee
$duties_sql = "SELECT duties FROM df WHERE cos_id = '$id'";
$duties_result = mysqli_query($conn, $duties_sql);
$existing_duties = [];
while ($duty_row = mysqli_fetch_assoc($duties_result)) {
    $existing_duties[] = $duty_row['duties'];
}

// Fetch all unique duties for datalist
$all_duties_sql = "SELECT DISTINCT duties FROM df ORDER BY duties ASC";
$all_duties_result = mysqli_query($conn, $all_duties_sql);
$all_duties = [];
while ($duty_row = mysqli_fetch_assoc($all_duties_result)) {
    $all_duties[] = $duty_row['duties'];
}

if (isset($_POST["submit"])) {
   $cos_name = $_POST['cos_name'];
   $cos_address = $_POST['cos_address'];
   $cos_position = $_POST['cos_position'];
   $cos_salary = $_POST['cos_salary'];
   $cos_office = $_POST['cos_office'];
   $cos_from = $_POST['cos_from'];
   $cos_to = $_POST['cos_to'];
   $cos_id = $_POST['cos_id'];
   $cos_charging = $_POST['cos_charging'];
   $cos_receive = $_POST['cos_receive'];
   $sign1 = $_POST['sign1'];
   $sign2 = $_POST['sign2'];
   $signrank1 = $_POST['signrank1'];
   $signrank2 = $_POST['signrank2'];

   $sql = "UPDATE employees SET 
           `cos_name`='$cos_name', 
           cos_address='$cos_address', 
           cos_position='$cos_position', 
           cos_salary='$cos_salary', 
           cos_office='$cos_office', 
           cos_from='$cos_from', 
           cos_to='$cos_to', 
           cos_charging='$cos_charging', 
           cos_receive='$cos_receive', 
           cos_id='$cos_id', 
           sign1='$sign1', 
           sign2='$sign2', 
           signrank1='$signrank1', 
           signrank2='$signrank2'  
           WHERE cos_id='$id'";
   
   $query = mysqli_query($conn, $sql);
   
   if ($query) {
      // Delete existing duties
      mysqli_query($conn, "DELETE FROM df WHERE cos_id='$cos_id'");
      
      // Insert new duties
      if (isset($_POST['duties'])) {
          foreach ($_POST['duties'] as $duty) {
              if (!empty($duty)) {
                  $duty = mysqli_real_escape_string($conn, $duty);
                  $query3 = "INSERT INTO df(cos_id, duties) VALUES ('$cos_id', '$duty')";
                  mysqli_query($conn, $query3);
              }
          }
      }
      
      header("Location: index.php");
   } else {
      die("Error updating record: " . mysqli_error($conn));
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Contract of Service</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Contract of Service
   </nav>

   <div class="container">
      <div class="text-center">
         <h3>Edit User</h3>
         <p class="text-muted"></p>
      </div>

      <form action="" autocomplete="on" method="post" class="row g-3">
         <div class="col-md-2">
            <label class="form-label">Id Number</label>
            <input type="text" class="form-control" name="cos_id" value="<?php echo $row['cos_id']; ?>">
         </div>

         <div class="col-md-10">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="cos_name" value="<?php echo $row['cos_name']; ?>">
         </div>

         <div class="col-md-8">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="cos_address" value="<?php echo $row['cos_address']; ?>">
         </div>
         <div class="col-md-2">
            <label class="form-label">Position</label>
            <input type="text" class="form-control" name="cos_position" value="<?php echo $row['cos_position']; ?>">
         </div>
         <div class="col-md-2">
            <label class="form-label">Salary</label>
            <input type="text" class="form-control" name="cos_salary" value="<?php echo $row['cos_salary']; ?>">
         </div>
         <div class="col-md-4">
            <label class="form-label">Office</label>
            <input type="text" class="form-control" name="cos_office" value="<?php echo $row['cos_office']; ?>">
         </div>
         <div class="col-md-2">
            <label class="form-label">Effectivity from</label>
            <input type="text" class="form-control" name="cos_from" value="<?php echo $row['cos_from']; ?>">
         </div>
         <div class="col-md-2">
            <label class="form-label">Effectivity to</label>
            <input type="text" class="form-control" name="cos_to" value="<?php echo $row['cos_to']; ?>">
         </div>
         <div class="col-md-4">
            <label class="form-label">Charging</label>
            <input type="text" class="form-control" name="cos_charging" value="<?php echo $row['cos_charging']; ?>">
         </div>
         <div class="col-md-12">
            <div id="dynamic_field3">
                <div class="form-row">
                    <div class="col-md-12">
                        <label class="form-label">Duties and Function</label>
                        <?php foreach ($existing_duties as $index => $duty): ?>
                            <div class="form-row mt-2" id="row3<?php echo $index; ?>">
                                <div class="col">
                                    <input type="text" class="form-control duties-input" name="duties[]" 
                                           list="dutiesList" value="<?php echo htmlspecialchars($duty); ?>">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger btn_remove3" id="<?php echo $index; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($existing_duties)): ?>
                            <div class="form-row mt-2" id="row30">
                                <div class="col">
                                    <input type="text" class="form-control duties-input" name="duties[]" list="dutiesList">
                                </div>
                            </div>
                        <?php endif; ?>
                        <datalist id="dutiesList">
                            <?php foreach ($all_duties as $duty): ?>
                                <option value="<?php echo htmlspecialchars($duty); ?>">
                            <?php endforeach; ?>
                        </datalist>
                        <div class="col-md-2 mt-2">
                            <button type="button" name="add" id="add3" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <div class="col-4">
            <label class="form-label">Receive Date</label>
            <input type="text" class="form-control" name="cos_receive" value="<?php echo $row['cos_receive']; ?>">
         </div>
         <div class="col-2">
            <label class="form-label">First Witness</label>
            <input type="text" class="form-control" name="sign1" value="<?php echo $row['sign1']; ?>">
         </div>
         <div class="col-2">
            <label class="form-label">First Witness Postion</label>
            <input type="text" class="form-control" name="signrank1" value="<?php echo $row['signrank1']; ?>">
         </div>
         <div class="col-2">
            <label class="form-label">Second Witness</label>
            <input type="text" class="form-control" name="sign2" value="<?php echo $row['sign2']; ?>">
         </div>
         <div class="col-2">
            <label class="form-label">Second Witness Postion</label>
            <input type="text" class="form-control" name="signrank2" value="<?php echo $row['signrank2']; ?>">
         </div>
         <div class="col-12">
            <button type="submit" class="btn btn-success" name="submit">Save</button>
            <a href="index.php" class="btn btn-danger">Cancel</a>
         </div>
      </form>
   </div>


   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

   <script>
      $(document).ready(function () {
         var i = 1;

         $('#add3').click(function () {
            i++;
            $('#dynamic_field3').append(
                '<div class="form-row mt-2" id="row3' + i + '">' +
                    '<div class="col">' +
                        '<input type="text" class="form-control duties-input" list="dutiesList" name="duties[]">' +
                    '</div>' +
                    '<div class="col">' +
                        '<button type="button" name="add" class="btn btn-danger btn_remove3" id="' + i + '">' +
                            '<i class="fa fa-trash"></i>' +
                        '</button>' +
                    '</div>' +
                '</div>'
            );
         });

         $(document).on('click', '.btn_remove3', function () {
            var button_id = $(this).attr("id");
            $('#row3' + button_id + '').remove();
         });
      });
   </script>

</body>

</html>